@extends('common::layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/mypage.css') }}">
<style type="text/css">
body{
  background-color: white;
}
</style>
@endsection
@section('menu')
  <div class="st-NewHeader_mainNavigation">
    <div class="st-NewHeader_navigationTabContainer">
      <!-- <a class="st-NewHeader_mainNavigationItem" href="/">ホーム</a> -->
      @auth
      <a class="st-NewHeader_mainNavigationItem" href="/timeline">Trang chủ</a>
      @endauth
      <a class="st-NewHeader_mainNavigationItem" href="/post">Bài viết</a>
      <a class="st-NewHeader_mainNavigationItem" href="/question">Câu hỏi</a>
      <!-- <a class="st-NewHeader_mainNavigationItem" href="/group">Nhóm</a> -->
<!--       <a class="st-NewHeader_mainNavigationItem" href="/official-events">Sự kiện</a> -->
      <a class="st-NewHeader_mainNavigationItem" href="/about" target="_blank">About RongvangIT<span class="fa fa-fw fa-window-restore st-NewHeader_mainNavigationBlankIcon"></span></a>
    </div>
  </div>
@endsection
@section('content')



<div class="css-19fauo6">
  <div class="searchResultContainer">
    <div class="searchResultContainer_main">
      <form class="searchResultContainer_form s-mgb-2em" action="/search" accept-charset="UTF-8" method="get"><input type="hidden" name="sort" id="sort"><div class="searchResultContainer_textFieldContainer"><input type="text" name="q" id="q" value="{{ $keyword }}" class="form-control"></div><button type="submit" class="searchResultContainer_searchButton">Search<span class="fa fa-fw fa-search searchResultContainer_searchButtonIcon"></span></button></form>

  <div class="tagpostquest">
  @include("common::Elements.pagination")
</div>

    
    </div>  

    <div class="searchResultContainer_sub">
      @include("common::Elements.adv")
      <div class="searchResultContainer_ads"></div>
      

    </div>
    


  </div>

</div>
@endsection

@section('script')
<script>

$(document).ready(function(){

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
 });

 function fetch_data(page)
 {  

    var postData = {
                        'q':$(".form-control").val(),
                        'page':page,
                    }
  $.ajax({
   url: window.location.href+ "/pagination?page="+page,
   data: postData,
   success:function(data)
   {
  
    $('.tagpostquest').html(data);
   }
  });
 }
 
});
</script>

@endsection