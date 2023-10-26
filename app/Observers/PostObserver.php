<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPost;

use Illuminate\Support\Facades\Log;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {

        $user = User::where('id', $post->user_id)->first();   
        if( $post->status == 1 || $post->status == 3 )     
        {
  
            foreach ($user->followers as $follower) {
                $follower->notify(new NewPost($user, $post));
            }
        }else{
  
        }


        
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
