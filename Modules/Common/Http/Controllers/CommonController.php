<?php

namespace Modules\Common\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use App\Helpers\Helpers;


use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTagGrp;
use App\Models\User;

use App\Models\TagFollower;

use App\Models\UserRankWeekly;
use App\Models\TagRankWeekly;
use Modules\User\Http\Controllers\UserPageController;

class CommonController extends Controller
{

        /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function home()
    {
     if (Auth::check()) {
                return redirect() -> route('timeline.all');
            } else {
                return redirect() -> route('post.newfeed');
            }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function question()
    {
     if (Auth::check()) {
                return redirect() -> route('question.timeline');
            } else {
                return redirect() -> route('question.newfeed');
            }
    }    

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function search(Request $request)
    {
        $req = $request->all();


        $keyword = $req['q'];
        if ($request->ajax()) {
            $current_page = $req['page'];
        }




        if(!empty($keyword)) {

            $str_sql =
            'SELECT '. ' posts.title, users.name as username, posts.item,posts.content, posts.status, posts.created_at,posts.updated_at, temp_tbl.tags, ifnull(temp_tbl2.countlike, 0) as countlike , ifnull(temp_tbl3.countcomment, 0) as countcomment , users.profile_photo_path, users.fullname
            FROM posts
            LEFT JOIN (
                SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                FROM post_tag_grps
                LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                GROUP BY post_tag_grps.post_id
            ) AS temp_tbl
            ON temp_tbl.post_id = posts.id
            LEFT JOIN(
                SELECT post_likes.post_id as post_id,
                COUNT(DISTINCT post_likes.user_id) as countlike
                FROM post_likes
                
                GROUP BY post_likes.post_id
            ) AS temp_tbl2
            ON temp_tbl2.post_id = posts.id

            LEFT JOIN(
                SELECT comments.post_id as post_id,
                COUNT(DISTINCT comments.user_id) as countcomment
                FROM comments
                
                GROUP BY comments.post_id
            ) AS temp_tbl3
            ON temp_tbl3.post_id = posts.id

            LEFT JOIN users ON posts.user_id = users.id'.
            " WHERE (posts.status = 1 OR posts.status = 3 )".

            " AND ( `title` LIKE '%".$keyword."%' ".
            " OR users.name  LIKE '%".$keyword."%' ".
            " OR `tags`  LIKE '%".$keyword."%' ".
            " OR `content`  LIKE '%".$keyword."%' )".
            ' ORDER BY (countlike + countcomment) desc';



            $posts = DB::select(DB::raw($str_sql));
            $posts = (new Collection($posts))->paginate(20);   
            Log::debug($str_sql);
            Log::debug($posts);
            
        }   

        $typepage="search";    

        if ($request->ajax()) {


            return view('common::Elements.pagination',compact('posts', 'keyword','typepage'))->render();
        }else{

            return view('common::Search.search' ,compact('posts', 'keyword','typepage'));
        }

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    //work
    public function timelineAll()
    {
        $typepage ='posts';

        $str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);


        if($typepage =='posts'){
        
        $str_sql = '(
            SELECT tmp2.user_id, tmp2.username, title,item,created_at,updated_at,tags,count,profile_photo_path
            FROM (
                SELECT  tags.tag_name as tag_name, tag_id
                FROM tag_followers
                LEFT JOIN users ON users.id = tag_followers.user_id
                LEFT JOIN tags ON tags.id = tag_followers.tag_id'.
                " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ') AS tmp
            LEFT JOIN (
                SELECT 
                    users.name as username,
                    users.profile_photo_path,
                    posts.title, 
                    posts.user_id, 
                    posts.item, 
                    posts.created_at, 
                    posts.updated_at,
                    temp_tbl.tags,
                    ifnull(temp_tbl2.count_like_post, 0) as count
                FROM posts
                LEFT JOIN (
                    SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM post_tag_grps
                    LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                    GROUP BY post_tag_grps.post_id
                ) AS temp_tbl
                ON temp_tbl.post_id = posts.id

                LEFT JOIN(
                    SELECT post_likes.post_id as post_id,
                    COUNT(DISTINCT post_likes.user_id) as count_like_post
                    FROM post_likes

                    GROUP BY post_likes.post_id
                ) AS temp_tbl2
                ON temp_tbl2.post_id = posts.id
                LEFT JOIN users ON users.id = posts.user_id

             
                WHERE ( posts.status = 1 OR posts.status =3)


            ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            WHERE item IS NOT NULL
            GROUP BY username,tmp2.user_id, title, item ,count,created_at,updated_at,tags,profile_photo_path)

            UNION

                (
            SELECT tmp.user_id, tmp.username, title,item,created_at,updated_at,tags,count,profile_photo_path
            FROM (SELECT users.name as username, users.id as user_id, users.profile_photo_path
                FROM followers
                LEFT JOIN users ON users.id = followers.follows_id'.
                            " WHERE followers.user_id = '" . Auth::id() . "' ".
                        ' ) AS tmp
            LEFT JOIN (
                SELECT 
                    posts.title, 
                    posts.user_id, 
                    posts.item, 
                    posts.created_at,
                    posts.updated_at,
                    temp_tbl.tags,
                    ifnull(temp_tbl2.count_like_post, 0) as count
                FROM posts
                LEFT JOIN (
                    SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM post_tag_grps
                    LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                    GROUP BY post_tag_grps.post_id
                ) AS temp_tbl
                ON temp_tbl.post_id = posts.id

                LEFT JOIN(
                    SELECT post_likes.post_id as post_id,
                    COUNT(DISTINCT post_likes.user_id) as count_like_post
                    FROM post_likes

                    GROUP BY post_likes.post_id
                ) AS temp_tbl2
                ON temp_tbl2.post_id = posts.id


                LEFT JOIN users ON posts.user_id = users.id
                WHERE ( posts.status = 1 OR posts.status =3 )
              
            ) AS tmp2
            ON tmp.user_id = tmp2.user_id
            WHERE item IS NOT NULL
            GROUP BY username, tmp.user_id, title, item ,count,created_at,updated_at,tags,profile_photo_path)
            ORDER BY updated_at desc';
}else if($typepage =='questions'){
    $str_sql = '(
            SELECT tmp2.user_id, tmp2.username, title,item,created_at,updated_at,tags,count,count_answear,type,profile_photo_path
                    FROM (
            SELECT  tags.tag_name as tag_name, tag_id, user_id
                            
            FROM tag_followers
            LEFT JOIN users ON users.id = tag_followers.user_id
            LEFT JOIN tags ON tags.id = tag_followers.tag_id'.
            " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ') AS tmp
                    LEFT JOIN (
                        SELECT 
                            questions.title, 
                            questions.type, 
                            users.name as username,
                            users.profile_photo_path,
                            questions.user_id, 
                            questions.item, 
                            questions.created_at, 
                            questions.updated_at,
                            temp_tbl.tags,
                            ifnull(temp_tbl2.count_like_question, 0) as count,
                            ifnull(temp_tbl3.count_answear, 0) as count_answear
                        FROM questions
                        LEFT JOIN (
                            SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                            FROM question_tag_grps
                            LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                            GROUP BY question_tag_grps.question_id
                        ) AS temp_tbl
                        ON temp_tbl.question_id = questions.id

                        LEFT JOIN(
                            SELECT question_likes.question_id as question_id,
                            COUNT(DISTINCT question_likes.user_id) as count_like_question
                            FROM question_likes
                            GROUP BY question_likes.question_id
                        ) AS temp_tbl2
                        ON temp_tbl2.question_id = questions.id

                        LEFT JOIN(
                        SELECT answears.question_id as question_id,
                        COUNT(answears.user_id) as count_answear
                        FROM answears
                        GROUP BY answears.question_id
                        ) AS temp_tbl3
                        ON temp_tbl3.question_id = questions.id

                        LEFT JOIN users ON users.id = questions.user_id

                     
                        WHERE ( questions.status = 1 OR questions.status =3 )
                        ORDER BY questions.updated_at desc
                        
                    ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            WHERE item IS NOT NULL
            GROUP BY username, tmp2.user_id, title, type, item ,count,count_answear,created_at,updated_at,tags,profile_photo_path)

            UNION

            (
                    SELECT tmp.user_id,tmp.username, title,item,created_at, updated_at,tags,count,count_answear,type,profile_photo_path
                    FROM (SELECT users.name as username, users.id as user_id, users.profile_photo_path
                            FROM followers
                            LEFT JOIN users ON users.id = followers.follows_id'.
                            " WHERE followers.user_id = '" . Auth::id() . "' ".
                        ' ) AS tmp
                    LEFT JOIN (
                        SELECT 
                            questions.title, 
                            questions.type, 
                         
                            questions.user_id, 
                            questions.item, 
                            questions.created_at, 
                            questions.updated_at,
                            temp_tbl.tags,
                            ifnull(temp_tbl2.count_like_question, 0) as count,
                            ifnull(temp_tbl3.count_answear, 0) as count_answear
                        FROM questions
                        LEFT JOIN (
                            SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                            FROM question_tag_grps
                            LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                            GROUP BY question_tag_grps.question_id
                        ) AS temp_tbl
                        ON temp_tbl.question_id = questions.id

                        LEFT JOIN(
                            SELECT question_likes.question_id as question_id,
                            COUNT(DISTINCT question_likes.user_id) as count_like_question
                            FROM question_likes
                            GROUP BY question_likes.question_id
                        ) AS temp_tbl2
                        ON temp_tbl2.question_id = questions.id

                        LEFT JOIN(
                        SELECT answears.question_id as question_id,
                        COUNT(answears.user_id) as count_answear
                        FROM answears
                        GROUP BY answears.question_id
                        ) AS temp_tbl3
                        ON temp_tbl3.question_id = questions.id

                        LEFT JOIN users ON questions.user_id = users.id
                        WHERE ( questions.status = 1 OR questions.status =3 )
                        ORDER BY questions.updated_at desc
                        
                    ) AS tmp2
                    ON tmp.user_id = tmp2.user_id
                    WHERE item IS NOT NULL
            GROUP BY username, tmp.user_id, title, type, item ,count,count_answear,created_at,updated_at,tags,profile_photo_path)
            ORDER BY updated_at desc';

}
        // $posts = DB::select(DB::raw($str_sql));
        // $posts = (new Collection($posts))->paginate(20);



        $posts = (new Collection(DB::select(DB::raw($str_sql))))->paginate(20);
        return view('common::Timeline.timeline',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));

    
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    //done
    public function timelineUser()
    {
        $typepage ='posts';

$str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);


        if($typepage =='posts'){
        
            $str_sql = 'SELECT '.'tmp.user_id, tmp.username, title,item,created_at, updated_at, tags,count,profile_photo_path
                        FROM (SELECT users.name as username, users.id as user_id, users.profile_photo_path
                            FROM followers
                            LEFT JOIN users ON users.id = followers.follows_id'.
                            " WHERE followers.user_id = '" . Auth::id() . "' ".
                        ' ) AS tmp
                        LEFT JOIN (
                            SELECT 
                                posts.title, 
                                posts.user_id, 
                                posts.item, 
                                posts.created_at,
                                posts.updated_at,
                                temp_tbl.tags,
                                ifnull(temp_tbl2.count_like_post, 0) as count
                            FROM posts
                            LEFT JOIN (
                                SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                                FROM post_tag_grps
                                LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                                GROUP BY post_tag_grps.post_id
                            ) AS temp_tbl
                            ON temp_tbl.post_id = posts.id

                            LEFT JOIN(
                                SELECT post_likes.post_id as post_id,
                                COUNT(DISTINCT post_likes.user_id) as count_like_post
                                FROM post_likes

                                GROUP BY post_likes.post_id
                            ) AS temp_tbl2
                            ON temp_tbl2.post_id = posts.id


                            LEFT JOIN users ON posts.user_id = users.id
                            WHERE ( posts.status = 1 OR posts.status =3 )
                            
                        ) AS tmp2
                        ON tmp.user_id = tmp2.user_id
                        WHERE item IS NOT NULL
                        ORDER BY tmp2.updated_at desc';
            }else if($typepage =='questions'){
                $str_sql = 'SELECT '.'tmp.user_id,tmp.username, title,item,created_at,updated_at,tags,count,count_answear,type,profile_photo_path
                    FROM (SELECT users.name as username, users.id as user_id, users.profile_photo_path
                            FROM followers
                            LEFT JOIN users ON users.id = followers.follows_id'.
                            " WHERE followers.user_id = '" . Auth::id() . "' ".
                        ' ) AS tmp
                    LEFT JOIN (
                        SELECT 
                            questions.title, 
                            questions.type, 
                         
                            questions.user_id, 
                            questions.item, 
                            questions.created_at,
                            questions.updated_at,
                            temp_tbl.tags,
                            ifnull(temp_tbl2.count_like_question, 0) as count,
                            ifnull(temp_tbl3.count_answear, 0) as count_answear
                        FROM questions
                        LEFT JOIN (
                            SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                            FROM question_tag_grps
                            LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                            GROUP BY question_tag_grps.question_id
                        ) AS temp_tbl
                        ON temp_tbl.question_id = questions.id

                        LEFT JOIN(
                            SELECT question_likes.question_id as question_id,
                            COUNT(DISTINCT question_likes.user_id) as count_like_question
                            FROM question_likes
                            GROUP BY question_likes.question_id
                        ) AS temp_tbl2
                        ON temp_tbl2.question_id = questions.id

                        LEFT JOIN(
                        SELECT answears.question_id as question_id,
                        COUNT(answears.user_id) as count_answear
                        FROM answears
                        GROUP BY answears.question_id
                        ) AS temp_tbl3
                        ON temp_tbl3.question_id = questions.id

                        LEFT JOIN users ON questions.user_id = users.id
                        WHERE ( questions.status = 1 OR questions.status =3 )
                        
                    ) AS tmp2
                    ON tmp.user_id = tmp2.user_id
                    WHERE item IS NOT NULL
                    ORDER BY tmp2.updated_at desc';

            }
 

    $posts = DB::select(DB::raw($str_sql));    
    $posts = (new Collection($posts))->paginate(20);




    return view('common::Timeline.timelineUser',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));

    
    }

/**
     * Display a listing of the resource.
     * @return Renderable
     */
    //done
    public function timelineTag()
    {
         $typepage ='posts';
        
$str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);
        

    if($typepage =='posts'){
        
        $str_sql = 
            'SELECT '.'tmp2.user_id, tmp2.username, title,item,created_at,updated_at,tags,count,profile_photo_path
            FROM (
                SELECT  tags.tag_name as tag_name, tag_id
                FROM tag_followers
                LEFT JOIN users ON users.id = tag_followers.user_id
                LEFT JOIN tags ON tags.id = tag_followers.tag_id'.
                " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ') AS tmp
            LEFT JOIN (
                SELECT 
                    users.name as username,
                    users.profile_photo_path,
                    posts.title, 
                    posts.user_id, 
                    posts.item, 
                    posts.created_at, 
                    posts.updated_at, 
                    temp_tbl.tags,
                    ifnull(temp_tbl2.count_like_post, 0) as count
                FROM posts
                LEFT JOIN (
                    SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM post_tag_grps
                    LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                    GROUP BY post_tag_grps.post_id
                ) AS temp_tbl
                ON temp_tbl.post_id = posts.id

                LEFT JOIN(
                    SELECT post_likes.post_id as post_id,
                    COUNT(DISTINCT post_likes.user_id) as count_like_post
                    FROM post_likes

                    GROUP BY post_likes.post_id
                ) AS temp_tbl2
                ON temp_tbl2.post_id = posts.id
                LEFT JOIN users ON users.id = posts.user_id

             
                WHERE ( posts.status = 1 OR posts.status = 3 )
                
            ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            WHERE item IS NOT NULL
            GROUP BY username, user_id, title, item ,count,created_at, updated_at,tags,profile_photo_path
            ORDER BY tmp2.updated_at desc
            ';
    }else if($typepage =='questions'){
        $typepage ='questions';
        $str_sql = 'SELECT '.'tmp2.user_id, tmp2.username, title,item,created_at,updated_at,tags,count,count_answear,type,profile_photo_path
                    FROM (
            SELECT  tags.tag_name as tag_name, tag_id, user_id
                            
            FROM tag_followers
            LEFT JOIN users ON users.id = tag_followers.user_id
            LEFT JOIN tags ON tags.id = tag_followers.tag_id'.
            " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ') AS tmp
                    LEFT JOIN (
                        SELECT 
                            questions.title, 
                            questions.type, 
                            users.name as username,
                            users.profile_photo_path,
                            questions.user_id, 
                            questions.item, 
                            questions.created_at,  
                            questions.updated_at,
                            temp_tbl.tags,
                            ifnull(temp_tbl2.count_like_question, 0) as count,
                            ifnull(temp_tbl3.count_answear, 0) as count_answear
                        FROM questions
                        LEFT JOIN (
                            SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                            FROM question_tag_grps
                            LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                            GROUP BY question_tag_grps.question_id
                        ) AS temp_tbl
                        ON temp_tbl.question_id = questions.id

                        LEFT JOIN(
                            SELECT question_likes.question_id as question_id,
                            COUNT(DISTINCT question_likes.user_id) as count_like_question
                            FROM question_likes
                            GROUP BY question_likes.question_id
                        ) AS temp_tbl2
                        ON temp_tbl2.question_id = questions.id

                        LEFT JOIN(
                        SELECT answears.question_id as question_id,
                        COUNT(answears.user_id) as count_answear
                        FROM answears
                        GROUP BY answears.question_id
                        ) AS temp_tbl3
                        ON temp_tbl3.question_id = questions.id

                        LEFT JOIN users ON users.id = questions.user_id

                     
                        WHERE ( questions.status = 1 OR questions.status = 3 )
                        
                    ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            WHERE item IS NOT NULL
            GROUP BY username, user_id, title, type,item,count,count_answear, created_at,updated_at,tags,profile_photo_path
            ORDER BY tmp2.updated_at desc
            ';
         }


      
        $posts = (new Collection(DB::select(DB::raw($str_sql))))->paginate(20);




        if ($posts) {
            return view('common::Timeline.timelineTag',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
        }else{
            abort(404);

        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    //done
    public function postTrend()
    {
$str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);
        
        $str_sql = 'SELECT '.' posts.title, users.name as username, posts.item, posts.created_at, posts.updated_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
            FROM posts
            LEFT JOIN (
                SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                FROM post_tag_grps
                LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                GROUP BY post_tag_grps.post_id
            ) AS temp_tbl
            ON temp_tbl.post_id = posts.id
            LEFT JOIN(
                SELECT post_likes.post_id as post_id,
                COUNT(DISTINCT post_likes.user_id) as count
                FROM post_likes
                GROUP BY post_likes.post_id
            ) AS temp_tbl2
            ON temp_tbl2.post_id = posts.id
            LEFT JOIN users ON posts.user_id = users.id 
            WHERE posts.updated_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
            AND ( posts.status = 1 OR posts.status = 3 )
            ORDER BY temp_tbl2.count desc
            LIMIT 20';
            // " WHERE posts.user_id ='" . $username . "' ";

    $posts = DB::select(DB::raw($str_sql));
    $typepage ='posts';



    $posts = (new Collection($posts))->paginate(20);


    return view('common::Post.postTrend',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    //done
    public function postdNewfeed()
    {
$str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);
        
        $str_sql = 'SELECT '.' posts.title, users.name as username, posts.item, posts.created_at,posts.updated_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
            FROM posts
            LEFT JOIN (
                    SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM post_tag_grps
                    LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                    GROUP BY post_tag_grps.post_id
            ) AS temp_tbl
            ON temp_tbl.post_id = posts.id
            LEFT JOIN(
                SELECT post_likes.post_id as post_id,
                COUNT(DISTINCT post_likes.user_id) as count
                FROM post_likes
                GROUP BY post_likes.post_id
            ) AS temp_tbl2
            ON temp_tbl2.post_id = posts.id
            LEFT JOIN users ON posts.user_id = users.id 
            WHERE ( posts.status = 1 OR posts.status = 3 )
            ORDER BY posts.updated_at desc
            LIMIT 20';
            // " WHERE posts.user_id ='" . $username . "' ";

    $posts = DB::select(DB::raw($str_sql));
    $typepage ='posts';

    $posts = (collect($posts))->paginate(20);



    return view('common::Post.postNewfeed',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
    }




    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function questionTimeline()
    {
 $str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);
        $str_sql = '(
            SELECT tmp2.username as username, title, type,item,created_at, updated_at,tags,count,count_answear,profile_photo_path
            FROM (
            SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id
            FROM tag_followers
            LEFT JOIN users ON users.id = tag_followers.user_id
            LEFT JOIN tags ON tags.id = tag_followers.tag_id'.

                " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ') AS tmp

            LEFT JOIN (
                SELECT 
                    questions.title, 
                    questions.type, 
                    users.name as username,
                    questions.item, 
                    questions.created_at, 
                    questions.updated_at,
                    temp_tbl.tags,
                    ifnull(temp_tbl2.count_like_question, 0) as count,
                    ifnull(temp_tbl3.count_answear, 0) as count_answear,
                    users.profile_photo_path
                FROM questions
                LEFT JOIN (
                    SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM question_tag_grps
                    LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                    GROUP BY question_tag_grps.question_id
                ) AS temp_tbl
                ON temp_tbl.question_id = questions.id

                LEFT JOIN(
                    SELECT question_likes.question_id as question_id,
                    COUNT(DISTINCT question_likes.user_id) as count_like_question
                    FROM question_likes
                    GROUP BY question_likes.question_id
                ) AS temp_tbl2
                ON temp_tbl2.question_id = questions.id

                LEFT JOIN(
                    SELECT answears.question_id as question_id,
                    COUNT(answears.user_id) as count_answear
                    FROM answears
                    GROUP BY answears.question_id
                ) AS temp_tbl3
                ON temp_tbl3.question_id = questions.id

                LEFT JOIN users ON questions.user_id = users.id
                WHERE ( questions.status = 1 OR questions.status = 3 )
                ORDER BY questions.updated_at desc

            ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            GROUP BY username, title, type, item ,created_at, updated_at,tags,profile_photo_path)

            UNION

            (
            SELECT tmp.username, title, type,item,created_at, updated_at,tags,count,count_answear,profile_photo_path
            FROM SELECT users.name as username
                FROM followers
                LEFT JOIN 
                users
                ON users.id = followers.user_id '.
                " WHERE followers.follows_id = '" . Auth::id() . "' ".
            ' ) AS tmp
            LEFT JOIN (
                SELECT 
                    questions.title, 
                    questions.type, 
                    users.name as username, 
                    questions.item, 
                    questions.created_at,
                    questions.updated_at
                    temp_tbl.tags,
                    ifnull(temp_tbl2.count_like_question, 0) as count,
                    ifnull(temp_tbl3.count_answear, 0) as count_answear,
                    users.profile_photo_path
                FROM questions
                LEFT JOIN (
                    SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM question_tag_grps
                    LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                    GROUP BY question_tag_grps.question_id
                ) AS temp_tbl
                ON temp_tbl.question_id = questions.id

                LEFT JOIN(
                SELECT question_likes.question_id as question_id,
                COUNT(DISTINCT question_likes.user_id) as count_like_question
                FROM question_likes
                GROUP BY question_likes.question_id
                ) AS temp_tbl2
                ON temp_tbl2.question_id = questions.id

                LEFT JOIN(
                SELECT answears.question_id as question_id,
                COUNT(answears.user_id) as count_answear
                FROM answears
                GROUP BY answears.question_id
                ) AS temp_tbl3
                ON temp_tbl3.question_id = questions.id

                LEFT JOIN users ON questions.user_id = users.name
                WHERE ( questions.status = 1 OR questions.status = 3 )
                ORDER BY questions.updated_at desc
            ) AS tmp2
            ON tmp.username = tmp2.username
            WHERE item IS NOT NULL
            GROUP BY username, title, type, item ,created_at,updated_at,tags,profile_photo_path)
            ORDER BY updated_at desc';

     
    $posts = DB::select(DB::raw($str_sql));

    
    $typepage = "questions";

    $posts = (new Collection($posts))->paginate(20);
    return view('common::Question.questionTimeline',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    //done
    public function questionTrend()
    {
$str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);
        $str_sql = 'SELECT '.' questions.title, questions.type, users.name as username , questions.item, questions.created_at, questions.updated_at, temp_tbl.tags,
            ifnull(temp_tbl2.count_like_question, 0) as count,
            ifnull(temp_tbl3.count_answear, 0) as count_answear,
            users.profile_photo_path

            FROM questions

            LEFT JOIN (
                    SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM question_tag_grps
                    LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                    GROUP BY question_tag_grps.question_id
            ) AS temp_tbl
            ON temp_tbl.question_id = questions.id

            LEFT JOIN(
            SELECT question_likes.question_id as question_id,
            COUNT(DISTINCT question_likes.user_id) as count_like_question
            FROM question_likes
            GROUP BY question_likes.question_id
            ) AS temp_tbl2
            ON temp_tbl2.question_id = questions.id

            LEFT JOIN(
            SELECT answears.question_id as question_id,
            COUNT(answears.user_id) as count_answear
            FROM answears
            GROUP BY answears.question_id
            ) AS temp_tbl3
            ON temp_tbl3.question_id = questions.id

            LEFT JOIN users ON questions.user_id = users.id
            WHERE questions.updated_at>= DATE_SUB(now(), INTERVAL 10 DAY)
            AND ( questions.status = 1 OR questions.status = 3 )

            ORDER BY (count + count_answear) desc
            LIMIT 20 ';
      
    $posts = DB::select(DB::raw($str_sql));
    
    $typepage = "questions";

    $posts = (new Collection($posts))->paginate(20);
    return view('common::Question.questionTrend',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
    }

    //done
    public function questionWaitingAnswers()
    {
$str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);
        
        $str_sql = 'SELECT '.' questions.title, questions.type, users.name as username , questions.item, questions.created_at, questions.updated_at,temp_tbl.tags,
            ifnull(temp_tbl2.count_like_question, 0) as count,
            ifnull(temp_tbl3.count_answear, 0) as count_answear,
            users.profile_photo_path

            FROM questions

            LEFT JOIN (
                    SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM question_tag_grps
                    LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                    GROUP BY question_tag_grps.question_id
            ) AS temp_tbl
            ON temp_tbl.question_id = questions.id

            LEFT JOIN(
            SELECT question_likes.question_id as question_id,
            COUNT(DISTINCT question_likes.user_id) as count_like_question
            FROM question_likes
            GROUP BY question_likes.question_id
            ) AS temp_tbl2
            ON temp_tbl2.question_id = questions.id

            LEFT JOIN(
            SELECT answears.question_id as question_id,
            COUNT(answears.user_id) as count_answear
            FROM answears
            GROUP BY answears.question_id
            ) AS temp_tbl3
            ON temp_tbl3.question_id = questions.id

            LEFT JOIN users ON questions.user_id = users.id
            WHERE questions.updated_at>= DATE_SUB(now(), INTERVAL 10 DAY)
            AND ( questions.status = 1 OR questions.status = 3 )

            ORDER BY RAND()
            LIMIT 20 ';
    $posts = DB::select(DB::raw($str_sql));
   


    $posts = (new Collection($posts))->paginate(20);
    $typepage ='questions';

    return view('common::Question.waitingAnswear',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
    }


    //done
    public function questionNewFeed()
    {
$str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $TagRankWeekly = json_decode(json_encode($TagRankWeekly), true);


        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $UserRankWeekly = json_decode(json_encode($UserRankWeekly), true);
        
        $str_sql = 'SELECT '.'
            questions.title, questions.type, users.name as username, questions.item, questions.created_at, questions.updated_at, temp_tbl.tags,
            ifnull(temp_tbl2.count_like_question, 0) as count,
            ifnull(temp_tbl3.count_answear, 0) as count_answear,
            users.profile_photo_path

            FROM questions

            LEFT JOIN (
                    SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM question_tag_grps
                    LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                    GROUP BY question_tag_grps.question_id
            ) AS temp_tbl
            ON temp_tbl.question_id = questions.id

            LEFT JOIN(
            SELECT question_likes.question_id as question_id,
            COUNT(DISTINCT question_likes.user_id) as count_like_question
            FROM question_likes
            GROUP BY question_likes.question_id
            ) AS temp_tbl2
            ON temp_tbl2.question_id = questions.id

            LEFT JOIN(
            SELECT answears.question_id as question_id,
            COUNT(answears.user_id) as count_answear
            FROM answears
            GROUP BY answears.question_id
            ) AS temp_tbl3
            ON temp_tbl3.question_id = questions.id

            LEFT JOIN users ON questions.user_id = users.id
            WHERE ( questions.status = 1 OR questions.status = 3 )

            ORDER BY questions.updated_at desc';
    $posts = DB::select(DB::raw($str_sql));
   


    $posts = (new Collection($posts))->paginate(20);
    $typepage ='questions';

    return view('common::Question.questionNewFeed',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
    }





    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function tagPage($tag_name)
    {
        $tags = Tag::where('tag_name',$tag_name)->first();
        $tag_id =  $tags ->id;

        $str_sql= 'SELECT '.'tags.tag_name, ifnull(COUNT(user_id), 0) as count_user
        FROM tag_followers
        LEFT JOIN tags
        ON tags.id = tag_followers.tag_id '.
        " WHERE tag_followers.tag_id ='" . $tag_id . "' ".
        ' GROUP BY tags.tag_name LIMIT 1';
        $tag_follower = DB::select(DB::raw($str_sql));

   
        $str_sql= 'SELECT '.' tags.tag_name, ifnull(COUNT(post_id), 0) as count_post
        FROM post_tag_grps
        LEFT JOIN tags
        ON tags.id = post_tag_grps.tag_id'.
        " WHERE post_tag_grps.tag_id  ='" . $tag_id . "' ".
        ' GROUP BY tags.tag_name LIMIT 1' ;


        $tag_postcount = DB::select(DB::raw($str_sql));
   
        //Lấy user ranking theo tag theo tuần
        $str_sql=
        "select temp.username, temp.fullname, temp.profile_photo_path,
        (post_count +(comments_count+questions_count)*0.1+answears_count*0.2 + self_like_post_count + (self_like_question_count + self_like_answear_count + self_like_comment_count)*0.5) as contribution
from (SELECT  users.name as username, users.fullname as fullname, ifnull(users.profile_photo_path,'') as profile_photo_path, 
        ifnull(post_count, 0) as post_count,
        ifnull(questions_count, 0) as questions_count,
        ifnull(answears_count, 0) as answears_count,
        ifnull(comments_count, 0) as comments_count,
        ifnull(self_like_post_count, 0) as self_like_post_count,
        ifnull(self_like_question_count, 0) as self_like_question_count,
        ifnull(self_like_answear_count, 0) as self_like_answear_count,
        ifnull(self_like_comment_count, 0) as self_like_comment_count

        FROM users
        LEFT JOIN (
        SELECT post_tag_grps.user_id, count(post_tag_grps.post_id) as post_count ".
        'FROM post_tag_grps LEFT JOIN posts ON post_tag_grps.post_id = posts.id '.
            "WHERE post_tag_grps.tag_id ='" . $tag_id . "' ".
            'AND post_tag_grps.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
             AND (posts.status = 1 OR posts.status = 3)
            GROUP BY user_id
        ) AS post_count
        ON post_count.user_id = users.id


        LEFT JOIN(
            SELECT question_tag_grps.user_id, count(question_tag_grps.question_id) as questions_count
            FROM question_tag_grps LEFT JOIN questions ON question_tag_grps.question_id = questions.id '.
            " WHERE question_tag_grps.tag_id ='" . $tag_id . "' ".
            'AND question_tag_grps.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
            AND (questions.status = 1 OR questions.status = 3) 
            GROUP BY user_id
        ) AS questions_count
        ON questions_count.user_id = users.id

        LEFT JOIN(
            SELECT comments.user_id,count(tag_count) as comments_count
            FROM comments
            LEFT JOIN (
                SELECT post_tag_grps.post_id as post_id, count(post_tag_grps.tag_id) as tag_count
                FROM post_tag_grps LEFT JOIN posts ON post_tag_grps.post_id = posts.id '.
                "WHERE post_tag_grps.tag_id ='" . $tag_id . "' ".
                'AND post_tag_grps.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
                AND (posts.status = 1 OR posts.status = 3) 
                GROUP BY post_id
            ) AS tag_count
            ON tag_count.post_id = comments.post_id
            GROUP BY comments.user_id
        ) AS comments_count
        ON comments_count.user_id = users.id

        LEFT JOIN(
            SELECT answears.user_id,count(tag_count) as answears_count
            FROM answears

            LEFT JOIN (
                SELECT question_tag_grps.user_id as user_id,question_tag_grps.question_id as question_id, count(question_tag_grps.tag_id) as tag_count
                FROM question_tag_grps LEFT JOIN questions ON question_tag_grps.question_id = questions.id '.
                " WHERE question_tag_grps.tag_id ='" . $tag_id . "' ".
                'AND question_tag_grps.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                AND (questions.status = 1 OR questions.status = 3) 
        GROUP BY user_id,question_id
    ) AS tag_count
    ON tag_count.question_id = answears.question_id
    GROUP BY user_id
) AS answears_count
ON answears_count.user_id = users.id
LEFT JOIN(

    SELECT answear_likes.user_id as user_id,count(tag_count) as self_like_answear_count
    FROM answear_likes

    LEFT JOIN (
        SELECT question_tag_grps.question_id as question_id, count(question_tag_grps.tag_id) as tag_count
        FROM question_tag_grps LEFT JOIN questions ON question_tag_grps.question_id = questions.id '.
                " WHERE question_tag_grps.tag_id ='" . $tag_id . "' ".
                'AND question_tag_grps.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                AND (questions.status = 1 OR questions.status = 3) 
        GROUP BY question_id
    ) AS tag_count
    ON tag_count.question_id = answear_likes.question_id
   
    GROUP BY user_id
) AS self_like_answear_count
ON self_like_answear_count.user_id = users.id
LEFT JOIN(

    SELECT comment_likes.user_id as user_id,count(tag_count) as self_like_comment_count
    FROM comment_likes

    LEFT JOIN (
        SELECT post_tag_grps.post_id as post_id, count(post_tag_grps.tag_id) as tag_count
        FROM post_tag_grps LEFT JOIN posts ON post_tag_grps.post_id = posts.id '.
                "WHERE post_tag_grps.tag_id ='" . $tag_id . "' ".
                'AND post_tag_grps.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
                AND (posts.status = 1 OR posts.status = 3) 
        GROUP BY post_id
    ) AS tag_count
    ON tag_count.post_id = comment_likes.post_id

    GROUP BY user_id
) AS self_like_comment_count
ON self_like_comment_count.user_id = users.id
LEFT JOIN(

    SELECT post_likes.user_id as user_id,count(tag_count) as self_like_post_count
    FROM post_likes

    LEFT JOIN (
        SELECT post_tag_grps.post_id as post_id, count(post_tag_grps.tag_id) as tag_count
        FROM post_tag_grps LEFT JOIN posts ON post_tag_grps.post_id = posts.id '.
                "WHERE post_tag_grps.tag_id ='" . $tag_id . "' ".
                'AND post_tag_grps.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
                AND (posts.status = 1 OR posts.status = 3) 
        GROUP BY post_id
    ) AS tag_count
    ON tag_count.post_id = post_likes.post_id
 
    GROUP BY user_id
) AS self_like_post_count
ON self_like_post_count.user_id = users.id
LEFT JOIN(

    SELECT question_likes.user_id as user_id,count(tag_count) as self_like_question_count
    FROM question_likes

    LEFT JOIN (
        SELECT question_tag_grps.question_id as question_id, count(question_tag_grps.tag_id) as tag_count
        FROM question_tag_grps LEFT JOIN questions ON question_tag_grps.question_id = questions.id '.
                " WHERE question_tag_grps.tag_id ='" . $tag_id . "' ". 
                'AND question_tag_grps.updated_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                AND (questions.status = 1 OR questions.status = 3) 
        GROUP BY question_id
    ) AS tag_count
    ON tag_count.question_id = question_likes.question_id

    GROUP BY user_id
) AS self_like_question_count
ON self_like_question_count.user_id = users.id
) AS temp
GROUP BY username, temp.fullname, profile_photo_path, temp.post_count,temp.questions_count,temp.answears_count, temp.comments_count,temp.self_like_post_count,temp.self_like_question_count,temp.self_like_answear_count,temp.self_like_comment_count
ORDER BY contribution desc';


        $tagUserRankWeekly = DB::select(DB::raw($str_sql));
        // Đổi tên theo function chung
        $UserRankWeekly = json_decode(json_encode($tagUserRankWeekly), true);

 
        //Lấy post của tag theo newfeed
        $str_sql2 = 'SELECT '.' posts.title, posts.user_id, posts.item, posts.created_at, posts.updated_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path, users.name as username
        FROM posts
        LEFT JOIN (
                    SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM post_tag_grps
                    LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                    GROUP BY post_tag_grps.post_id
        ) AS temp_tbl
        ON temp_tbl.post_id = posts.id
        LEFT JOIN(
            SELECT post_likes.post_id as post_id,
            COUNT(DISTINCT post_likes.user_id) as count
            FROM post_likes
            GROUP BY post_likes.post_id
        ) AS temp_tbl2
        ON temp_tbl2.post_id = posts.id
        LEFT JOIN users ON posts.user_id = users.id
        WHERE ( posts.status = 1 OR posts.status = 3 ) '.
        " AND LOCATE( '".$tags ->tag_name. "' ,tags) ".
        ' ORDER BY posts.updated_at desc';
        // " WHERE posts.user_id ='" . $username . "' ";



        //Lấy post của tag theo trend
        $str_sql3 = 'SELECT '.' posts.title, posts.user_id, posts.item, posts.created_at, posts.updated_at,temp_tbl.tags,temp_tbl2.count,users.profile_photo_path,users.name as username
        FROM posts
        LEFT JOIN (
                    SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM post_tag_grps
                    LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                    GROUP BY post_tag_grps.post_id
        ) AS temp_tbl
        ON temp_tbl.post_id = posts.id
        LEFT JOIN(
            SELECT post_likes.post_id as post_id,
            COUNT(DISTINCT post_likes.user_id) as count
            FROM post_likes
            GROUP BY post_likes.post_id
        ) AS temp_tbl2
        ON temp_tbl2.post_id = posts.id
        LEFT JOIN users ON posts.user_id = users.id 
        WHERE ( posts.status = 1 OR posts.status = 3 ) '.
        " AND LOCATE( '".$tags ->tag_name. "' ,tags) ".
        ' ORDER BY temp_tbl2.count desc
        LIMIT 5';
        // " WHERE posts.user_id ='" . $username . "' ";

    $posts = DB::select(DB::raw($str_sql2));
    // $posts = json_decode(json_encode($posts), true);

    $posts = (new Collection($posts))->paginate(20);

    $post_trends = DB::select(DB::raw($str_sql3));
    $post_trends = (new Collection($post_trends));
    // $posts = json_decode(json_encode($posts), true);


 

    $checkFollowTag=false;
    if (Auth::check()) {
        $taketag = Tag::where('tag_name', $tag_name)->first();
        
        $checktag=TagFollower::where("tag_id", $taketag['id'])
                    ->where('user_id', Auth::id() )
                    ->first();
                 
        if(isset($checktag)){
            $checkFollowTag=true;
        }

    }


    return view('common::Tag.Tags',compact('UserRankWeekly','posts','tags','checkFollowTag','post_trends','tag_follower','tag_postcount'));

       
    }    

 
}
