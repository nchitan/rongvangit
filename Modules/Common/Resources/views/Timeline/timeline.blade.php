@extends('common::layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/mypage.css') }}">
@endsection
@section('menu')
  <div class="st-NewHeader_mainNavigation">
    <div class="st-NewHeader_navigationTabContainer">
      <!-- <a class="st-NewHeader_mainNavigationItem" href="/">ホーム</a> -->
      @auth
      <a class="st-NewHeader_mainNavigationItem is-active" href="/timeline">Trang chủ</a>
      @endauth
      <a class="st-NewHeader_mainNavigationItem" href="/post">Bài viết</a>
      <a class="st-NewHeader_mainNavigationItem" href="/question">Câu hỏi</a>
      <!-- <a class="st-NewHeader_mainNavigationItem" href="/group">Nhóm</a> -->
      <!-- <a class="st-NewHeader_mainNavigationItem" href="/official-events">Sự kiện</a> -->
      <a class="st-NewHeader_mainNavigationItem" href="/about" target="_blank">About RongvangIT<span class="fa fa-fw fa-window-restore st-NewHeader_mainNavigationBlankIcon"></span></a>
    </div>
  </div>

<div class="st-NewHeader_subNavigation"><div class="st-NewHeader_subNavigationTabContainer">

<!-- http://localhost:8000/kiyoshi -->

<a class="st-NewHeader_subNavigationItem is-active" href="/timeline">Timeline</a>
<a class="st-NewHeader_subNavigationItem" href="/timeline/tag">Tag đang theo dõi</a>
<a class="st-NewHeader_subNavigationItem" href="/timeline/user">User đang theo dõi</a>
<!-- <a class="st-NewHeader_subNavigationItem" href="/timeline/group">Nhóm đang theo dõi</a> -->

</div></div>
@endsection

@section('content')

<?php 

?>

<div id="TimelinePage">
	<div class="css-1nwi02o">
		<!-- navi bar -->
		@include("common::Elements.nav")
		<!-- navi bar end -->

		<div class="css-13bbk6m">
			<main role="main" class="css-1v96c6s">
				<div class="css-13qqtfl">
				</div>
        <section> 
            <div class="css-1p44k52">
              <div class="css-1p44k52">
                              <div class="css-2imjyh e1v0a77u0">
                                  <a class="css-ls5mct" title="posts">Bài viết</a>
                                  <a class="css-17f4hjb" title="questions">Câu hỏi</a>
                              </div>
                              <div class="tagpostquest">
                                @if(count($posts) > 0)
                                  @include("common::Elements.pagination")
                                @else
                                    <div style="margin:20px 0;text-align:center;background-color: white;"><p class="css-1yk0zej euu3pko2">Hãy theo dõi tag hoặc user và nhận các bài viết bạn quan tâm!</p></div>
                                @endif
                              </div>
            </div>
        </section>  				
			</main>
		</div>
		<!-- adv bar -->
		@include("common::Elements.adv")
		<!-- adv bar end -->
	</div>
</div>
@endsection

@section('script')
<script src="/js/home.js"></script>

<script>


$(document).ready(function(){

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);

 });

 function fetch_data(page)
 {  
  // console.log($(this)[0].title)
  console.log(page)

    var postData = {
                        'tag_name':$(".css-j6hlwq").html(),
                        'typepage':$(".css-ls5mct")[0].title,
                    }
  $.ajax({
   url:window.location.href+"/pagination?page="+page,
   data: postData,
   success:function(data)
   {
    // console.log(data)
    $('.tagpostquest').html(data);
   }
  });
 }
 
});
</script>
@endsection