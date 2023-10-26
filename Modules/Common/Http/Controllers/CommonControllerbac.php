<?php

namespace Modules\Common\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


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
            'SELECT '. ' posts.title, users.name as username, posts.item,posts.content, posts.created_at,posts.updated_at, temp_tbl.tags, ifnull(temp_tbl2.countlike, 0) as countlike , ifnull(temp_tbl3.countcomment, 0) as countcomment , users.profile_photo_path, users.fullname
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

            " WHERE `title` LIKE '%".$keyword."%' ".
            " OR users.name  LIKE '%".$keyword."%' ". 
            " OR `content`  LIKE '%".$keyword."%' ".
            ' ORDER BY (countlike + countcomment) desc';




            $posts = DB::select(DB::raw($str_sql));
            $posts = (new Collection($posts))->paginate(20);   

            
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

        


        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();

        if($typepage =='posts'){
        
        $str_sql = '(WITH tmp AS (
            SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id
            FROM tag_followers
            LEFT JOIN users ON users.id = tag_followers.user_id
            LEFT JOIN tags ON tags.id = tag_followers.tag_id'.
            " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ')
            SELECT tmp2.author as username, title,item,created_at,tags,count,profile_photo_path
            FROM tmp

            LEFT JOIN (
                SELECT 
                posts.title, 
                
                posts.username as author, 
                posts.item, 
                posts.created_at, 
                temp_tbl.tags,
                ifnull(temp_tbl2.count_like_post, 0) as count,
         
                users.profile_photo_path
                FROM posts
                LEFT JOIN (
                    SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
                    FROM post_tag_grps
                    GROUP BY post_tag_grps.item
                ) AS temp_tbl
                ON temp_tbl.item = posts.item

                LEFT JOIN(
                    SELECT post_likes.item as item,
                    COUNT(DISTINCT post_likes.like_username) as count_like_post
                    FROM post_likes
                    GROUP BY post_likes.item
                ) AS temp_tbl2
                ON temp_tbl2.item = posts.item



                LEFT JOIN users ON posts.username = users.name
                WHERE posts.status = 1
                ORDER BY posts.created_at desc

            ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            WHERE item IS NOT NULL
            GROUP BY username, title,  item ,created_at,tags,profile_photo_path)

            UNION

            (WITH tmp AS (SELECT users.name as username
                FROM followers
                LEFT JOIN 
                users
                ON users.id = followers.user_id '.
                " WHERE followers.follows_id = '" . Auth::id() . "' ".
            ' )
            SELECT tmp.username, title,item,created_at,tags,count,profile_photo_path
            FROM tmp
            LEFT JOIN (
                SELECT 
                posts.title, 
                
                posts.username as author, 
                posts.item, 
                posts.created_at, 
                temp_tbl.tags,
                ifnull(temp_tbl2.count_like_post, 0) as count,
            
                users.profile_photo_path
                FROM posts
                LEFT JOIN (
                SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
                FROM post_tag_grps
                GROUP BY post_tag_grps.item
                ) AS temp_tbl
                ON temp_tbl.item = posts.item

                LEFT JOIN(
                SELECT post_likes.item as item,
                COUNT(DISTINCT post_likes.like_username) as count_like_post
                FROM post_likes
                GROUP BY post_likes.item
                ) AS temp_tbl2
                ON temp_tbl2.item = posts.item



                LEFT JOIN users ON posts.username = users.name
                WHERE posts.status = 1
                ORDER BY posts.created_at desc
            ) AS tmp2
            ON tmp.username = tmp2.author
            WHERE item IS NOT NULL
            GROUP BY username, title, item ,created_at,tags,profile_photo_path)
            ORDER BY created_at desc';

}else if($typepage =='questions'){
    $str_sql = '(WITH tmp AS (
            SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id
            FROM tag_followers
            LEFT JOIN users ON users.id = tag_followers.user_id
            LEFT JOIN tags ON tags.id = tag_followers.tag_id'.

                " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ')
            SELECT tmp2.author as username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
            FROM tmp

            LEFT JOIN (
                SELECT 
                questions.title, 
                questions.type, 
                questions.username as author, 
                questions.item, 
                questions.created_at, 
                temp_tbl.tags,
                ifnull(temp_tbl2.count_like_question, 0) as count,
                ifnull(temp_tbl3.count_answear, 0) as count_answear,
                users.profile_photo_path
                FROM questions
                LEFT JOIN (
                    SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
                    FROM question_tag_grps
                    GROUP BY question_tag_grps.item
                ) AS temp_tbl
                ON temp_tbl.item = questions.item

                LEFT JOIN(
                    SELECT question_likes.item as item,
                    COUNT(DISTINCT question_likes.like_username) as count_like_question
                    FROM question_likes
                    GROUP BY question_likes.item
                ) AS temp_tbl2
                ON temp_tbl2.item = questions.item

                LEFT JOIN(
                    SELECT answears.item as item,
                    COUNT(answears.username) as count_answear
                    FROM answears
                    GROUP BY answears.item
                ) AS temp_tbl3
                ON temp_tbl3.item = questions.item

                LEFT JOIN users ON questions.username = users.name
                WHERE questions.status = 1
                ORDER BY questions.created_at desc

            ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            GROUP BY username, title, type, item ,created_at,tags,profile_photo_path)

            UNION

            (WITH tmp AS (SELECT users.name as username
                FROM followers
                LEFT JOIN 
                users
                ON users.id = followers.user_id'.
                " WHERE followers.follows_id = '" . Auth::id() . "' ".
            ' )
            SELECT tmp.username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
            FROM tmp
            LEFT JOIN (
                SELECT 
                questions.title, 
                questions.type, 
                questions.username as author, 
                questions.item, 
                questions.created_at, 
                temp_tbl.tags,
                ifnull(temp_tbl2.count_like_question, 0) as count,
                ifnull(temp_tbl3.count_answear, 0) as count_answear,
                users.profile_photo_path
                FROM questions
                LEFT JOIN (
                SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
                FROM question_tag_grps
                GROUP BY question_tag_grps.item
                ) AS temp_tbl
                ON temp_tbl.item = questions.item

                LEFT JOIN(
                SELECT question_likes.item as item,
                COUNT(DISTINCT question_likes.like_username) as count_like_question
                FROM question_likes
                GROUP BY question_likes.item
                ) AS temp_tbl2
                ON temp_tbl2.item = questions.item

                LEFT JOIN(
                SELECT answears.item as item,
                COUNT(answears.username) as count_answear
                FROM answears
                GROUP BY answears.item
                ) AS temp_tbl3
                ON temp_tbl3.item = questions.item

                LEFT JOIN users ON questions.username = users.name
                WHERE questions.status = 1
                ORDER BY questions.created_at desc
            ) AS tmp2
            ON tmp.username = tmp2.author
            WHERE item IS NOT NULL
            GROUP BY username, title, type, item ,created_at,tags,profile_photo_path)
            ORDER BY created_at desc';

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

        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();


        if($typepage =='posts'){
        
            $str_sql = 'WITH tmp AS (SELECT users.name as username
                        FROM followers
                        LEFT JOIN 
                        users
                        ON users.id = followers.user_id'.
                        " WHERE followers.follows_id = '" . Auth::id() . "' ".
                        ' )
                        SELECT tmp.username, title,item,created_at,tags,count,profile_photo_path
                        FROM tmp
                        LEFT JOIN (
                            SELECT 
                            posts.title, 
                         
                            posts.username as author, 
                            posts.item, 
                            posts.created_at, 
                            temp_tbl.tags,
                            ifnull(temp_tbl2.count_like_post, 0) as count,
                    
                            users.profile_photo_path
                            FROM posts
                            LEFT JOIN (
                            SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
                            FROM post_tag_grps
                            
                            GROUP BY post_tag_grps.item
                            ) AS temp_tbl
                            ON temp_tbl.item = posts.item

                            LEFT JOIN(
                            SELECT post_likes.item as item,
                            COUNT(DISTINCT post_likes.like_username) as count_like_post
                            FROM post_likes

                            GROUP BY post_likes.item
                            ) AS temp_tbl2
                            ON temp_tbl2.item = posts.item


                            LEFT JOIN users ON posts.username = users.name
                            WHERE posts.status = 1
                            
                        ) AS tmp2
                        ON tmp.username = tmp2.author
                        WHERE item IS NOT NULL
                        ORDER BY tmp2.created_at desc';
            }else if($typepage =='questions'){
                $str_sql = 'WITH tmp AS (SELECT users.name as username
                    FROM followers
                    LEFT JOIN 
                    users
                    ON users.id = followers.user_id'.
                    " WHERE followers.follows_id = '" . Auth::id() . "' ".
                    ' )
                    SELECT tmp.username, title,item,created_at,tags,count,count_answear,type,profile_photo_path
                    FROM tmp
                    LEFT JOIN (
                        SELECT 
                        questions.title, 
                        questions.type, 
                     
                        questions.username as author, 
                        questions.item, 
                        questions.created_at, 
                        temp_tbl.tags,
                        ifnull(temp_tbl2.count_like_question, 0) as count,
                        ifnull(temp_tbl3.count_answear, 0) as count_answear,
                        users.profile_photo_path
                        FROM questions
                        LEFT JOIN (
                        SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags

                        FROM question_tag_grps
                        GROUP BY question_tag_grps.item
                        ) AS temp_tbl
                        ON temp_tbl.item = questions.item

                        LEFT JOIN(
                        SELECT question_likes.item as item,
                        COUNT(DISTINCT question_likes.like_username) as count_like_question
                        FROM question_likes
                        GROUP BY question_likes.item
                        ) AS temp_tbl2
                        ON temp_tbl2.item = questions.item

                        LEFT JOIN(
                        SELECT answears.item as item,
                        COUNT(answears.username) as count_answear
                        FROM answears
                        GROUP BY answears.item
                        ) AS temp_tbl3
                        ON temp_tbl3.item = questions.item

                        LEFT JOIN users ON questions.username = users.name
                        WHERE questions.status = 1
                        
                    ) AS tmp2
                    ON tmp.username = tmp2.author
                    WHERE item IS NOT NULL
                    ORDER BY tmp2.created_at desc';

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
        
        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        

    if($typepage =='posts'){
        
        $str_sql = 'WITH tmp AS (
            SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id
            FROM tag_followers
            LEFT JOIN users ON users.id = tag_followers.user_id
            LEFT JOIN tags ON tags.id = tag_followers.tag_id'.
            " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ')
            SELECT tmp2.author as username, title,item,created_at,tags,count,count_answear,profile_photo_path
            FROM tmp

            LEFT JOIN (
                SELECT 
                posts.title, 

                posts.username as author, 
                posts.item, 
                posts.created_at, 
                temp_tbl.tags,
                ifnull(temp_tbl2.count_like_post, 0) as count,
                ifnull(temp_tbl3.count_answear, 0) as count_answear,
                users.profile_photo_path
                FROM posts
                LEFT JOIN (
                    SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
                    FROM post_tag_grps
                    GROUP BY post_tag_grps.item
                ) AS temp_tbl
                ON temp_tbl.item = posts.item

                LEFT JOIN(
                    SELECT post_likes.item as item,
                    COUNT(DISTINCT post_likes.like_username) as count_like_post
                    FROM post_likes
                    GROUP BY post_likes.item
                ) AS temp_tbl2
                ON temp_tbl2.item = posts.item

                LEFT JOIN(
                    SELECT answears.item as item,
                    COUNT(answears.username) as count_answear
                    FROM answears
                    GROUP BY answears.item
                ) AS temp_tbl3
                ON temp_tbl3.item = posts.item

                LEFT JOIN users ON posts.username = users.name
                WHERE posts.status = 1
               

            ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            WHERE item IS NOT NULL
            GROUP BY username, title, item ,created_at,tags,profile_photo_path
            ORDER BY posts.created_at desc
            ';
    }else if($typepage =='questions'){
        $typepage ='questions';
        $str_sql = 'WITH tmp AS (
            SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id
            FROM tag_followers
            LEFT JOIN users ON users.id = tag_followers.user_id
            LEFT JOIN tags ON tags.id = tag_followers.tag_id'.
            " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ')
            SELECT tmp2.author as username,type, title,item,created_at,tags,count,count_answear,profile_photo_path
            FROM tmp

            LEFT JOIN (
                SELECT 
                questions.title, 
                questions.type, 

                questions.username as author, 
                questions.item, 
                questions.created_at, 
                temp_tbl.tags,
                ifnull(temp_tbl2.count_like_question, 0) as count,
                ifnull(temp_tbl3.count_answear, 0) as count_answear,
                users.profile_photo_path
                FROM questions
                LEFT JOIN (
                    SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
                    FROM question_tag_grps
                    GROUP BY question_tag_grps.item
                ) AS temp_tbl
                ON temp_tbl.item = questions.item

                LEFT JOIN(
                    SELECT question_likes.item as item,
                    COUNT(DISTINCT question_likes.like_username) as count_like_question
                    FROM question_likes
                    GROUP BY question_likes.item
                ) AS temp_tbl2
                ON temp_tbl2.item = questions.item

                LEFT JOIN(
                    SELECT answears.item as item,
                    COUNT(answears.username) as count_answear
                    FROM answears
                    GROUP BY answears.item
                ) AS temp_tbl3
                ON temp_tbl3.item = questions.item

                LEFT JOIN users ON questions.username = users.name
                WHERE questions.status = 1
          
                

            ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            WHERE item IS NOT NULL
            GROUP BY username, title, type,item ,created_at,tags,profile_photo_path
            ORDER BY questions.created_at desc
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
        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        
        $str_sql = 'SELECT '.' posts.title, users.name as username, posts.item, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
            WHERE posts.created_at>=SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))
            AND posts.status = 1
            ORDER BY temp_tbl2.count desc
            LIMIT 20';
            // " WHERE posts.username ='" . $username . "' ";

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
        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        
        $str_sql = 'SELECT '.' posts.title, users.name as username, posts.item, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
            WHERE posts.status = 1
            ORDER BY posts.created_at desc
            LIMIT 20';
            // " WHERE posts.username ='" . $username . "' ";

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
        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        $str_sql = '(WITH tmp AS (
            SELECT users.name as username, tags.tag_name as tag_name, tag_id, user_id
            FROM tag_followers
            LEFT JOIN users ON users.id = tag_followers.user_id
            LEFT JOIN tags ON tags.id = tag_followers.tag_id'.

                " WHERE tag_followers.user_id = '" . Auth::id() . "' ".
            ')
            SELECT tmp2.author as username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
            FROM tmp

            LEFT JOIN (
                SELECT 
                questions.title, 
                questions.type, 
                questions.username as author, 
                questions.item, 
                questions.created_at, 
                temp_tbl.tags,
                ifnull(temp_tbl2.count_like_question, 0) as count,
                ifnull(temp_tbl3.count_answear, 0) as count_answear,
                users.profile_photo_path
                FROM questions
                LEFT JOIN (
                    SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
                    FROM question_tag_grps
                    GROUP BY question_tag_grps.item
                ) AS temp_tbl
                ON temp_tbl.item = questions.item

                LEFT JOIN(
                    SELECT question_likes.item as item,
                    COUNT(DISTINCT question_likes.like_username) as count_like_question
                    FROM question_likes
                    GROUP BY question_likes.item
                ) AS temp_tbl2
                ON temp_tbl2.item = questions.item

                LEFT JOIN(
                    SELECT answears.item as item,
                    COUNT(answears.username) as count_answear
                    FROM answears
                    GROUP BY answears.item
                ) AS temp_tbl3
                ON temp_tbl3.item = questions.item

                LEFT JOIN users ON questions.username = users.name
                WHERE questions.status = 1
                ORDER BY questions.created_at desc

            ) AS tmp2
            ON LOCATE(tmp.tag_name,tmp2.tags)
            GROUP BY username, title, type, item ,created_at,tags,profile_photo_path)

            UNION

            (WITH tmp AS (SELECT users.name as username
                FROM followers
                LEFT JOIN 
                users
                ON users.id = followers.user_id '.
                " WHERE followers.follows_id = '" . Auth::id() . "' ".
            ' )
            SELECT tmp.username, title, type,item,created_at,tags,count,count_answear,profile_photo_path
            FROM tmp
            LEFT JOIN (
                SELECT 
                questions.title, 
                questions.type, 
                questions.username as author, 
                questions.item, 
                questions.created_at, 
                temp_tbl.tags,
                ifnull(temp_tbl2.count_like_question, 0) as count,
                ifnull(temp_tbl3.count_answear, 0) as count_answear,
                users.profile_photo_path
                FROM questions
                LEFT JOIN (
                SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
                FROM question_tag_grps
                GROUP BY question_tag_grps.item
                ) AS temp_tbl
                ON temp_tbl.item = questions.item

                LEFT JOIN(
                SELECT question_likes.item as item,
                COUNT(DISTINCT question_likes.like_username) as count_like_question
                FROM question_likes
                GROUP BY question_likes.item
                ) AS temp_tbl2
                ON temp_tbl2.item = questions.item

                LEFT JOIN(
                SELECT answears.item as item,
                COUNT(answears.username) as count_answear
                FROM answears
                GROUP BY answears.item
                ) AS temp_tbl3
                ON temp_tbl3.item = questions.item

                LEFT JOIN users ON questions.username = users.name
                WHERE questions.status = 1
                ORDER BY questions.created_at desc
            ) AS tmp2
            ON tmp.username = tmp2.author
            WHERE item IS NOT NULL
            GROUP BY username, title, type, item ,created_at,tags,profile_photo_path)
            ORDER BY created_at desc';
      
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
        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        $str_sql = 'SELECT '.' questions.title, questions.type, questions.username, questions.item, questions.created_at, temp_tbl.tags,
            ifnull(temp_tbl2.count_like_question, 0) as count,
            ifnull(temp_tbl3.count_answear, 0) as count_answear,
            users.profile_photo_path

            FROM questions

            LEFT JOIN (
            SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
            FROM question_tag_grps
            GROUP BY question_tag_grps.item
            ) AS temp_tbl
            ON temp_tbl.item = questions.item

            LEFT JOIN(
            SELECT question_likes.item as item,
            COUNT(DISTINCT question_likes.like_username) as count_like_question
            FROM question_likes
            GROUP BY question_likes.item
            ) AS temp_tbl2
            ON temp_tbl2.item = questions.item

            LEFT JOIN(
            SELECT answears.item as item,
            COUNT(answears.username) as count_answear
            FROM answears
            GROUP BY answears.item
            ) AS temp_tbl3
            ON temp_tbl3.item = questions.item

            LEFT JOIN users ON questions.username = users.name
            WHERE questions.created_at>= DATE_SUB(now(), INTERVAL 10 DAY)
            AND questions.status = 1

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
        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        
        $str_sql = 'SELECT '.'
            questions.title, questions.type, questions.username, questions.item, questions.created_at, temp_tbl.tags,
            ifnull(temp_tbl2.count_like_question, 0) as count,
            ifnull(temp_tbl3.count_answear, 0) as count_answear,
            users.profile_photo_path

            FROM questions

            LEFT JOIN (
            SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
            FROM question_tag_grps
            GROUP BY question_tag_grps.item
            ) AS temp_tbl
            ON temp_tbl.item = questions.item

            LEFT JOIN(
            SELECT question_likes.item as item,
            COUNT(DISTINCT question_likes.like_username) as count_like_question
            FROM question_likes
            GROUP BY question_likes.item
            ) AS temp_tbl2
            ON temp_tbl2.item = questions.item

            LEFT JOIN(
            SELECT answears.item as item,
            COUNT(answears.username) as count_answear
            FROM answears
            GROUP BY answears.item
            ) AS temp_tbl3
            ON temp_tbl3.item = questions.item

            LEFT JOIN users ON questions.username = users.name

            WHERE count_answear IS NULL
            AND questions.status = 1
            ORDER BY RAND()
            LIMIT 20';
    $posts = DB::select(DB::raw($str_sql));
   


    $posts = (new Collection($posts))->paginate(20);
    $typepage ='questions';

    return view('common::Question.waitingAnswear',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
    }


    //done
    public function questionNewFeed()
    {
        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        
        $str_sql = 'SELECT '.'
            questions.title, questions.type, questions.username, questions.item, questions.created_at, temp_tbl.tags,
            ifnull(temp_tbl2.count_like_question, 0) as count,
            ifnull(temp_tbl3.count_answear, 0) as count_answear,
            users.profile_photo_path

            FROM questions

            LEFT JOIN (
            SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
            FROM question_tag_grps
            GROUP BY question_tag_grps.item
            ) AS temp_tbl
            ON temp_tbl.item = questions.item

            LEFT JOIN(
            SELECT question_likes.item as item,
            COUNT(DISTINCT question_likes.like_username) as count_like_question
            FROM question_likes
            GROUP BY question_likes.item
            ) AS temp_tbl2
            ON temp_tbl2.item = questions.item

            LEFT JOIN(
            SELECT answears.item as item,
            COUNT(answears.username) as count_answear
            FROM answears
            GROUP BY answears.item
            ) AS temp_tbl3
            ON temp_tbl3.item = questions.item

            LEFT JOIN users ON questions.username = users.name
            WHERE questions.status = 1

            ORDER BY questions.created_at desc';
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
        //Lấy user ranking theo tag theo tuần
        $str_sql=
        "with temp as
        (SELECT  users.name as username,users.fullname as fullname, ifnull(users.profile_photo_path,'') as profile_photo_path, 
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
            SELECT post_tag_grps.username, count(post_tag_grps.item) as post_count ".
            'FROM post_tag_grps '.
            "WHERE post_tag_grps.tag_name ='" . $tag_name . "' ".
            'AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
            GROUP BY username,tag_name
        ) AS post_count
        ON post_count.username = users.name


        LEFT JOIN(
            SELECT question_tag_grps.username, count(question_tag_grps.item) as questions_count
            FROM question_tag_grps '.
            "WHERE question_tag_grps.tag_name ='" . $tag_name . "' ".
            'AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
            GROUP BY username,tag_name
        ) AS questions_count
        ON questions_count.username = users.name

        LEFT JOIN(
            SELECT comments.username,count(tag_count) as comments_count
            FROM comments
            LEFT JOIN (
                SELECT post_tag_grps.item as item, count(post_tag_grps.tag_name) as tag_count
                FROM post_tag_grps '.
                "WHERE post_tag_grps.tag_name ='" . $tag_name . "' ".
                'AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                GROUP BY item
            ) AS tag_count
            ON tag_count.item = comments.item
            GROUP BY comments.username
        ) AS comments_count
        ON comments_count.username = users.name

        LEFT JOIN(
            SELECT answears.username,count(tag_count) as answears_count
            FROM answears

            LEFT JOIN (
                SELECT question_tag_grps.username as username,question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
                FROM question_tag_grps '.
                "WHERE question_tag_grps.tag_name ='" . $tag_name . "' ".
                'AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                GROUP BY username,item
            ) AS tag_count
            ON tag_count.item = answears.item
            GROUP BY username
        ) AS answears_count
        ON answears_count.username = users.name
        LEFT JOIN(

            SELECT answear_likes.like_username as like_username,count(tag_count) as self_like_answear_count
            FROM answear_likes

            LEFT JOIN (
                SELECT question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
                FROM question_tag_grps '.
                "WHERE question_tag_grps.tag_name ='" . $tag_name . "' ".
                'AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                GROUP BY item
            ) AS tag_count
            ON tag_count.item = answear_likes.item
            WHERE answear_likes.like_username =answear_likes.author
            GROUP BY like_username
        ) AS self_like_answear_count
        ON self_like_answear_count.like_username = users.name
        LEFT JOIN(

            SELECT comment_likes.like_username as like_username,count(tag_count) as self_like_comment_count
            FROM comment_likes

            LEFT JOIN (
                SELECT post_tag_grps.item as item, count(post_tag_grps.tag_name) as tag_count
                FROM post_tag_grps '.
                "WHERE post_tag_grps.tag_name ='" . $tag_name . "' ".
                'AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                GROUP BY item
            ) AS tag_count
            ON tag_count.item = comment_likes.item
            WHERE comment_likes.like_username = comment_likes.author
            GROUP BY like_username
        ) AS self_like_comment_count
        ON self_like_comment_count.like_username = users.name
        LEFT JOIN(

            SELECT post_likes.like_username as like_username,count(tag_count) as self_like_post_count
            FROM post_likes

            LEFT JOIN (
                SELECT post_tag_grps.item as item, count(post_tag_grps.tag_name) as tag_count
                FROM post_tag_grps '.
                "WHERE post_tag_grps.tag_name ='" . $tag_name . "' ".
                'AND post_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                GROUP BY item
            ) AS tag_count
            ON tag_count.item = post_likes.item
            WHERE post_likes.like_username =post_likes.author
            GROUP BY like_username
        ) AS self_like_post_count
        ON self_like_post_count.like_username = users.name
        LEFT JOIN(

            SELECT question_likes.like_username as like_username,count(tag_count) as self_like_question_count
            FROM question_likes

            LEFT JOIN (
                SELECT question_tag_grps.item as item, count(question_tag_grps.tag_name) as tag_count
                FROM question_tag_grps '.
                "WHERE question_tag_grps.tag_name ='" . $tag_name . "' ". 
                'AND question_tag_grps.created_at >= SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE())) 
                GROUP BY item
            ) AS tag_count
            ON tag_count.item = question_likes.item
            WHERE question_likes.like_username =question_likes.author
            GROUP BY like_username
        ) AS self_like_question_count
        ON self_like_question_count.like_username = users.name
        )
        select temp.username, temp.fullname, temp.profile_photo_path,
        (post_count +(comments_count+questions_count)*0.1+answears_count*0.2 + self_like_post_count + (self_like_question_count + self_like_answear_count + self_like_comment_count)*0.5) as contribution
        from temp
        GROUP BY username, fullname,profile_photo_path
        ORDER BY contribution desc
        LIMIT 10';


        $tagUserRankWeekly = DB::select(DB::raw($str_sql));
        // Đổi tên theo function chung
        $UserRankWeekly = json_decode(json_encode($tagUserRankWeekly), true);

 
        //Lấy post của tag theo newfeed
        $str_sql2 = 'SELECT '.' posts.title, posts.username, posts.item, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
        FROM posts
        LEFT JOIN (
            SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
            FROM post_tag_grps
            GROUP BY post_tag_grps.item
        ) AS temp_tbl
        ON temp_tbl.item = posts.item
        LEFT JOIN(
            SELECT post_likes.item as item,
            COUNT(DISTINCT post_likes.like_username) as count
            FROM post_likes
            GROUP BY post_likes.item
        ) AS temp_tbl2
        ON temp_tbl2.item = posts.item
        LEFT JOIN users ON posts.username = users.name
        WHERE posts.status = 1 
        ORDER BY posts.created_at desc';
        // " WHERE posts.username ='" . $username . "' ";

        //Lấy post của tag theo trend
        $str_sql3 = 'SELECT '.' posts.title, posts.username, posts.item, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
        FROM posts
        LEFT JOIN (
            SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
            FROM post_tag_grps
            GROUP BY post_tag_grps.item
        ) AS temp_tbl
        ON temp_tbl.item = posts.item
        LEFT JOIN(
            SELECT post_likes.item as item,
            COUNT(DISTINCT post_likes.like_username) as count
            FROM post_likes
            GROUP BY post_likes.item
        ) AS temp_tbl2
        ON temp_tbl2.item = posts.item
        LEFT JOIN users ON posts.username = users.name
        WHERE posts.status = 1 
        ORDER BY temp_tbl2.count desc
        LIMIT 5';
        // " WHERE posts.username ='" . $username . "' ";

    $posts = DB::select(DB::raw($str_sql2));
    // $posts = json_decode(json_encode($posts), true);

    $posts = (new Collection($posts))->paginate(20);

    $post_trends = DB::select(DB::raw($str_sql3));
    $post_trends = (new Collection($post_trends));
    // $posts = json_decode(json_encode($posts), true);


    $tags = Tag::where('tag_name',$tag_name)->first();

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


    return view('common::Tag.tags',compact('UserRankWeekly','posts','tags','checkFollowTag','post_trends'));

       
    }    

 
}
