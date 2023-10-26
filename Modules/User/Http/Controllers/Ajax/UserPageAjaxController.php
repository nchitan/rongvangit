<?php

namespace Modules\User\Http\Controllers\Ajax;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request ;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTagGrp;
use App\Models\PostLike;
use App\Models\Category;
use App\Models\UserStock;
use App\Models\Comment;
use App\Models\CommentLike;

use App\Models\User;

use App\Models\AnswearLike;
use App\Models\QuestionLike;

use App\Models\UserFollower;

use App\Notifications\UserFollowed;
use App\Models\UserCalculation;

use App\Models\SubCategory;



class UserPageAjaxController extends Controller
{
    public function __construct() {      //  __construct クラスを追加
        $this->middleware('auth')->except(['getTagsSuggest','userPage']);
    }

    public function getTagsSuggest(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        $key = $req['tag'];
        $str_sql = "SELECT distinct tag_name FROM tags WHERE slug LIKE '". $key . "%' LIMIT 10 OFFSET 0";
        $str_sql2 = "SELECT distinct tag_name FROM tags WHERE slug LIKE '%". $key . "%' LIMIT 10 OFFSET 0";
        $data = DB::select(DB::raw($str_sql));
        if (empty($data)) {
            $data = DB::select(DB::raw($str_sql2));
        }


      
        return response()->json(['suggestWord' => $data], '200', [], JSON_UNESCAPED_UNICODE);

    }

    public function changeFolderName(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        $itemId = $req['itemId'];
        $category_name = $req['name'];

        $data=false;

       $stockedid = explode(":",$itemId);
       if(isset($stockedid[1])){

            $data=SubCategory::find($stockedid[1])
                    ->update(['sub_category_name' =>  $category_name]);
        }else{

            $data=Category::find($stockedid[0])
                    ->update(['category_name' => $category_name]);    
        } 

        return response()->json(['change' => $data], '200', [], JSON_UNESCAPED_UNICODE);

    }

    public function followUser(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        $data=false;
         

        $userid = $req['srv-at'];
        $action = $req['srv-act'];


        $user =User::find($userid);

        $follower = auth()->user();



        if($action =="add"){
            if ($follower->id == $user->id) {
                return back()->withError("You can't follow yourself");
            }

            if(!$follower->isFollowing($user->id)) {

                $data=$follower->follow($user->id);


                UserCalculation::where('user_id', Auth::id())
                         ->increment('folowing_count');       

                UserCalculation::where('user_id', $user->id)
                         ->increment('folower_count_count');  
               

                
       
                // sending a notification
                $user->notify(new UserFollowed($follower));
 

                //return back()->withSuccess("You are now friends with {$user->name}");
            }
        }else if($action =="del"){   
            if($follower->isFollowing($user->id)) {
                $data=$follower->unfollow($user->id);

                UserCalculation::where('user_id', Auth::id())
                         ->decrement('folowing_count');       

                UserCalculation::where('user_id', $user->id)
                         ->decrement('folower_count_count'); 
                
                // return back()->withSuccess("You are no longer friends with {$user->name}");
            }
            //return back()->withError("You are not following {$user->name}");
        }


       // return back()->withError("You are already following {$user->name}");
        // if($action =="add"){
        //     $data['user_id'] =  $userid; 
        //     $data['follower_user_id'] =Auth::id();
        //     $user=UserFollower::create($data);
        //     $user->notify(new UserFollowed($follower));
        //     return back()->withSuccess("You are now friends with {$user->name}");
        // }else if($action =="del"){
        //     UserFollower::where('user_id', $userid)
        //                 ->where('follower_user_id', Auth::id())
        //                 ->delete();
        // }
        

        

        return response()->json(['data' => $data], '200', [], JSON_UNESCAPED_UNICODE);

    }


