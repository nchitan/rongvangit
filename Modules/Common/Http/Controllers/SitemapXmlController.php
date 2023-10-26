<?php
namespace Modules\Common\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Question;
use Illuminate\Routing\Controller;

class SitemapXmlController extends Controller
{
    public function index() {
        $posts = Post::select()
                    ->leftJoin('users','users.id','=','posts.user_id')
                    ->where('posts.status', '=', 1)
                    ->orWhere('posts.status', '=', 3)
                    ->get();
        $questions = Question::select()
                    ->leftJoin('users','users.id','=','questions.user_id')
                    ->where('questions.status', '=', 1)
                    ->orWhere('questions.status', '=', 3)
                    ->get();

        return response()->view('common::Sitemap.index', [
            'posts' => $posts, 'questions' => $questions,
        ])->header('Content-Type', 'text/xml');
      }
}