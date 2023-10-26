<?php

namespace Modules\User\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Photo;
 
 
class UploadImageController extends Controller
{
    public function index()
    {
        return view('user::Post.image');
    }
 
    public function save(Request $request)
    {
         
        $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
 
        ]);

               
        $req = $request->all();
       
  

 
        $name = $request->file('image')->getClientOriginalName();
        $savepath = 'public/images/users/'.Auth::id();
        $path = $request->file('image')->store($savepath);
     
 
 
        $save = new Photo;
 
        $save->name = $name;
        $save->path = $path;
 
        $save->save();
        $result=array($name, $path);
    
 
        // return redirect('user::Post.image')->with('status', 'Image Has been uploaded');
        //return redirect() -> route('user.imgIndex')->with('status', 'Image Has been uploaded');
        // return redirect()->back()->withInput();
        return response()->json(['img' => $result], '200', [], JSON_UNESCAPED_UNICODE);
 
    }
}