    // Da xong
    public function userPage(Request $request)
    {
        $req = $request->all();

        $username = $req['css-un'];
        $typepage = $req['css-tp'];

        $user= User::where('name', $username)
                ->first();
        if($user->count() > 0){
            switch($typepage){
                case 'comments':
                    $str_sql = 'SELECT '.' posts.title, users.name as username, posts.item, comments.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path,comments.content,comments.id
                                FROM comments
                                LEFT JOIN (
                                  SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                                  FROM post_tag_grps
                                  LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                                  GROUP BY post_tag_grps.post_id
                                ) AS temp_tbl
                                ON temp_tbl.post_id = comments.post_id
                                LEFT JOIN(
                                    SELECT comment_likes.post_id as post_id,
                                    COUNT(DISTINCT comment_likes.user_id) as count
                                    FROM comment_likes
                                    
                                    GROUP BY comment_likes.post_id
                                ) AS temp_tbl2
                                ON temp_tbl2.post_id = comments.post_id
                                LEFT JOIN users ON comments.user_id = users.id
                                LEFT JOIN posts ON comments.post_id = posts.id '.
                                " WHERE comments.user_id ='" .  $user->id . "' 
                                AND ( posts.status = 1 OR posts.status = 3)
                                ORDER BY posts.updated_at desc";
                    break;
                case 'questions':
                    $str_sql = 'SELECT '.' questions.title, users.name as username, questions.type, count_answear , questions.item, questions.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
                    COUNT(answears.user_id) as count_answear
                    FROM answears
                    GROUP BY answears.question_id
                    ) AS temp_tbl3
                    ON temp_tbl3.question_id = questions.id

                    LEFT JOIN users ON questions.user_id = users.id '.
                    " WHERE questions.user_id ='" . $user->id . "' 
                    AND ( questions.status = 1 OR questions.status = 3)
                    ORDER BY questions.updated_at desc";
                    break;  
                case 'answears':
                    $str_sql = 'SELECT '.' questions.title, users.name as username,count_answear, questions.item, answears.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path,answears.content,answears.id,questions.type
                    FROM answears
                    LEFT JOIN (
                        SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                        FROM question_tag_grps
                        LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                        GROUP BY question_tag_grps.question_id
                    ) AS temp_tbl
                    ON temp_tbl.question_id = answears.question_id
                    LEFT JOIN(
                        SELECT answear_likes.question_id as question_id,
                        COUNT(DISTINCT answear_likes.user_id) as count
                        FROM answear_likes
                        
                        GROUP BY answear_likes.question_id
                    ) AS temp_tbl2
                    ON temp_tbl2.question_id = answears.question_id

                    LEFT JOIN(
                    SELECT answears.question_id as question_id,
                    COUNT(answears.user_id) as count_answear
                    FROM answears
                    GROUP BY answears.question_id
                    ) AS temp_tbl3
                    ON temp_tbl3.question_id = answears.question_id

                    LEFT JOIN users ON answears.user_id = users.id
                    LEFT JOIN questions ON answears.question_id = questions.id '.
                    " WHERE answears.user_id ='" . $user->id . "' ".
                    " AND (questions.status = 1 OR questions.status = 3)
                    ORDER BY answears.updated_at desc";
                    break;                      
                case 'likeposts':
                    $str_sql = 'SELECT'.' posts.title, users.name as username, posts.item, posts.created_at, temp_tbl.tags,users.profile_photo_path,posts.content,temp_tbl2.count 
                    FROM post_likes 
                    LEFT JOIN users ON post_likes.user_id = users.id 
                    LEFT JOIN posts ON post_likes.post_id = posts.id     
                    LEFT JOIN (     
                            SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                            FROM post_tag_grps
                            LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                            GROUP BY post_tag_grps.post_id 
                    ) 
                    AS temp_tbl 
                    ON temp_tbl.post_id = post_likes.post_id 

                    LEFT JOIN(     
                        SELECT post_likes.post_id as post_id, post_likes.updated_at, COUNT(DISTINCT post_likes.user_id) as count     
                        FROM post_likes          
                        GROUP BY post_likes.post_id , post_likes.updated_at
                    ) 
                    AS temp_tbl2 
                    ON temp_tbl2.post_id = post_likes.post_id '.
                    " WHERE post_likes.user_id ='" . $user->id . "' ".
                    ' AND (posts.status = 1 OR posts.status = 3)
                     ORDER BY post_likes.updated_at desc';
                    break;
                case 'likecomments':
                    $str_sql = 'SELECT '.' comments.content, comments.id, posts.title, users.name as username, posts.item, comments.created_at, temp_tbl.tags,users.profile_photo_path,temp_tbl2.count
                        FROM comment_likes
                        LEFT JOIN users ON comment_likes.user_id = users.id
                        LEFT JOIN posts ON comment_likes.post_id = posts.id
                        LEFT JOIN comments ON comment_likes.comment_id = comments.id
                        LEFT JOIN (
                            SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                            FROM post_tag_grps
                            LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                            GROUP BY post_tag_grps.post_id
                        ) AS temp_tbl
                        ON temp_tbl.post_id = comment_likes.post_id
                        LEFT JOIN(
                            SELECT comment_likes.post_id as post_id,
                            COUNT(DISTINCT comment_likes.user_id) as count
                            FROM comment_likes
                            GROUP BY comment_likes.post_id
                        ) AS temp_tbl2
                        ON temp_tbl2.post_id = comment_likes.post_id'.
                        " WHERE comment_likes.user_id ='" . $user->id . "' ".
                        ' AND (posts.status = 1 OR posts.status = 3)
                         ORDER BY comment_likes.updated_at desc';
                    break;
                case 'likeanswears':
                    $str_sql = 'SELECT '.' answears.content, answears.id, count_answear,questions.title, users.name as username, questions.item, answears.created_at, temp_tbl.tags,users.profile_photo_path,temp_tbl2.count,questions.type
                    FROM answear_likes
                    LEFT JOIN users ON answear_likes.user_id = users.id
                    LEFT JOIN questions ON answear_likes.question_id = questions.id
                    LEFT JOIN answears ON answear_likes.answear_id = answears.id
                    LEFT JOIN (
                        SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                        FROM question_tag_grps
                        LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                        GROUP BY question_tag_grps.question_id
                    ) AS temp_tbl
                    ON temp_tbl.question_id = answear_likes.question_id

                    LEFT JOIN(
                    SELECT answears.question_id as question_id,
                    COUNT(answears.user_id) as count_answear
                    FROM answears
                    GROUP BY answears.question_id
                    ) AS temp_tbl3
                    ON temp_tbl3.question_id = answears.question_id


                    LEFT JOIN(
                    SELECT answear_likes.question_id as question_id,
                    COUNT(DISTINCT answear_likes.user_id) as count
                    FROM answear_likes
                    GROUP BY answear_likes.question_id
                    ) AS temp_tbl2
                    ON temp_tbl2.question_id = answear_likes.question_id'.
                    " WHERE answear_likes.user_id ='" . $user->id . "' ".
                    ' AND (questions.status = 1 OR questions.status = 3)
                     ORDER BY answear_likes.updated_at desc ';
                    break;
                case 'likequestions':
                    $str_sql = 'SELECT'.' questions.title,questions.type,count_answear, users.name as username, questions.item, questions.created_at, temp_tbl.tags,users.profile_photo_path,questions.content,temp_tbl2.count 
                    FROM question_likes 
                    LEFT JOIN users ON question_likes.user_id = users.id 
                    LEFT JOIN questions ON question_likes.question_id = questions.id     
                    LEFT JOIN (     
                        SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                        FROM question_tag_grps
                        LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                        GROUP BY question_tag_grps.question_id
                    ) 
                    AS temp_tbl 
                    ON temp_tbl.question_id = question_likes.question_id 

                    LEFT JOIN(     
                        SELECT question_likes.question_id as question_id, COUNT(DISTINCT question_likes.user_id) as count     
                        FROM question_likes          
                        GROUP BY question_likes.question_id 
                    ) 
                    AS temp_tbl2 
                    ON temp_tbl2.question_id = question_likes.question_id 


                    LEFT JOIN(
                    SELECT answears.question_id as question_id,
                    COUNT(answears.user_id) as count_answear
                    FROM answears
                    GROUP BY answears.question_id
                    ) AS temp_tbl3
                    ON temp_tbl3.question_id = question_likes.question_id

                    '.
                    " WHERE question_likes.user_id ='" . $user->id . "' ".
                    ' AND (questions.status = 1 OR questions.status = 3)
                    ORDER BY question_likes.updated_at desc';
                    break;
                default:
                    $str_sql = 'SELECT '.' posts.title, users.name as username, posts.id, posts.item, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
                    LEFT JOIN users ON posts.user_id = users.id '.
                    " WHERE posts.user_id ='" . $user->id . "'  ".
                    " AND ( posts.status = 1 OR posts.status = 3)
                    ORDER BY posts.updated_at desc";
                    break;
            }

            $posts = DB::select(DB::raw($str_sql));
            $posts = (new Collection($posts))->paginate(20);

            return view('user::UserPage.pagination',compact('posts','typepage'))->render();
   

            }else{
                abort('404');
            }
    }
    



}
