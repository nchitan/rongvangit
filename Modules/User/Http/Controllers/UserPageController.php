<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Models\Post;
use App\Models\UserCalculation;
use App\Models\Tag;
use App\Models\User;
use App\Models\PostTagGrp;
use App\Models\Category;
use App\Models\UserFollower;
use App\Models\TagFollower;





class UserPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // Da xong
    public function userHomePage($username)
    {
        $user= User::select()
                ->where('name', $username)
                ->first();

        if( !empty($user)){

        $user_infor=UserCalculation::where('user_id',$user->id)->first();


        $str_sql = 'SELECT '.' posts.title, users.name as username, posts.id, posts.item, posts.created_at, posts.updated_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
                    " WHERE posts.user_id ='" . $user->id . "' 
                    AND ( posts.status = 1 OR posts.status = 3 )
                    ORDER BY posts.updated_at desc";

            $posts = DB::select(DB::raw($str_sql));
            $posts = (new Collection($posts))->paginate(20);


            // $str_sql = 'with temp as(
            //                 SELECT follows_id 
            //                 FROM followers '.
            //                 " WHERE followers.user_id = '" . $user['id'] . "' ".
            //             ')
            //             select temp.follows_id as id, users.name, users.profile_photo_path 
            //             from temp
            //             LEFT JOIN users 
            //             ON temp.follows_id = users.id';

            // $followings = DB::select(DB::raw($str_sql));
            // $followings_count = count($followings);

            // $str_sql = 'with temp as(
            //                 SELECT user_id 
            //                 FROM followers '.
            //                 " WHERE followers.follows_id = '" . $user['id'] . "' ".
            //             ')
            //             select temp.user_id as id, users.name, users.profile_photo_path 
            //             from temp
            //             LEFT JOIN users 
            //             ON temp.user_id = users.id';

            // $followers = DB::select(DB::raw($str_sql));
            // $followers_count = count($followers);

           
            $following_tags = TagFollower::where('user_id',$user->id)
            ->leftJoin('tags', 'tags.id', '=', 'tag_followers.tag_id')
            ->get();
            $checkFollow=false;
            if (Auth::check()) {
                $follower = auth()->user();
                if($follower->isFollowing($user->id)) {
                    $checkFollow=true;
                }


            


                // $checkFollow_temp= UserFollower::where('user_id',$user['id'])
                //     ->where('follower_user_id', Auth::id())
                //     ->first();
                // if(!empty($checkFollow_temp)){
                //     $checkFollow=true;
                // }

            }


            //$posts = json_decode(json_encode($posts), true);

            $str_sql = 'SELECT '.' tags.tag_name as tag_name, 
                COUNT(post_id ) as item_count

                FROM post_tag_grps
                LEFT JOIN posts ON post_tag_grps.post_id = posts.id
                LEFT JOIN tags ON post_tag_grps.tag_id = tags.id '.
                " WHERE post_tag_grps.user_id = ".$user->id.
                ' AND (posts.status = 1 OR posts.status = 3)
                GROUP BY tags.tag_name';
            $temp = DB::select(DB::raw($str_sql));
            $post_ratings =[];
            $sum =0;

            // var_dump($temp);
            foreach ($temp as $key => $value){
                $sum += $value->item_count;

            }

            foreach ($temp as $key => $value){
                $new =array($value->tag_name =>round(($value->item_count/$sum)*100));

                //array_push($post_ratings, array($value->tag_name=>round(($value->item_count/$sum)*100)) );
                $post_ratings += $new;
                
                //array_merge($post_ratings,array($value->tag_name=>round(($value->item_count/$sum)*100)));
                
                // $post_ratings[$value->tag_name] = round(($value->item_count/$sum)*100);

            }

            arsort($post_ratings);

           

            // Tinh % answear question
            $str_sql = 'SELECT '.'tags.tag_name, COUNT(temp.question_id) as item_count
                            FROM (
                            SELECT answears.user_id, answears.question_id, question_tag_grps.tag_id FROM answears
                            LEFT JOIN questions ON answears.question_id = questions.id
                            LEFT JOIN question_tag_grps ON question_tag_grps.question_id = answears.question_id '.
                            " WHERE answears.user_id = ".$user->id.
                            ' AND (questions.status = 1 OR questions.status = 3)
                            ) AS temp
                            LEFT JOIN tags on temp.tag_id = tags.id
                            GROUP BY tags.tag_name';
            $temp = DB::select(DB::raw($str_sql));
            $answear_ratings =[];
            $sum =0;
            foreach ($temp as $key => $value){
                $sum += $value->item_count;

            }

            foreach ($temp as $key => $value){
                $new =array($value->tag_name =>round(($value->item_count/$sum)*100));
                //array_push($answear_ratings, [$value->tag_name,round(($value->item_count/$sum)*100)] );
                $answear_ratings += $new;

            }
            arsort($answear_ratings);
           
            // Tinh % like post
            $str_sql = 'SELECT '.'tags.tag_name, COUNT(temp.post_id) as item_count
                FROM (
                SELECT post_likes.user_id, post_likes.post_id, post_tag_grps.tag_id FROM post_likes
                LEFT JOIN posts ON post_likes.post_id = posts.id
                LEFT JOIN post_tag_grps ON post_tag_grps.post_id = post_likes.post_id'.
                " WHERE post_likes.user_id = ".$user->id.
                ' AND (posts.status = 1 OR posts.status = 3)
                ) AS temp
                LEFT JOIN tags on temp.tag_id = tags.id
                GROUP BY tags.tag_name';
            $temp = DB::select(DB::raw($str_sql));

            Log::debug($temp);
            $post_like_ratings =[];
            $sum =0;
            foreach ($temp as $key => $value){
                $sum += $value->item_count;

            }

            foreach ($temp as $key => $value){
                $new =array($value->tag_name =>round(($value->item_count/$sum)*100));
                //array_push($post_like_ratings, [$value->tag_name,round(($value->item_count/$sum)*100)] );
                $post_like_ratings += $new;


            }
            arsort($post_like_ratings);           


            return view('user::UserPage.userPage',compact('user','posts','checkFollow','following_tags','user_infor','post_ratings','answear_ratings','post_like_ratings'));
            }else{
                abort('404');
            }
    }
    
    //sai
    public function followers($username)
    {
        $user= User::select('id','name','fullname')
                ->where('name', $username)
                ->first();

        
        if($user->count() > 0){
            // $followers = DB::table('followers')
            // ->select('users.name','users.id','users.profile_photo_path')
            // ->leftJoin('users', 'users.id', '=', 'followers.user_id')
            // ->where('followers.follows_id', '=',$user['id'])
            // ->paginate(20);

          

            $user_infor=UserCalculation::where('user_id',$user->id)->first();

            // $str_sql = 'with temp as(
            //                 SELECT follows_id 
            //                 FROM followers '.
            //                 " WHERE followers.user_id = '" . $user['id'] . "' ".
            //             ')
            //             select temp.follows_id as id, users.name, users.profile_photo_path 
            //             from temp
            //             LEFT JOIN users 
            //             ON temp.follows_id = users.id';

         
            // $followings_count = count(DB::select(DB::raw($str_sql)));

            $str_sql = 'select temp.user_id as id, users.name,users.fullname, users.about ,users.profile_photo_path 
                        from (
                            SELECT user_id 
                            FROM followers '.
                            " WHERE followers.follows_id = '" . $user['id'] . "' ".
                        ') AS temp
                        LEFT JOIN users 
                        ON temp.user_id = users.id';

            $followers = DB::select(DB::raw($str_sql));
            // $followers_count = count($followers);

            $followers = (new Collection($followers))->paginate(20);




            $checkFollow=false;
            $following_tags = TagFollower::where('user_id',$user->id)
            ->leftJoin('tags', 'tags.id', '=', 'tag_followers.tag_id')
            ->get();
            if (Auth::check()) {
                $follower = auth()->user();
                if($follower->isFollowing($user->id)) {
                    $checkFollow=true;
                }


            }
                   
            return view('user::UserPage.followers',compact('user','followers','checkFollow','following_tags','user_infor'));
            }else{
                abort('404');
            }
    }

    public function followingUser($username)
    {
        $user= User::select('id','name','fullname')
                ->where('name', $username)
                ->first();

        
        if($user->count() > 0){

            // $followers = DB::table('followers')
            // ->select('users.name','users.id','users.profile_photo_path')
            // ->leftJoin('users', 'users.id', '=', 'followers.user_id')
            // ->where('followers.user_id', '=',$user['id']) 
            // ->paginate(20);

            $user_infor=UserCalculation::where('user_id',$user->id)->first();
            // $str_sql = 'with temp as(
            //                 SELECT user_id 
            //                 FROM followers '.
            //                 " WHERE followers.follows_id = '" . $user['id'] . "' ".
            //             ')
            //             select temp.user_id as id, users.name, users.profile_photo_path 
            //             from temp
            //             LEFT JOIN users 
            //             ON temp.user_id = users.id';

            // $followers_count = count(DB::select(DB::raw($str_sql)));

            $str_sql = 'select temp.follows_id as id, users.name,users.fullname, users.about, users.profile_photo_path 
                        from (
                            SELECT follows_id 
                            FROM followers '.
                            " WHERE followers.user_id = '" . $user['id'] . "' ".
                        ') AS temp
                        LEFT JOIN users 
                        ON temp.follows_id = users.id';

            $followers = DB::select(DB::raw($str_sql));
            $followers = (new Collection($followers))->paginate(20);
            // $followings_count = count($followers);




            $checkFollow=false;
            $following_tags = TagFollower::where('user_id',$user->id)
            ->leftJoin('tags', 'tags.id', '=', 'tag_followers.tag_id')
            ->get();
            if (Auth::check()) {
                $follower = auth()->user();
                if($follower->isFollowing($user->id)) {
                    $checkFollow=true;
                }


            }

            // return view('user::UserPage.followings',compact('followers','user','checkFollow','following_tags'));
            return view('user::UserPage.followers',compact('user','followers','checkFollow','following_tags','user_infor'));
            }else{
                abort('404');
            }
    }

    public function privatePost($username)
    {
        $user= User::select()
                ->where('name', $username)
                ->first();

        if( !empty($user)){

        $user_infor=UserCalculation::where('user_id',$user->id)->first();


        $str_sql = 'SELECT '.' posts.title, users.name as username, posts.id, posts.item, posts.created_at, posts.updated_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
                    " WHERE posts.user_id ='" . $user->id . "' 
                    AND posts.status = 4
                    ORDER BY posts.updated_at desc";

            $posts = DB::select(DB::raw($str_sql));
            $posts = (new Collection($posts))->paginate(20);

            $following_tags = [];
            $checkFollow=false;
            if (Auth::check()) {
                $follower = auth()->user();
                if($follower->isFollowing($user->id)) {
                    $checkFollow=true;
                }

                $following_tags = TagFollower::where('user_id',$user->id)
                ->leftJoin('tags', 'tags.id', '=', 'tag_followers.tag_id')
                ->get();

            }

            return view('user::UserPage.private',compact('user','posts','checkFollow','following_tags','user_infor'));
            }else{
                abort('404');
            }
    }

}
