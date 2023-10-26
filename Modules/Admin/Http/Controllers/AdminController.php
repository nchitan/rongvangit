<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Report;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except(['']);
    }

    public function index()
    {
        
        return view('admin::admin.index');
    }  

           

    public function user()
    {
        $list = User::select()
                    ->get()
                    ->paginate(20);

            return view('admin::management.userlist',compact('list'));

    }
    public function itemlist()
    {


            $str_sql = 'SELECT '.' posts.title, posts.id, posts.user_id, posts.item, posts.status, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path,users.name as username
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
                ORDER BY temp_tbl2.count desc ';
            $posts = DB::select(DB::raw($str_sql));    
            $posts = (new Collection($posts))->paginate(20);

            return view('admin::management.itemlist',compact('posts'));

    }
    public function userReport()
    {
        $list = Report::select()
                    ->leftJoin('users','users.id', '=', 'reported_id')
                    ->get()
                    ->paginate(20);

            return view('admin::report.userlist',compact('list'));

    }

    public function userBanList()
    {
        $list = User::select()
                    ->where('role_id',7)
                    ->get()
                    ->paginate(20);

            return view('admin::report.userBanList',compact('list'));

    }    
    public function itemReport()
    {
            $str_sql = 'SELECT '.' posts.title, posts.user_id, posts.item, posts.created_at, temp_tbl.tags,temp_tbl2.count,users.profile_photo_path,users.name as username, reports.data
                FROM reports 

                LEFT JOIN posts ON posts.id = reports.item_id
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
                WHERE ( posts.status = 5 )
                AND reports.item_type = "post"
                ORDER BY temp_tbl2.count desc ';
            $posts = DB::select(DB::raw($str_sql));    
            $posts = (new Collection($posts))->paginate(20);

            return view('admin::report.itemlist',compact('posts'));

    }

    // public function getTagList($username)
    // {
    //     $listTag = Tag::select()
    //                 ->get()
    //                 >paginate(20);

    //         return view('admin::tagManagement.taglist',compact('listTag'));

    // }   

    // public function getReport($username)
    // {
    //     $listReport = Report::select()
    //                 ->get()
    //                 >paginate(20);

    //         return view('admin::tagManagement.taglist',compact('listTag'));

    // }   
}
