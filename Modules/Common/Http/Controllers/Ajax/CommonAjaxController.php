<?php

namespace Modules\Common\Http\Controllers\Ajax;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request ;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Answear;
use App\Models\Comment;

use App\Models\Category;
use App\Models\UserStock;

use App\Models\PostLike;
use App\Models\CommentLike;
use App\Models\AnswearLike;
use App\Models\QuestionLike;
use App\Models\UserRank;
use App\Models\Report;


use App\Models\UserRankWeekly;
use App\Models\UserRankMonthly;
use App\Models\UserRankTotal;

use App\Models\TagRankWeekly;
use App\Models\TagRankMonthly;
use App\Models\TagRankTotal;

use App\Models\TagFollower;
use App\Helpers\Helpers;







class CommonAjaxController extends Controller
{
    //report
    public function reportUser(Request $request)
    {
         
        $validatedData = $request->validate([
         'data' => 'required',
 
        ]);

        $result = false;
               
        $req = $request->all();


        $reported_id = $req['reported_id'];
        $item_type = $req['item_type'];
        $item_id = $req['item_id'];
        $data = $req['data'];




        
        if($item_id == 'post'){

        }
        

        

        $reportdata['user_id'] = Auth::id();
        $reportdata['reported_id'] =$reported_id;
        $reportdata['item_type'] =$item_type;
        $reportdata['item_id'] =$item_id;
        $reportdata['data'] = $data;
        
        Report::create($reportdata);


        return response()->json(['img' => $result], '200', [], JSON_UNESCAPED_UNICODE);
 
    }


    // public function __construct() {
    //     $this->middleware('auth')->except(['tagShow']);
    // }

    function index()
    {
     $data = DB::table('tags')->paginate(20);
     return view('common::Tag.pagination', compact('data'));
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $data = DB::table('tags')->paginate(20);
      return view('common::Tag.pagination_data', compact('data'))->render();
     }
    }



    public function tagsRank(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        $time = $req['time'];

        if($time =="Weekly"){
        
        $str_sql = Helpers::tagRankWeekly();
        $TagRankWeekly = DB::select(DB::raw($str_sql));
        $result = json_decode(json_encode($TagRankWeekly), true);

        }else if($time =="Monthly"){
         
        $str_sql = Helpers::tagRankMonthly();
        $TagRankMonthly = DB::select(DB::raw($str_sql));
        $result = json_decode(json_encode($TagRankMonthly), true);

        }else{
           // $result = TagRankTotal::select()->get()->toArray();
            
        $str_sql = Helpers::tagRankTotal();
        $TagRankTotal = DB::select(DB::raw($str_sql));
        $result = json_decode(json_encode($TagRankTotal), true); 
        }   


        return response()->json(['timely' => $result], '200', [], JSON_UNESCAPED_UNICODE);

    }
    public function usersRank(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        $time = $req['time'];

        if($time =="Weekly"){
            //$result = UserRankWeekly::select()->get()->toArray();
            
        $str_sql = Helpers::userRankWeekly();
        $UserRankWeekly = DB::select(DB::raw($str_sql));
        $result = json_decode(json_encode($UserRankWeekly), true); 

        }else if($time =="Monthly"){
            //$result = UserRankMonthly::select()->get()->toArray();
            
        $str_sql = Helpers::userRankMonthly();
        $UserRankMonthly = DB::select(DB::raw($str_sql));
        $result = json_decode(json_encode($UserRankMonthly), true);

        }else{
            //$result = UserRankTotal::select()->get()->toArray();

        $str_sql = Helpers::userRankTotal();
        $UserRankTotal = DB::select(DB::raw($str_sql));
        $result = json_decode(json_encode($UserRankTotal), true);           
            
        }   


        return response()->json(['timely' => $result], '200', [], JSON_UNESCAPED_UNICODE);

    }    


    //Tag page
    public function usersRankTag(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        $time = $req['time'];

        $tag_name = $req['tag_name'];

        $tags = Tag::where('tag_name',$tag_name)->first();
        $tag_id =  $tags ->id;


        if($time =="Weekly"){
            $time ='SUBDATE(CURRENT_DATE(), weekday(CURRENT_DATE()))';

        }else if($time =="Monthly"){
            $time ="DATE_FORMAT(CURDATE() - INTERVAL 0 MONTH,'%Y-%m-01')";

        }else{
            $time = "2022-01-01";
        }   
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
    "AND post_tag_grps.updated_at >= " . $time .'
      AND (posts.status = 1 OR posts.status = 3)
    GROUP BY user_id,tag_id
) AS post_count
ON post_count.user_id = users.id


LEFT JOIN(
    SELECT question_tag_grps.user_id, count(question_tag_grps.question_id) as questions_count
    FROM question_tag_grps LEFT JOIN questions ON question_tag_grps.question_id = questions.id '.
    "WHERE question_tag_grps.tag_id ='" . $tag_id . "' ".
    "AND question_tag_grps.updated_at >= " . $time .'
    AND (questions.status = 1 OR questions.status = 3) 
    GROUP BY user_id,tag_id
) AS questions_count
ON questions_count.user_id = users.id

