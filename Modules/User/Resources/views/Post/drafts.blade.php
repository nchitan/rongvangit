@extends('common::layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/show.css') }}">
<link rel="stylesheet" href="{{ URL::asset('editor.md/css/editormd.css') }}">
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



<?php 
$post =$posts[0];
?>

			<div class="css-us8c0w e75jnbd0">
				
				<div class="css-yxsgo e1bm7wcb0"><div class="css-105vpjc"><div class="css-1ocoo6t"><div>Danh sách bản nháp</div>
<!-- 				<div class="css-1x837tl"><span class="fa fa-filter"></span><div class="css-1mrbpnl"><div class="css-1jvksq7"><div class="css-1vwahw7"><span class="fa fa-check-square" style="color: rgb(64, 151, 219);"></span><div>Bài viết</div></div></div><div class="css-1jvksq7"><div class="css-1vwahw7"><span class="fa fa-check-square" style="color: rgb(64, 151, 219);"></span><div>Q&amp;A</div></div></div><div class="css-1jvksq7"><div class="css-1vwahw7"><span class="fa fa-check-square" style="color: rgb(64, 151, 219);"></span><div>Trao đổi ý kiến</div></div></div><div class="css-1jvksq7"><div class="css-1vwahw7"><span class="fa fa-square" style="color: rgb(223, 224, 224);"></span><div>Bài chưa xuất bản</div></div></div></div>
		</div> -->
</div><ul>
	@if (($post))

	@include("user::UserPage.pagination")
	@else
	

	<div class="css-yirin4">Chưa có bản nháp</div>
	@endif	

</ul></div>
</div>

				<!-- Load toan bo noi dung -->
			
				@include("user::Elements.draft_content")
	



			
		</div>



@endsection
@section('script')
<script src="/js/show.js"></script>
@endsection