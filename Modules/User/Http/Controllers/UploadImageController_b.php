<?php
  
namespace Modules\User\Http\Controllers;
  
use Illuminate\Http\Request;
  
class ImageUploadController extends Controller
{
     /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        //https://www.itsolutionstuff.com/post/laravel-8-image-upload-tutorial-exampleexample.html
        return view('imageUpload');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images'), $imageName);
  
        /* Store $imageName name in DATABASE from HERE */
    
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}