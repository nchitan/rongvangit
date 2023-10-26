<?php 
if (!isset($typepage)) {
    $typepage =''; 
}

?>
@forelse ($posts as $post)
    @if ( $typepage =="comments" || $typepage =="likecomments")
          @include("user::Elements.comment_infor")
    @elseif ($typepage =="questions" || $typepage =="likequestions")
        @include("user::Elements.question_infor")
    @elseif  ( $typepage =="answears" || $typepage =="likeanswears")
        @include("user::Elements.answear_infor")
    @elseif  ( $typepage =="search" || $typepage =="search_stock")
        @include("common::Search.search_infor")
    @else
        @include("user::Elements.article_infor")
    @endif

@empty

    @if  ( $typepage =="search" || $typepage =="search_stock")
    <div style="margin:20px 0;text-align:center;background-color: white;"><p class="css-1yk0zej euu3pko2">Không tìm thấy nội dung</p></div>
    @else
    <div style="margin:20px 0;text-align:center;background-color: white;"><p class="css-1yk0zej euu3pko2">Chưa có gì ở đây cả</p></div>
    @endif
@endforelse
        
<div class="text-center">
  {{ $posts->links() }}
</div>  


   