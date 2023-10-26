<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\PostTagGrp;
use App\Models\Category;
use App\Models\UserFollower;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\DB;



class UserPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // Da xong
    public function posts($username)
    {
        $user= User::where('name', $username)->get();
        if($user->count() > 0){
        $str_sql = 'SELECT '.' posts.title, posts.username, posts.item, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
                    LEFT JOIN users ON posts.username = users.name '.
                    " WHERE posts.username ='" . $username . "' ";

            $posts = DB::select(DB::raw($str_sql));
            $posts = json_decode(json_encode($posts), true);

            return view('user::UserPage.posts',compact('user','posts'));
            }else{
                abort('404');
            }
    }
    // Da xong
    public function comments($username)
    {
        $user= User::where('name', $username)->get();
        if($user->count() > 0){
        $str_sql = 'SELECT '.' posts.title, posts.username, posts.item, comments.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path,comments.content,comments.id
                    FROM comments
                    LEFT JOIN (
                        SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
                        FROM post_tag_grps
                        GROUP BY post_tag_grps.item
                    ) AS temp_tbl
                    ON temp_tbl.item = comments.item
                    LEFT JOIN(
                        SELECT comment_likes.item as item,
                        COUNT(DISTINCT comment_likes.like_username) as count
                        FROM comment_likes
                        
                        GROUP BY comment_likes.item
                    ) AS temp_tbl2
                    ON temp_tbl2.item = comments.item
                    LEFT JOIN users ON comments.username = users.name
                    LEFT JOIN posts ON comments.item = posts.item '.
                    " WHERE posts.username ='" . $username . "' ";

            $posts = DB::select(DB::raw($str_sql));
            $posts = json_decode(json_encode($posts), true);
   
            return view('user::UserPage.comments',compact('user','posts'));
            }else{
                abort('404');
            }
    }
    // Da xong
    public function likePost($username)
    {
        $user= User::select('name','profile_photo_path')
                ->where('name', $username)
                ->get();
        if($user->count() > 0){
        $str_sql = 'SELECT'.' posts.title, posts.username, posts.item, posts.created_at, temp_tbl.tags,users.profile_photo_path,posts.content,temp_tbl2.count 
                    FROM post_likes 
                    LEFT JOIN users ON post_likes.like_username = users.name 
                    LEFT JOIN posts ON post_likes.item = posts.item     
                    LEFT JOIN (     
                        SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags     
                        FROM post_tag_grps     
                        GROUP BY post_tag_grps.item 
                    ) 
                    AS temp_tbl 
                    ON temp_tbl.item = post_likes.item 

                    LEFT JOIN(     
                        SELECT post_likes.item as item, COUNT(DISTINCT post_likes.like_username) as count     
                        FROM post_likes          
                        GROUP BY post_likes.item 
                    ) 
                    AS temp_tbl2 
                    ON temp_tbl2.item = post_likes.item '.
                    " WHERE post_likes.like_username ='" . $username . "' ";

            $posts = DB::select(DB::raw($str_sql));
            $posts = json_decode(json_encode($posts), true);

            

            return view('user::UserPage.like',compact('user','posts'));
            }else{
                abort('404');
            }
    }
    // Da xong
    public function likeComment($username)
    {
        $user= User::where('name', $username)->get();
        if($user->count() > 0){

        $str_sql = 'SELECT '.' comments.content, comments.id, posts.title, posts.username, posts.item, comments.created_at, temp_tbl.tags,users.profile_photo_path,temp_tbl2.count
        FROM comment_likes
        LEFT JOIN users ON comment_likes.like_username = users.name
        LEFT JOIN posts ON comment_likes.item = posts.item
        LEFT JOIN comments ON comment_likes.comment_id = comments.id
        LEFT JOIN (
            SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
            FROM post_tag_grps
            GROUP BY post_tag_grps.item
        ) AS temp_tbl
        ON temp_tbl.item = comment_likes.item
        LEFT JOIN(
            SELECT comment_likes.item as item,
            COUNT(DISTINCT comment_likes.like_username) as count
            FROM comment_likes
            
            GROUP BY comment_likes.item
        ) AS temp_tbl2
        ON temp_tbl2.item = comment_likes.item'.
        " WHERE comment_likes.like_username ='" . $username . "' ";

  


            $posts = DB::select(DB::raw($str_sql));
            $posts = json_decode(json_encode($posts), true);

            return view('user::UserPage.likeComment',compact('user','posts'));
            }else{
                abort('404');
            }
    }

    public function likeAnswear($username)
    {
        $user= User::where('name', $username)->get();
        if($user->count() > 0){
        $str_sql = 'SELECT '.' answears.content, answears.id, questions.title, questions.username, questions.item, answears.created_at, temp_tbl.tags,users.profile_photo_path,temp_tbl2.count,questions.type
        FROM answear_likes
        LEFT JOIN users ON answear_likes.like_username = users.name
        LEFT JOIN questions ON answear_likes.item = questions.item
        LEFT JOIN answears ON answear_likes.answear_id = answears.id
        LEFT JOIN (
            SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
            FROM post_tag_grps
            GROUP BY post_tag_grps.item
        ) AS temp_tbl
        ON temp_tbl.item = answear_likes.item
        LEFT JOIN(
            SELECT answear_likes.item as item,
            COUNT(DISTINCT answear_likes.like_username) as count
            FROM answear_likes
            
            GROUP BY answear_likes.item
        ) AS temp_tbl2
        ON temp_tbl2.item = answear_likes.item'.
        " WHERE answear_likes.like_username ='" . $username . "' ";

            $posts = DB::select(DB::raw($str_sql));
            $posts = json_decode(json_encode($posts), true);
         
            return view('user::UserPage.likeAnswear',compact('user','posts'));
            }else{
                abort('404');
            }
    }
    public function likeQuestion($username)
    {
        $user= User::where('name', $username)->get();
        if($user->count() > 0){
        $str_sql = 'SELECT'.' questions.title, questions.username, questions.item, questions.created_at, temp_tbl.tags,users.profile_photo_path,questions.content,temp_tbl2.count 
                    FROM question_likes 
                    LEFT JOIN users ON question_likes.like_username = users.name 
                    LEFT JOIN questions ON question_likes.item = questions.item     
                    LEFT JOIN (     
                        SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags     
                        FROM question_tag_grps     
                        GROUP BY question_tag_grps.item 
                    ) 
                    AS temp_tbl 
                    ON temp_tbl.item = question_likes.item 

                    LEFT JOIN(     
                        SELECT question_likes.item as item, COUNT(DISTINCT question_likes.like_username) as count     
                        FROM question_likes          
                        GROUP BY question_likes.item 
                    ) 
                    AS temp_tbl2 
                    ON temp_tbl2.item = question_likes.item '.
                    " WHERE question_likes.like_username ='" . $username . "' ";

            $posts = DB::select(DB::raw($str_sql));
            $posts = json_decode(json_encode($posts), true);

            return view('user::UserPage.likeQuestion',compact('user','posts'));
            }else{
                abort('404');
            }
    }
    //*************
    //Question
        /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // Da xong
    public function questions($username)
    {
        $user= User::where('name', $username)->get();
        if($user->count() > 0){
        $str_sql = 'SELECT '.' questions.title, questions.type, questions.username, questions.item, questions.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
                    FROM questions
                    LEFT JOIN (
                        SELECT question_tag_grps.item as item, GROUP_CONCAT(question_tag_grps.tag_name) as tags
                        FROM question_tag_grps
                        GROUP BY question_tag_grps.item
                    ) AS temp_tbl
                    ON temp_tbl.item = questions.item
                    LEFT JOIN(
                        SELECT post_likes.item as item,
                        COUNT(DISTINCT post_likes.like_username) as count
                        FROM post_likes
                        GROUP BY post_likes.item
                    ) AS temp_tbl2
                    ON temp_tbl2.item = questions.item
                    LEFT JOIN users ON questions.username = users.name '.
                    " WHERE questions.username ='" . $username . "' ";

            $posts = DB::select(DB::raw($str_sql));
            $posts = json_decode(json_encode($posts), true);

            return view('user::UserPage.questions',compact('user','posts'));
            }else{
                abort('404');
            }
    }
    
    public function answears($username)
    {
        $user= User::where('name', $username)->get();
        if($user->count() > 0){
        $str_sql = 'SELECT '.' questions.title, questions.username, questions.item, answears.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path,answears.content,answears.id,questions.type
                    FROM answears
                    LEFT JOIN (
                        SELECT post_tag_grps.item as item, GROUP_CONCAT(post_tag_grps.tag_name) as tags
                        FROM post_tag_grps
                        GROUP BY post_tag_grps.item
                    ) AS temp_tbl
                    ON temp_tbl.item = answears.item
                    LEFT JOIN(
                        SELECT answear_likes.item as item,
                        COUNT(DISTINCT answear_likes.like_username) as count
                        FROM answear_likes
                        
                        GROUP BY answear_likes.item
                    ) AS temp_tbl2
                    ON temp_tbl2.item = answears.item
                    LEFT JOIN users ON answears.username = users.name
                    LEFT JOIN questions ON answears.item = questions.item '.
                    " WHERE questions.username ='" . $username . "' ";

            $posts = DB::select(DB::raw($str_sql));
            $posts = json_decode(json_encode($posts), true);

            return view('user::UserPage.answears',compact('user','posts'));
            }else{
                abort('404');
            }
    }
    public function followers($username)
    {
        $user= User::select('id','name','profile_photo_path')
                ->where('name', $username)
                ->first();

        
        if($user->count() > 0){
        
        

            // $str_sql = 'SELECT '.' users.name,users.id, users.profile_photo_path
            //             FROM users
            //             RIGHT JOIN user_followers 
            //             ON users.id = user_followers.follower_user_id'.
            //             " WHERE user_followers.user_id ='" . $user['id'] . "' "; 
            // $followers = DB::select(DB::raw($str_sql))->get();
            // $followers = json_decode(json_encode($followers), true);

            $followers = DB::table('users')
            ->select('users.name','users.id','users.profile_photo_path')
            ->rightJoin('user_followers', 'users.id', '=', 'user_followers.follower_user_id')
            ->where('user_followers.user_id', '=', $user['id'])
            ->paginate(15);
            return view('user::UserPage.followers',compact('followers','user'));
            }else{
                abort('404');
            }
    }

    public function followingUser($username)
    {
        $user= User::select('id','name','profile_photo_path')
                ->where('name', $username)
                ->first();

        
        if($user->count() > 0){

            $followers = DB::table('users')
            ->select('users.name','users.id','users.profile_photo_path')
            ->rightJoin('user_followers', 'users.id', '=', 'user_followers.user_id')
            ->where('user_followers.user_id', '=', $user['id'])
            ->paginate(15);
            
            return view('user::UserPage.followings',compact('followers','user'));
            }else{
                abort('404');
            }
    }



}
