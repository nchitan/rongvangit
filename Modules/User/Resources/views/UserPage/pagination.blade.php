<?php 
if (!isset($typepage)) {
    $typepage =''; 


}else{

}
?>
@forelse ($posts as $key=>$post)
    @if ( $typepage =="comments" || $typepage =="likecomments")
          @include("user::Elements.comment_infor")
    @elseif ($typepage =="questions" || $typepage =="likequestions")
        @include("user::Elements.question_infor")
    @elseif  ( $typepage =="answears" || $typepage =="likeanswears")
        @include("user::Elements.answear_infor")
    @elseif  ( $typepage =="drafts")
        @include("user::Elements.draft_infor")
    @else
        @include("user::Elements.article_infor")
    @endif

  @empty
<div style="margin:20px 0;text-align:center"><p class="css-1yk0zej euu3pko2">Chưa có gì ở đây cả</p></div>
  @endforelse
        
     <div class="text-center">
  {{ $posts->links() }}
    </div>  



