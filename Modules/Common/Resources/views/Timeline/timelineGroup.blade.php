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

<a class="st-NewHeader_subNavigationItem" href="/timeline">Timeline</a>
<a class="st-NewHeader_subNavigationItem" href="/timeline/tag">Tag đang theo dõi</a>
<a class="st-NewHeader_subNavigationItem" href="/timeline/user">User đang theo dõi</a>
<!-- <a class="st-NewHeader_subNavigationItem is-active" href="/timeline/group">Nhóm đang theo dõi</a> -->

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
                          @include("common::Elements.pagination")
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