LEFT JOIN(
    SELECT comments.user_id,count(tag_count) as comments_count
    FROM comments
    LEFT JOIN (
        SELECT post_tag_grps.post_id as post_id, count(post_tag_grps.tag_id) as tag_count
        FROM post_tag_grps LEFT JOIN posts ON post_tag_grps.post_id = posts.id '.
        "WHERE post_tag_grps.tag_id ='" . $tag_id . "' ".
        "AND post_tag_grps.updated_at >= " . $time .'
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
        "WHERE question_tag_grps.tag_id ='" . $tag_id . "' ".
        "AND question_tag_grps.updated_at >= " . $time .'
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
        "WHERE question_tag_grps.tag_id ='" . $tag_id . "' ".
        "AND question_tag_grps.updated_at >= " . $time .'
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
        "AND post_tag_grps.updated_at >= " . $time .' 
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
        "AND post_tag_grps.updated_at >= " . $time .'
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
        "WHERE question_tag_grps.tag_id ='" . $tag_id . "' ". 
        "AND question_tag_grps.updated_at >= " . $time .'
        AND (questions.status = 1 OR questions.status = 3) 
        GROUP BY question_id
    ) AS tag_count
    ON tag_count.question_id = question_likes.question_id

    GROUP BY user_id
) AS self_like_question_count
ON self_like_question_count.user_id = users.id
) AS temp
GROUP BY username, profile_photo_path
ORDER BY contribution desc';


    $result = DB::select(DB::raw($str_sql));
    $result = json_decode(json_encode($result), true);

        
   return response()->json(['timely' => $result], '200', [], JSON_UNESCAPED_UNICODE);

    }

    //tag follow
    public function tagFollow(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $result=false;
        $req = $request->all();
        $tagid = $req['srv-tgi'];
        $action = $req['srv-act'];
        $userid = Auth::id();

        if($action =="add"){
            $data['tag_id'] =  $tagid;
            $data['user_id'] = $userid;

            $result=TagFollower::create($data);

        }else if($action =="del"){   
            $result = TagFollower::where("tag_id", $tagid)
            ->where('user_id', $userid )
            ->delete();
        }
   
        return response()->json(['data' => $result], '200', [], JSON_UNESCAPED_UNICODE);

    }
    //Thay đổi view từ post sang question trong tag page
    public function tagShow(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        
         

        $tag_name = $req['tag_name'];
        $typepage = $req['typepage'];

        $tags = Tag::where('tag_name',$tag_name)->first();
        $tag_id =  $tags ->id;
        if ($typepage == 'posts'){

        
        $str_sql = 'SELECT '.' posts.title, posts.user_id, posts.item, posts.created_at, posts.updated_at,temp_tbl.tags,temp_tbl2.count,users.profile_photo_path, users.name as username
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
            // " WHERE posts.username ='" . $username . "' ";

        }else if ($typepage == 'questions'){
        $str_sql = 'SELECT '.' questions.title,questions.type, count_answear, users.name as username, questions.item, questions.created_at, questions.updated_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path, temp_tbl3.count_answear
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
                COUNT(DISTINCT question_likes.user_id) as count
                FROM question_likes
                GROUP BY question_likes.question_id
            ) AS temp_tbl2
            ON temp_tbl2.question_id = questions.id

            LEFT JOIN(
            SELECT answears.question_id as question_id,
                COUNT(answears.question_id) as count_answear
            FROM answears
            GROUP BY answears.question_id
            ) AS temp_tbl3
            ON temp_tbl3.question_id = questions.id

            LEFT JOIN users ON questions.user_id = users.id 
            WHERE (questions.status = 1 OR questions.status = 3 ) '.
            " AND LOCATE( '".$tags ->tag_name. "' ,tags) ".
            ' ORDER BY questions.updated_at desc';
            // " WHERE questions.username ='" . $username . "' ";

        }

    $posts = DB::select(DB::raw($str_sql));
    // $posts = json_decode(json_encode($posts), true);

    $posts = (new Collection($posts))->paginate(20);

    //return response()->json(['data' => $posts], '200', [], JSON_UNESCAPED_UNICODE);

    //return view('pagiresult',compact('posts'));




        return view('common::Tag.tagshow',compact('posts','typepage'))->render();

    }


/**
     * Display a listing of the resource.
     * @return Renderable
     */
    //work
    public function timelineAll(Request $request)
    {
        $req = $request->all();
        $typepage ='posts';
        if(isset($req['typepage'])){
            $typepage = $req['typepage'];
        }

        


        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        
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
        




        if ($request->ajax()) {
            return view('common::Elements.pagination',compact('TagRankWeekly','UserRankWeekly','posts','typepage'))->render();
        }else{

            return view('common::Timeline.timeline',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
        }

    
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    //done
    public function timelineUser(Request $request)
    {
        $req = $request->all();
        $typepage ='posts';
        if(isset($req['typepage'])){
            $typepage = $req['typepage'];
        }

        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();


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





    if ($request->ajax()) {
        return view('common::Elements.pagination',compact('TagRankWeekly','UserRankWeekly','posts','typepage'))->render();
    }else{

        return view('common::Timeline.timelineUser',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
    }

    
    }

/**
     * Display a listing of the resource.
     * @return Renderable
     */
    //done
    public function timelineTag(Request $request)
    {
        $req = $request->all();
        $typepage ='posts';
        
        if(isset($req['typepage'])){
            $typepage = $req['typepage'];
        }
        $TagRankWeekly = TagRankWeekly::select()->orderBy("count_post", "desc")->get()->toArray();
        $UserRankWeekly = UserRankWeekly::select()->orderBy("contribution", "desc")->get()->toArray();
        

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
            GROUP BY username, user_id, title, type,item,count, count_answear, created_at,updated_at,tags,profile_photo_path
            ORDER BY tmp2.updated_at desc
            ';
         }



        $posts = (new Collection(DB::select(DB::raw($str_sql))))->paginate(20);




        if ($request->ajax()) {
            return view('common::Elements.pagination',compact('TagRankWeekly','UserRankWeekly','posts','typepage'))->render();
        }else{

            return view('common::Timeline.timelineTag',compact('TagRankWeekly','UserRankWeekly','posts','typepage'));
        }
    }
    

}


