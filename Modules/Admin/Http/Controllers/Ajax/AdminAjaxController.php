<?php
namespace Modules\Admin\Http\Controllers\Ajax;

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

class AdminAjaxController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['']);
    }

	public function banUser(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        $data=false;


        $userid = $req['srv-at'];
        $action = $req['srv-act'];

        

        
      

        if($action =="add"){
            User::where('id',$userid)->update(['role_id' =>  7]);//7: be banned
       
  


        }else if($action =="del"){   
            User::where('id',$userid)->update(['role_id' =>  6]); 
        }
        

        return response()->json(['data' => $data], '200', [], JSON_UNESCAPED_UNICODE);

    } 

	public function banItem(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([],401);
        }
        $req = $request->all();
        $data=false;


        $userid = $req['srv-at'];
        $action = $req['srv-act'];

        

        
      

        if($action =="add"){
            Post::where('id',$userid)->update(['status' =>  5]);//5: be banned
       
  


        }else if($action =="del"){   
            Post::where('id',$userid)->update(['status' =>  1]); 
        }
        

        return response()->json(['data' => $data], '200', [], JSON_UNESCAPED_UNICODE);

    }     
}