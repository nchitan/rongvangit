<?php 
if (!isset($typepage)) {
    $typepage =''; 
}
?>

@foreach ($posts as $post)
    @if ($typepage =="questions")
        @include("user::Elements.question_infor")
    @else
        @include("user::Elements.article_infor") 
    @endif
@endforeach
    

{{ $posts->links() }}