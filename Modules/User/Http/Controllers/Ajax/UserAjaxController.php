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
use App\Models\PostTagGrp;
use App\Models\PostLike;

use App\Models\Tag;
use App\Models\Answear;
use App\Models\Comment;
use App\Models\User;


use App\Models\Category;
use App\Models\SubCategory;
use App\Models\UserStock;


use App\Models\CommentLike;
use App\Models\AnswearLike;

use App\Models\UserFollower;

use App\Models\Question;
use App\Models\QuestionTagGrp;
use App\Models\QuestionLike;

use App\Models\UserCalculation;


class UserAjaxController extends Controller
{
    public function __construct() {      //  __construct クラスを追加
        $this->middleware('auth')->except(['']);
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
    public function createCategory(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $result = "";
        $req = $request->all();

        $user_id =  Auth::id();
        $category_name = $req['category_name'];
        $main_category = $req['main_category'];

      

        $data['user_id'] = $user_id;

        if($main_category == '--'){
            // $check = Category::where('username', $username)
            //         ->where('category_name', $category_name)
            //         ->first();

            // if(empty($check)){
            //     }
                $data['category_name'] = $category_name;
                $new = Category::create($data);
                $result = array($new['id'],$new['category_name'],'','');
            

        }else{
            $check = Category::where('user_id', $user_id)
                    ->where('category_name', $main_category)
                    ->first();

           

            if(!empty($check)){
                $data['category_id'] = $check['id'];
                $data['sub_category_name'] = $category_name;
                $new = SubCategory::create($data);
                $result = array($check['id'],$main_category,$new['id'],$new['sub_category_name']);

               
            }
        }

     

    return response()->json(['newCategory' => $result], '200', [], JSON_UNESCAPED_UNICODE);

    }    

public function findItem(Request $request)
    {
        $result = "";
        $req = $request->all();
        $type = $req['type'];
        $caId = $req['caId'];
        if($type == 'comment'){
            $result= Comment::where('id', $caId)
                ->where('user_id', Auth::id())
                ->first();
        }else if($type == 'answear'){

            $result= Answear::where('id', $caId)
                ->where('user_id', Auth::id())
                ->first();
        }
        return response()->json(['aa' => $result], '200', [], JSON_UNESCAPED_UNICODE);
    } 
    public function editItem(Request $request)
    {
        $result = "";
        $req = $request->all();
        $type = $req['type'];
        $caId = $req['caId'];
        if($type == 'comment'){
            $result= Comment::where('id', $caId)
                ->where('user_id', Auth::id())
                ->first();
        }else if($type == 'answear'){

            $result= Answear::where('id', $caId)
                ->where('user_id', Auth::id())
                ->first();
        }
        return response()->json(['aa' => $result], '200', [], JSON_UNESCAPED_UNICODE);
    } 

   public function deleteItem(Request $request)
    {

        $result = "";
        $req = $request->all();
        $type = $req['type'];
        $itemId = $req['itemId'];
        $atId = $req['atId'];

        $decrement_column = [
            'post_count',
            'comment_count', 
            'liked_post_count',
        ];
        if($type == 'post'){
            Post::where('id', $itemId)->delete();
            Comment::where('post_id', $itemId)->delete();
            PostTagGrp::where('post_id', $itemId)->delete();
            PostLike::where('post_id', $itemId)->delete();
            UserStock::where('post_id', $itemId)->delete();
            CommentLike::where('post_id', $itemId)->delete();



            UserCalculation::where('user_id', $atId)
                ->update([
                    'post_count' => DB::raw( 'post_count - 1' ),
                    'comment_count' => DB::raw( 'comment_count - 1' ),
                    'liked_post_count' => DB::raw( 'liked_post_count - 1' ),
                    'liked_comment_count' => DB::raw( 'comment_count - 1' ),
                ]);
            // return redirect('/post');

        }else if($type == 'question'){
            Question::find($itemId)->delete();
            Answear::where('question_id', $itemId)->delete();
            QuestionTagGrp::where('question_id', $itemId)->delete();
            QuestionLike::where('question_id', $itemId)->delete();
            AnswearLike::where('question_id', $itemId)->delete();
           

            UserCalculation::where('user_id', $atId)
                ->update([
                    'post_count' => DB::raw( 'post_count - 1' ),
                    'comment_count' => DB::raw( 'comment_count - 1' ),
                    'liked_post_count' => DB::raw( 'liked_post_count - 1' ),
                ]);

                // ->decrement('comment_count')
                // ->decrement('liked_post_count')
                // ->decrement('liked_comment_count'); 
            // return redirect('/question');

        }else if($type == 'comment'){
            $caId = $req['caId'];
            $result=Comment::find($caId)->delete();
            UserCalculation::where('user_id', $atId)
                    ->decrement('comment_count');

             // return response()->json(['delete' => $result], '200', [], JSON_UNESCAPED_UNICODE);
        }else if($type == 'answear'){
             $caId = $req['caId'];
            Answear::find($caId)->delete();
            $result=UserCalculation::where('user_id', $atId)
                    ->decrement('comment_count');

             
        }else if($type == 'post_draft'){
            Post::where('id', $itemId)->delete();
            PostTagGrp::where('post_id', $itemId)->delete();
            // return response()->json(['delete' => $result], '200', [], JSON_UNESCAPED_UNICODE);

        }else if($type == 'question_draft'){
            Question::find($itemId)->delete();
            QuestionTagGrp::where('question_id', $itemId)->delete();
            
        }else if($type == 'category'){
           $stockedid = explode(":",$itemId);
           if(isset($stockedid[1])){

   

                UserStock::where('sub_category_id', $stockedid[1])
                        ->delete();
                SubCategory::find($stockedid[1])
                        ->delete();
            }else{
                UserStock::where('category_id',  $stockedid[0])
                        ->delete();
                SubCategory::where('category_id', $stockedid[0])
                        ->delete();
                Category::find($stockedid[0])
                        ->delete();     
            } 

            // Question::find($itemId)->delete();
            // QuestionTagGrp::where('question_id', $itemId)->delete();
            
        }  
        return response()->json(['delete' => $result], '200', [], JSON_UNESCAPED_UNICODE);    

    }

    public function postComment(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $result = "";
        $req = $request->all();

        $editor = $req['editor'];
        $content = $req['content'];
        $item_id = $req['item_id'];
        $action = $req['action'];

        if($action == 'create'){
            $data['user_id'] = Auth::id();
            $data['content'] = $content;
            $data['editor'] = $editor;
            $data['post_id'] = $item_id;


            // $check = Comment::where('username', $username)
            //         ->where('item', $item)
            //         ->first();

            // if(empty($check)){
                
            // }

            $result = Comment::create($data);

            UserCalculation::where('user_id', Auth::id())
             ->increment('comment_count');  
         }else if($action == 'update'){
            $caId = $req['caId'];
             Comment::find($caId) 
                    ->update([
                            'content' => $content,
                            'editor' => $editor,
                            ]);
            $result =Comment::find($caId)->first();
         }



        return response()->json(['comment' => $result, 'user_name' => Auth::user()->name], '200', [], JSON_UNESCAPED_UNICODE);

    }

    public function stockPost(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $result = false;
        $req = $request->all();
        $user_id = Auth::id();

        $stockedid = $req['stockedid'];
        $newstockid = $req['newstockid'];
        $authorID = $req['authorID'];

        $post_id = $req['itemId'];



        
        // $userStock = UserStock::where('username', $username)
        //                 ->where('item', $item)
        //                 ->get('user_stocks.category_id');


        

        if($stockedid !== 'n'){
           $stockedid = explode(":",$stockedid);
           if(isset($stockedid[1])){

   

                UserStock::where('sub_category_id', $stockedid[1])
                        ->delete();
            }else{
                UserStock::where('category_id',  $stockedid[0])
                        ->delete();
            } 
            $result = "delete";  
            UserCalculation::where('user_id',$authorID)
                     ->decrement('stocked_post_count'); 

        }

        if($newstockid !== 'n'){
            $newstockid = explode(":",$newstockid);

           

            $data['user_id'] = $user_id;
            $data['post_id'] = $post_id;
            $data['author_id'] = $authorID;

           if(isset($newstockid[1])){
                $data['sub_category_id'] = $newstockid[1];
                $data['category_id'] = $newstockid[0];
               

            }else{
                $data['category_id'] = $newstockid[0];
            }      

            $result= UserStock::create($data);  
                UserCalculation::where('user_id',$authorID)
                         ->increment('stocked_post_count');  
        }
       

        // $category_infors = json_decode(json_encode($category_infors), true);
        // $userStock = json_decode(json_encode($userStock), true);

        // Delete
      
        // foreach($userStock as $stock ) {
        //     $checkExit = 0;
        //     foreach($category_infors as $category_infor ) {
        //         if ($stock['category_id'] == $category_infor[1]){
        //             $checkExit +=1;
        //         }
                
        //     }
        //     if($checkExit ==0){
        //         UserStock::where('category_id', $stock['category_id'])
        //             ->delete();
        //     };

        // }
    

        // // add
        // foreach($category_infors as $category_infor ) {
        //         $category_id =$category_infor[1];

        //         if($category_id ==NULL){
        //             $takeUserCategory = Category::where('category_name', $category_infor[0])
        //                 ->where('username', $username)
        //                 ->first();
        //             $data['category_id'] = $takeUserCategory['id'];

        //         }else{
        //             $data['category_id'] = $category_id;
        //         }
                

        //         $check = UserStock::where('username', $username)
        //                 ->where('category_id', $category_id)
        //                 ->where('item', $item)
        //                 ->first();


        //         if(empty($check)){
        //             $result= UserStock::create($data);
        //         }        
                               
        // }

        //         $items = DB::select(DB::raw($str_sql));
        // $post = (new Collection($items))[0];   
    

        // return view('user::Elements.category_infor', compact('post'));

            return response()->json(['stock' => $result], '200', [], JSON_UNESCAPED_UNICODE);

    }



    public function likePost(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $result =false;
        $req = $request->all();
        $action = "delete";
        $authorId = $req['atId'];
        $item_id = $req['itemId'];  

        $check = $req['check'];
        
        if ($check == "checked") {
                $action = "add";
        }

        if($action == "add"){
            $data['user_id'] =  Auth::id();
            $data['post_id'] = $item_id;
            $data['author_id'] = $authorId;
            $result = PostLike::create($data);
            
            UserCalculation::where('user_id', $authorId)
                     ->increment('liked_post_count');  

        }else if($action == "delete"){ 
            $result = PostLike::where('user_id', $authorId)
            ->where('post_id', $item_id)
            ->delete();
        
            UserCalculation::where('user_id', $authorId)
                 ->decrement('liked_post_count'); 
        }

        return response()->json(['like' => $result], '200', [], JSON_UNESCAPED_UNICODE);
        


    }  

        public function likeComment(Request $request){
        $result =false;
        $req = $request->all();
        $authorId = $req['atId'];
        $post_id = $req['itemId'];
        $check = $req['check'];
        $comment_id = $req['commentId'];

        $action = "delete";
        if ($check == "checked") {
                $action = "add";
        }



        if($action == "add"){
            $data['user_id'] = Auth::id();
            $data['post_id'] = $post_id;
            $data['author_id'] = $authorId;
            $data['comment_id'] = $comment_id;
            
            $result=CommentLike::create($data);
                
            UserCalculation::where('user_id', $authorId)
                 ->increment('liked_comment_count');                     
                
        }else if($action == "delete"){
                $result = CommentLike::where('comment_id', $comment_id)
                ->delete();
                UserCalculation::where('user_id', $authorId)
                         ->decrement('liked_comment_count');  
        }
        return response()->json(['like' => $result], '200', [], JSON_UNESCAPED_UNICODE);
    } 

    //quest
    public function answearQuestion(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $result = "";
        $req = $request->all();


        $content = $req['content'];
        $item_id = $req['item_id'];
        $editor = $req['editor'];
        $action = $req['action'];

        if($action == 'create'){

            $data['user_id'] = Auth::id();
            $data['content'] = $content;
            $data['question_id'] = $item_id;
            $data['editor'] = $editor;


            // $check = Comment::where('username', $username)
            //         ->where('item', $item)
            //         ->first();

            // if(empty($check)){
                
            // }

            $result = Answear::create($data);

            UserCalculation::where('user_id', Auth::id())
             ->increment('answear_count');
        }else if($action == 'update'){
            $caId = $req['caId'];
             Answear::find($caId) 
                    ->update([
                            'content' => $content,
                            'editor' => $editor,
                            ]);
            $result =Answear::find($caId)->first();
         }
           
        return response()->json(['comment' => $result, 'user_name' => Auth::user()->name], '200', [], JSON_UNESCAPED_UNICODE);

    }

public function likeAnswear(Request $request){
        $result =false;
        $req = $request->all();
        $authorId = $req['atId'];
        $question_id = $req['itemId'];
        $check = $req['check'];
        $answear_id = $req['commentId'];

        $action = "delete";
        if ($check == "checked") {
                $action = "add";
        }

        // $check = AnswearLike::where('answear_id', $answear_id)
        //         ->where('user_id', Auth::id())
        //         ->first();

        // if (!$check) {
        //     return response()->json([],401);
        // }

        if($action == "add"){
            $data['user_id'] = Auth::id();
            $data['author_id'] = $authorId;
            $data['question_id'] = $question_id;
            $data['answear_id'] = $answear_id;
            
            $result=AnswearLike::create($data);
                
            UserCalculation::where('user_id', $authorId)
                 ->increment('liked_answear_count');                     
                
        }else if($action == "delete"){
                $result = AnswearLike::where('answear_id', $answear_id)
                ->delete();
                UserCalculation::where('user_id', $authorId)
                         ->decrement('liked_answear_count');  
        }
        return response()->json(['like' => $result], '200', [], JSON_UNESCAPED_UNICODE);
    } 

        public function likeQuestion(Request $request){
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $result =false;
        $req = $request->all();
        $action = "delete";
        $authorId = $req['atId'];
        $item_id = $req['itemId'];  

        $check = $req['check'];
        
        if ($check == "checked") {
                $action = "add";
        }

        if($action == "add"){
            $data['user_id'] =  Auth::id();
            $data['question_id'] = $item_id;
            $data['author_id'] = $authorId;
            $result = QuestionLike::create($data);
       
            UserCalculation::where('user_id', $authorId)
                     ->increment('liked_question_count');  
        }else if($action == "delete"){ 
            $result = QuestionLike::where('user_id', $authorId)
            ->where('question_id', $item_id)
            ->delete();
          
            UserCalculation::where('user_id', $authorId)
                 ->decrement('liked_question_count'); 
        }

        return response()->json(['like' => $result], '200', [], JSON_UNESCAPED_UNICODE);

    } 


    

}
