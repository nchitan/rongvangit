<?php

namespace Modules\User\Http\Controllers\Ajax;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request ;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTagGrp;
use App\Models\PostLike;
use App\Models\Category;
use App\Models\UserStock;
use App\Models\Comment;
use App\Models\CommentLike;

use Illuminate\Support\Facades\DB;



class UserPageAjaxController extends Controller
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
    



}
