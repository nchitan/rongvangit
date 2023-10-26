<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request ;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;


use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\PostTagGrp;
use Illuminate\Support\Facades\DB;
use App\Models\PostLike;
use App\Models\Category;
use App\Models\Serie;
use App\Models\Comment;
use App\Models\UserStock;
use App\Models\CommentLike;
use App\Models\Question;
use App\Models\QuestionTagGrp;
use App\Models\QuestionLike;
use App\Models\Answear;
use App\Models\AnswearLike;
use App\Notifications\UserFollowed;
use App\Models\UserCalculation;


class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['showPost','showQuestion','postLiker']);
    }


    // public function generate_rss_feed()
    // {
    //     $users = User::orderBy('id', 'desc')
    //                 ->get();
    //     return response()->view('feed', compact('users'))->header('Content-Type', 'application/xml');
        

    // }

    public function notifications()
    {
        // return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
        $resutl1= auth()->user()->notifications()->limit(20)->get()->toArray();
        //$resutl2= auth()->user()->notifications()->latest()->get()->toArray();
        
 
         return($resutl1);
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createPost()
    {
        $user = Auth::user();

        $username=$user->name;
        $user_id=$user->id;

        return view('user::Post.createPost', compact('username','user_id'));
    }


    public function stock()
    {

        $tempsql ="SELECT"." categories.category_name as category_name , categories.id as id, temp_tbl.sub_category_names as sub_category_names
                    FROM categories
                    LEFT JOIN (
                        SELECT sub_categories.category_id as category_id, GROUP_CONCAT(concat(sub_categories.sub_category_name,':',sub_categories.id) ) as sub_category_names 
                        FROM sub_categories
                        GROUP BY sub_categories.category_id
                    ) AS temp_tbl
                    ON temp_tbl.category_id = categories.id ".
                    " WHERE categories.user_id ='" . Auth::id() . "' ";
                $categories = DB::select(DB::raw($tempsql));
                $categories = json_decode(json_encode($categories), true);

                
                
       
        $str_sql = 
                'SELECT'. ' tmp.name as username , tmp.item  ,category_id ,sub_category_id,tmp.title, tmp.created_at, tmp.tags,tmp.count,tmp.profile_photo_path
                FROM user_stocks
                LEFT JOIN(

                    SELECT posts.title, posts.item, users.name, posts.id as post_id, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
                )as tmp 
                ON tmp.post_id = user_stocks.post_id'.
                " WHERE user_stocks.user_id ='" . Auth::id() . "' ".
                " AND user_stocks.category_id ='" . $categories[0]['id'] . "' ";



                    
        $typepage= 'posts';
        $posts = DB::select(DB::raw($str_sql));
        $posts = (new Collection($posts))->paginate(20);



            //return view('user::UserPage.pagination',compact('posts','typepage'))->render();

        return view('user::Stock.stock', compact('categories','posts','typepage'));
     
    }   

   public function stockContent(Request $request)
   {
        $result = "";
        $req = $request->all();

        $username = Auth::user()->name;

        $category_id = explode(":",$req['cateid']);
        $keyword = $req['q'];
        if($keyword == '')
        {
            
            if(!isset($category_id[1])){

            $str_sql = 'SELECT'. ' tmp.username , item, user_stocks.post_id  ,category_id ,sub_category_id,tmp.title, tmp.created_at, tmp.tags,tmp.count,tmp.profile_photo_path
            FROM user_stocks
            LEFT JOIN(

                SELECT posts.title, posts.item,users.name as username, posts.id as post_id, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
            )as tmp 
            ON tmp.post_id = user_stocks.post_id'.
            " WHERE user_stocks.user_id ='" . Auth::id() . "' ".
            " AND user_stocks.category_id ='" . $category_id[0] . "' ";
            }else{
               $str_sql = 'SELECT'. ' tmp.username ,item, user_stocks.post_id  ,category_id ,sub_category_id,tmp.title, tmp.created_at, tmp.tags,tmp.count,tmp.profile_photo_path
                FROM user_stocks
                LEFT JOIN(

                    SELECT posts.title, posts.item, users.name as username, posts.id as post_id, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
                )as tmp 
                ON tmp.post_id = user_stocks.post_id'.
                " WHERE user_stocks.user_id ='" . Auth::id() . "' ".
                " AND user_stocks.sub_category_id ='" . $category_id[1] . "' ".
                " AND user_stocks.category_id ='" . $category_id[0] . "' ";

            }

    }else{
        if(!isset($category_id[1])){

            $str_sql = 'SELECT'. ' tmp.username , tmp.item, tmp.content, user_stocks.post_id  ,category_id ,sub_category_id,tmp.title, tmp.created_at, tmp.tags,tmp.count,tmp.profile_photo_path
            FROM user_stocks
            LEFT JOIN(

                SELECT posts.title, posts.item, posts.content, users.name as username, posts.id, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
            )as tmp 
            ON tmp.id = user_stocks.post_id'.
            " WHERE user_stocks.user_id ='" . Auth::id() . "' ".
            " AND user_stocks.category_id ='" . $category_id[0] . "' ".
            " AND (tmp.title LIKE '%".$keyword."%' ".
            " OR tmp.username  LIKE '%".$keyword."%' ". 
            " OR tmp.content  LIKE '%".$keyword."%' )";


            ;
        }else{
           $str_sql = 'SELECT'. ' tmp.username , tmp.item, tmp.content, user_stocks.post_id  ,category_id ,sub_category_id,tmp.title, tmp.created_at, tmp.tags,tmp.count,tmp.profile_photo_path
            FROM user_stocks
            LEFT JOIN(

                SELECT posts.title, posts.item, posts.content, users.name as username, posts.id, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path
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
            )as tmp 
            ON tmp.id = user_stocks.post_id'.
            " WHERE user_stocks.user_id ='" . Auth::id() . "' ".
            " AND user_stocks.sub_category_id ='" . $category_id[1] . "' ".
            " AND user_stocks.category_id ='" . $category_id[0] . "' ".
            " AND ( tmp.title LIKE '%".$keyword."%' ".
            " OR tmp.username LIKE '%".$keyword."%' ". 
            " OR tmp.content  LIKE '%".$keyword."%' )";

        }

}

        
        $typepage= 'posts';
        $posts = DB::select(DB::raw($str_sql));
        $posts = (new Collection($posts))->paginate(20);
        return view('user::UserPage.pagination',compact('posts','typepage'))->render();
   }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

   public function editPost($item)
    {
        $checkpost = Post::where("item", $item)->first();
        if($checkpost){

            $str_sql ="SELECT '' "."as type, title,published_at, content, editor, series.serie_name as serie, status, posts.item, updated_at, temp_tbl.tags
                    FROM posts
                    LEFT JOIN series ON series.id = posts.serie_id
                    LEFT JOIN (
                            SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                            FROM post_tag_grps
                            LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                            GROUP BY post_tag_grps.post_id
                    ) AS temp_tbl
                    ON temp_tbl.post_id = posts.id ".
                    " WHERE posts.id ='". $checkpost['id'] . "' ".
                " AND posts.user_id ='" . Auth::id() . "'  LIMIT 1";

            $post = DB::select(DB::raw($str_sql));
            $post = json_decode(json_encode($post), true);

            return view('user::Post.editPost', compact('post'));
        }else{
            abort('404');
        }

        //return redirect() -> route('user.editPost', ['item' => $item]);

    }

    public function postLiker($user,$item)
    {
        $url =  "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
       
        if(strpos($url, "posts") === true){
        $post = Post::where("item", $item)->first();
        
        $likers = PostLike::where('post_id', $post->id)
                ->leftJoin('users', 'users.id', '=', 'post_likes.user_id')
                ->get()
                ->paginate(20);
        }else{
        $post = Question::where("item", $item)->first();
        
        $likers = QuestionLike::where('question_id', $post->id)
                ->leftJoin('users', 'users.id', '=', 'question_likes.user_id')
                ->get()
                ->paginate(20);

        }

        return view('user::Post.postLiker', compact('likers','user', 'post'));
    }
    
   public function drafts()
    {
        $user_id =Auth::id();
        $str_sql ="(SELECT '' as type, title, posts.id as id,  content, status, posts.item,updated_at,temp_tbl.tags
            FROM posts
            
            LEFT JOIN (
                    SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM post_tag_grps
                    LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                    GROUP BY post_tag_grps.post_id
            ) AS temp_tbl
            ON temp_tbl.post_id = posts.id
            WHERE (status = 2 )
            ".
            " AND posts.user_id ='" . $user_id . "' ".
            ")

            UNION ALL

            (SELECT type, title, questions.id as id, content, status,questions.item, updated_at,temp_tbl.tags
            FROM questions
            LEFT JOIN (
                    SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM question_tag_grps
                    LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                    GROUP BY question_tag_grps.question_id
            ) AS temp_tbl
            ON temp_tbl.question_id = questions.id
            

            WHERE (status = 2 ) ".
            " AND questions.user_id ='" . $user_id . "' ".


            ")
            ORDER BY updated_at desc";


    
        $items = DB::select(DB::raw($str_sql));
        $posts = (new Collection($items))->paginate(20);   
        $typepage='drafts' ;

        return view('user::Post.drafts', compact('posts','typepage'));

      

        //return redirect() -> route('user.editPost', ['item' => $item]);

    }

public function draftContent(Request $request)
    {
        $req = $request->all();
       
        


        if ($request->filled('item')) {
            $item = $req['item'];
        }  
        if ($request->filled('type')) {
            $type = $req['type'];
        }
        $user_id =Auth::id();

        if(isset($type)){
            $str_sql =
            "SELECT "." type, title, id, user_id,content, status, questions.item, updated_at, temp_tbl.tags
                FROM questions

                LEFT JOIN (
                    SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM question_tag_grps
                    LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                    GROUP BY question_tag_grps.question_id
            ) AS temp_tbl
            ON temp_tbl.question_id = questions.id ".
                " WHERE questions.item ='". $item . "' ".
            " AND questions.user_id ='" . $user_id . "'  LIMIT 1";

        }else{
            $str_sql ="SELECT '' "."as type, id, user_id, title, content, status, posts.item, updated_at, temp_tbl.tags
                FROM posts

                LEFT JOIN (
                    SELECT post_tag_grps.post_id as post_id, GROUP_CONCAT(tags.tag_name) as tags
                    FROM post_tag_grps
                    LEFT JOIN tags ON post_tag_grps.tag_id = tags.id
                    GROUP BY post_tag_grps.post_id
                ) AS temp_tbl
                ON temp_tbl.post_id = posts.id ".
                " WHERE posts.item ='". $item . "' ".
            " AND posts.user_id ='" . $user_id . "'  LIMIT 1";


            }
        
        $items = DB::select(DB::raw($str_sql));
        $post = (new Collection($items))[0];   


    

        return view('user::Elements.draft_content', compact('post'));

      

        //return redirect() -> route('user.editPost', ['item' => $item]);

    }

    public function publishPost(Request $request)
    {
        $req = $request->all();

        if ($request->filled('item')) {
            $item = $req['item'];
        } 
        Post::where('item', $item)
                ->where('user_id', Auth::id())
                ->update(['status' => 1]);

                

        UserCalculation::where('user_id', Auth::id())
                         ->increment('post_count');  
                
        return redirect() -> route('user.showPost', ['username' => Auth::user()->name, 'item' => $item]);
      

    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function storePost(Request $request)
    {

        // if($validated->fails())
        // {
        //     return redirect()->back()->withErrors($validated)->withInput();
        // }
         

        $req = $request->all();
        if ($request->filled('action')) {
            $action = $req['action'];
        }


        if($action == 'create'){
             $validated = $request->validate([
                'title' => 'required|unique:posts|max:255',
                'content' => 'required',
                'editor' => 'required',
                'tags' => 'required',
                'item' => 'unique:posts',
             ]);
        }else if($action == 'update'){
             $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'editor' => 'required',
                'tags' => 'required',
             ]);

        }       


        if ($request->filled('title')) {
            $title = $req['title'];
        }  
        if ($request->filled('editor')) {
            $editor = $req['editor'];
        }
        if ($request->filled('content')) {
            $content = $req['content'];
        }
        if ($request->filled('published_at')) {
            $published_at = $req['published_at'];
        }
        if ($request->filled('item')) {
            $item = $req['item'];
        }
        if ($request->filled('tags')) {
            $tags = explode(",",$req['tags']);
        }
        if ($request->filled('pfmt')) {
            $status = $req['pfmt'];
        }
        if ($request->filled('serie')) {
            $serie = $req['serie'];
        }   
        if(isset($published_at)){
            if($published_at > now()){
                $status = 4;
            }
         }else{
            $published_at = now();
         }

        $serie_id=null;     
        if(isset($serie)){
            $checkserie = Serie::where('serie_name',$serie)->first();
            if($checkserie){
                $serie_id = $checkserie->id;
            }else{
                $tbl['serie_name'] = $serie;
                $tbl['user_id'] = Auth::id();
                $makeserie = Serie::create($tbl);
                $serie_id = $makeserie->id;
            }
        }
  

        $postid = '';
        if($action == 'create'){
            $post_tbl['user_id'] = Auth::id();
            $post_tbl['title'] = $title;
            $post_tbl['published_at'] = $published_at;

            $post_tbl['editor'] =$editor;
            $post_tbl['content'] =$content;
            $post_tbl['item'] =$item; 
            $post_tbl['serie_id'] =$serie_id; 
            $post_tbl['status'] =$status; 
            $post_tbl['published_at'] = $published_at;
            $makepost = Post::create($post_tbl);
            $postid = $makepost->id;
        
        }else if($action == 'update'){
            $checkpost = Post::where('user_id', Auth::id())
                        ->where('item', $item)
                        ->first();
            $postid = $checkpost->id;
            $update_column = [
                    'title' => $title,
                    'editor' => $editor, 
                    'content' => $content,
                    'item' => $item,
                    'published_at' => $published_at,
                    'serie_id' => $serie_id,
                    'status' => $status
            ];
            Post::where('item', $item)
                ->where('user_id', Auth::id())
                ->update($update_column);
            PostTagGrp::where('post_id', $checkpost->id)
                ->where('user_id', Auth::id())
               ->delete();
        }

        foreach($tags as $tag ) {
          
            $checktag = Tag::where('slug', mb_strtolower($tag))->first();

            if (!empty($checktag)) {
                $tag = $checktag['tag_name'];
            }else{
                $tag_tbl["slug"] = mb_strtolower($tag);
                $tag_tbl["tag_name"] = $tag;
                $checktag=Tag::create($tag_tbl);
            } 

            
            $post_tag_tbl['post_id'] =  $postid;
            $post_tag_tbl['tag_id'] = $checktag->id;
            $post_tag_tbl['user_id'] = Auth::id();
            PostTagGrp::create($post_tag_tbl);
        }


        if($status ==1 || $status ==3 || $status ==4){
            if($status ==1){
                UserCalculation::where('user_id', Auth::id())
                     ->increment('post_count');  
            }
            return redirect() -> route('user.showPost', ['username' => Auth::user()->name, 'item' => $item]);
        }else if($status ==2){
            return redirect() -> route('user.drafts');
           
            // return back()->withInput();
        }else{
             abort('404');
        };

    }



    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showPost($username,$item)
    {
        $checkpost = Post::where('item',$item )->first();

        if(!$checkpost){
            abort('404');
         }   
        $countview = $checkpost->view;
        if( $checkpost->user_id != Auth::id()){
            
            Post::find($checkpost->id)
                 ->increment('view');  
            $countview += 1;
        }

        $post_id = $checkpost->id;
        $str_sql =
                'SELECT '. ' posts.title, posts.status, posts.view ,  posts.id as post_id, users.name, users.about, posts.item,posts.content, posts.created_at,posts.updated_at, temp_tbl.tags,temp_tbl2.countlike, temp_tbl3.countstock, users.profile_photo_path, users.fullname,  users.id as user_id, series.serie_name as serie
                FROM posts
                LEFT JOIN series ON series.id = posts.serie_id
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
                    SELECT user_stocks.post_id as post_id,
                    COUNT(DISTINCT user_stocks.user_id) as countstock
                    FROM user_stocks
                    
                    GROUP BY user_stocks.post_id
                ) AS temp_tbl3
                ON temp_tbl3.post_id = posts.id

                LEFT JOIN users ON posts.user_id = users.id'.
                " WHERE posts.id ='" . $post_id . "' ";
       

        // $post=Post::find(1);
        // $user = $post->user;

        
        // foreach ($user->followers as $follower) {
        //     $follower->notify(new NewPost($user, $post));
        // }

        $posts = DB::select(DB::raw($str_sql));
        if(!empty($posts)){
            $posts = json_decode(json_encode($posts), true);
            $str_sql_comment = 'SELECT'.
                ' comments.id, comments.content, comments.created_at, comments.updated_at, users.name, comments.user_id,users.profile_photo_path,temp_tbl.count '.
                ' FROM comments '.
                ' LEFT JOIN( '.
                '    SELECT '. 'comment_likes.comment_id as comment_id, '.
                '    COUNT(DISTINCT comment_likes.user_id) as count '.
                '    FROM comment_likes '.
                "    WHERE comment_likes.post_id = '" . $post_id . "' ".
                '    GROUP BY comment_likes.comment_id '.
                ') AS temp_tbl '.

                ' ON temp_tbl.comment_id = comments.id '.

                ' LEFT JOIN users ON comments.user_id = users.id'.

                " WHERE comments.post_id = '" . $post_id . "' ";

            $comments = DB::select(DB::raw($str_sql_comment));
            $comments = json_decode(json_encode($comments), true);
            $commentLikes = CommentLike::where('post_id', $post_id) ->get();
            $series=[];
            if($checkpost->serie_id){

            $series = Post::where('serie_id', $checkpost->serie_id)
                            ->where('id', '!=', $checkpost->id) 
                            ->orderBy('created_at')
                            ->limit(5)
                            ->get();
                            }

            
            $like_check ="";
            $categories =[];
            $checkStock=[];
            $commentLikes_check=[];
            $checkFollow='false';
            
             if (Auth::check()) {
                
                $follower = Auth::user();
                $user =User::where('name', $username)->first();
                if(Auth::user()->name ==$user->name ){
                    $checkFollow='same';
                }elseif($follower->isFollowing($user->id)) {
                    $checkFollow='true';
                }

                $temp = PostLike::where('post_id', $post_id)
                                         ->where('user_id', Auth::id())
                                         ->first() ;
                if(!empty($temp)){ 
                    $like_check ="liked";                  
                }
                



                $tempsql ="SELECT"." categories.category_name as category_name , categories.id as id, temp_tbl.sub_category_names as sub_category_names
                    FROM categories
                    LEFT JOIN (
                        SELECT sub_categories.category_id as category_id, GROUP_CONCAT(concat(sub_categories.sub_category_name,':',sub_categories.id) ) as sub_category_names 
                        FROM sub_categories
                        GROUP BY sub_categories.category_id
                    ) AS temp_tbl
                    ON temp_tbl.category_id = categories.id ".
                    " WHERE categories.user_id ='" . Auth::id() . "' ";
                $categories = DB::select(DB::raw($tempsql));
                $categories = json_decode(json_encode($categories), true);

                
                // $checkS = UserStock::leftJoin('categories', 'categories.id', '=', 'user_stocks.category_id')
                //     ->leftJoin('sub_categories', 'sub_categories.id', '=', 'user_stocks.sub_category_id')
                //     ->where('user_stocks.user_id', Auth:id())
                //     ->where('user_stocks.post_id', $post_id)
                //     ->get(['categories.category_name','sub_categories.sub_category_name']);



                $tempsql ="SELECT"." categories.category_name, sub_categories.sub_category_name
                        FROM user_stocks 
                        left join categories on categories.id = user_stocks.category_id 
                        left join sub_categories on sub_categories.id = user_stocks.sub_category_id ".
                        " WHERE user_stocks.user_id ='" .  Auth::id() . "' ".
                        " AND user_stocks.post_id ='" . $post_id . "' ";
                $checkS = DB::select(DB::raw($tempsql));
                // $checkS = json_decode(json_encode($checkS), true);        

                foreach($checkS as $value){
                    if(isset($value->sub_category_name)){
                        array_push($checkStock, $value->sub_category_name);
                    }else{
                        array_push($checkStock, $value->category_name);
                    }

                    // $tack = array($value->category_name, $value->sub_category_name);
                    // array_push($checkStock, $tack);
                }

                $checkStock = json_decode(json_encode($checkStock), true);
               
                $checkC = CommentLike::where('post_id', $post_id) 
                    ->where('user_id',Auth::id()) 
                    ->get('comment_id');
                foreach($checkC as $value){
                    array_push($commentLikes_check, $value['comment_id']);
                }
            }        
            $user= User::select()
                ->where('name', $username)
                ->first();

            if($posts[0]['status'] == 1 || $posts[0]['status'] == 3){
                return view('user::Post.showPost', compact('posts','user','like_check','categories','comments','checkStock','commentLikes','commentLikes_check','checkFollow','series','countview'));

            }else if($posts[0]['status'] == 4){
                return view('user::Post.privatePost', compact('posts','user','like_check','categories','comments','checkStock','commentLikes','commentLikes_check','checkFollow','series','countview'));

            }else{
                abort('404');
            }
        }else{
            abort('404');
        }
    }



    //*******************
    //Question
    public function createQuestion()
    {
        $user = Auth::user();

        $username=$user->name;
        $user_id=$user->id;

        return view('user::Question.createQuestion', compact('username','user_id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

   public function editQuestion($item)
    {
        $checkquestion = Question::where("item", $item)->first();
        if($checkquestion){

            $str_sql ="SELECT '' "."as type, title, type, content, editor, status, questions.item, updated_at, temp_tbl.tags
                    FROM questions

                    LEFT JOIN (
                            SELECT question_tag_grps.question_id as question_id, GROUP_CONCAT(tags.tag_name) as tags
                            FROM question_tag_grps
                            LEFT JOIN tags ON question_tag_grps.tag_id = tags.id
                            GROUP BY question_tag_grps.question_id
                    ) AS temp_tbl
                    ON temp_tbl.question_id = questions.id ".
                    " WHERE questions.id ='". $checkquestion['id'] . "' ".
                " AND questions.user_id ='" . Auth::id() . "'  LIMIT 1";

            $post = DB::select(DB::raw($str_sql));
            $post = json_decode(json_encode($post), true);

            return view('user::Question.editQuestion', compact('post'));
        }else{
            abort('404');
        }        
       
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function storeQuestion(Request $request)
    {

        $req = $request->all();

        if ($request->filled('action')) {
            $action = $req['action'];
        }
        if($action == 'create'){
            $validated = $request->validate([
                'title' => 'required|unique:questions|max:255',
                'content' => 'required',
                'editor' => 'required',
                'tags' => 'required',
                'item' => 'unique:posts',
             ]);
        }else if($action == 'update'){
             $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'editor' => 'required',
                'tags' => 'required',
             ]);

        } 


        if ($request->filled('title')) {
            $title = $req['title'];
        }  
        if ($request->filled('editor')) {
            $editor = $req['editor'];
        }
        if ($request->filled('content')) {
            $content = $req['content'];
        }
        if ($request->filled('item')) {
            $item = $req['item'];
        }
        if ($request->filled('tags')) {
            $tags = explode(",",$req['tags']);
        }
        if ($request->filled('type')) {
            $type = $req['type'];
            if ($type =="NOT_SET"){
                $type = 'Q&A';
            }
        }
        if ($request->filled('pfmt')) {
            $status = $req['pfmt'];
        }




        $postid = '';

        if($action == 'create'){
                $question_tbl['user_id'] = Auth::id();
                $question_tbl['type'] =$type; 
                $question_tbl['title'] = $title;
                $question_tbl['editor'] =$editor;
                $question_tbl['content'] =$content;
                $question_tbl['item'] =$item; 
                $question_tbl['status'] =$status;            
                $makepost = Question::create($question_tbl);
                $postid = $makepost->id;
        }else if($action == 'update'){
            $checkpost = Question::where('user_id', Auth::id())
                        ->where('item', $item)
                        ->first();
            $postid = $checkpost->id;
            $update_column = [
                    'title' => $title,
                    'editor' => $editor, 
                    'content' => $content,
                    'item' => $item,
                    'type' => $type,
                    'status' => $status
            ];
            Question::where('item', $item)
                ->where('user_id', Auth::id())
                ->update($update_column);
            QuestionTagGrp::where('question_id', $checkpost->id)
                ->where('user_id', Auth::id())
               ->delete();

        }
        foreach($tags as $tag ) {
            $checktag = Tag::where('slug', mb_strtolower($tag))->first();

            if (!empty($checktag)) {
                $tag = $checktag['tag_name'];
            }else{
                $tag_tbl["slug"] = mb_strtolower($tag);
                $tag_tbl["tag_name"] = $tag;
                $checktag=Tag::create($tag_tbl);
            }  
            $question_tag_tbl['question_id'] = $postid;
            $question_tag_tbl['tag_id'] = $checktag->id;
            $question_tag_tbl['user_id'] = Auth::id();
            QuestionTagGrp::create($question_tag_tbl);                           
        }

        if($status ==1 || $status ==3){
            UserCalculation::where('user_id', Auth::id())
                     ->increment('question_count'); 
            return redirect() -> route('user.showQuestion', ['username' => Auth::user()->name, 'quetion' => $item]);
        }else if($status ==2){
            return redirect() -> route('user.drafts');
           
            // return back()->withInput();
        }else{
             abort('404');
        };

    }



    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
public function showQuestion($username,$item)
    {
        $checkquestion = Question::where('item',$item )->first();
        if(!$checkquestion){
            abort('404');
         }   

        $countview = $checkquestion->view;
        if( $checkquestion->user_id != Auth::id()){
            
            Question::find($checkquestion->id)
                 ->increment('view');
            $countview += 1;
        }

 

        $question_id = $checkquestion->id;
        $str_sql =
                'SELECT '. ' questions.title, questions.type, questions.view , questions.id as post_id , users.name, users.about, questions.item,questions.content, questions.created_at,questions.updated_at, temp_tbl.tags,temp_tbl2.countlike, users.profile_photo_path, users.fullname,  users.id as user_id
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
                    COUNT(DISTINCT question_likes.user_id) as countlike
                    FROM question_likes
                    
                    GROUP BY question_likes.question_id
                ) AS temp_tbl2
                ON temp_tbl2.question_id = questions.id

                LEFT JOIN users ON questions.user_id = users.id'.
                " WHERE questions.id ='" . $question_id . "' ";
       

        $posts = DB::select(DB::raw($str_sql));
        if(!empty($posts)){
            $posts = json_decode(json_encode($posts), true);
            $str_sql_answear = 'SELECT'.
                ' answears.id, answears.content, answears.created_at, answears.updated_at, users.name, answears.user_id,users.profile_photo_path,temp_tbl.count '.
                ' FROM answears '.
                ' LEFT JOIN( '.
                '    SELECT '. 'answear_likes.answear_id as answear_id, '.
                '    COUNT(DISTINCT answear_likes.user_id) as count '.
                '    FROM answear_likes '.
                "    WHERE answear_likes.question_id = '" . $question_id . "' ".
                '    GROUP BY answear_likes.answear_id '.
                ') AS temp_tbl '.

                ' ON temp_tbl.answear_id = answears.id '.

                ' LEFT JOIN users ON answears.user_id = users.id'.

                " WHERE answears.question_id = '" . $question_id . "' ";

            $comments = DB::select(DB::raw($str_sql_answear));
            $comments = json_decode(json_encode($comments), true);
            $commentLikes = AnswearLike::where('question_id', $question_id) ->get();

            
            $like_check ="";
            $categories =[];
            $checkStock=[];
            $commentLikes_check=[];
            $checkFollow='false';
            
             if (Auth::check()) {
                
                $follower = Auth::user();
                $user =User::where('name', $username)->first();
                if(Auth::user()->name ==$user->name ){
                    $checkFollow='same';
                }elseif($follower->isFollowing($user->id)) {
                    $checkFollow='true';
                }

                $temp = QuestionLike::where('question_id', $question_id)
                                         ->where('user_id', Auth::id())
                                         ->first() ;
                if(!empty($temp)){ 
                    $like_check ="liked";                  
                }

               
                $checkC = AnswearLike::where('question_id', $question_id) 
                    ->where('user_id',Auth::id()) 
                    ->get('answear_id');
                foreach($checkC as $value){
                    array_push($commentLikes_check, $value['answear_id']);
                }
            }        
 
            return view('user::Question.showQuestion', compact('posts','like_check','categories','comments','checkStock','commentLikes','commentLikes_check','checkFollow','countview'));
        }else{
            abort('404');
        }
    }
}



    