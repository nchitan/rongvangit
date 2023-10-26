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
<div class="allWrapper">
<div class="p-tagShow">
	<div class="p-tagShow_container px-2 px-1@s pt-4 pt-1@s">
	<div class="p-tagShow_start">
	<div id="TagInfo-react-component-71d9f7a2-96f2-4440-bab2-efa53a2bc241">
		<div class="css-3kggic">
			<h1 class="css-1yjvs5a"><span class="css-ik5ql">
				<span class="css-vozs05"><img onerror="this.src = '/images/utils/noimage.png';"  src="<?php echo $tags->tag_img ?>" alt="<?php echo $tags->tag_name ?>" class="css-r91awh">
				</span>
			</span>


			<span class="css-j6hlwq"><?php echo $tags->tag_name ?></span>
			</h1>

		<div class="css-1kouxxg"><div class="css-1cmf7z7"><div class="css-i1gocq"><span class="css-la3nd4">@if($tag_postcount ) {{ $tag_postcount[0]->count_post }} @else {{ 0 }} @endif</span><span class="css-lk7pct">Bài viết</span></div></div><div class="css-11ze7cv"><div class="css-pu36gg"><span class="css-la3nd4">@if($tag_follower ) {{ $tag_follower[0]-> count_user}} @else {{ 0 }} @endif</span><span class="css-lk7pct">Follower</span></div></div></div>
	<div class="css-8atqhb">
		<div class="css-1fcd6q4 e1p3oil80">
			@auth
			 	@if ($checkFollowTag)
                    <button class="css-hn90qn" data-tagid="{{ $tags->id }}"><span>Đang theo dõi</span></button>
                @else
                    <button class="css-hvs9iy" data-tagid="{{ $tags->id }}"><span>Theo dõi Tag</span></button>
                @endif
            @endauth

            @guest
            <button class="css-hvs9iy authbtn"><span>Theo dõi Tag</span></button>
            @endguest

		</div>
	</div>
</div></div>
	      
	</div>

		<div class="p-tagShow_main">
			<!-- <div class="p-tagShow_mainTop">
				<div id="TagAbout-react-component-1dd4c0f0-5ebd-4642-af90-e922fb6b54b2"><div class="tsa-Content"><div class="tsa-Content_heading"><span class="fa fa-fw fa-book"></span>About</div><div class="tsa-Content_section p-tagShow_MdContent p-tagShow_MdContent-open"><div class="tsa-MdContent"><p>PythonはGuido van Rossumが設計した動的型付け言語です。Pythonは多くのデベロッパーによってライブラリの開発が行われており、Webページから科学研究まで幅広く利用されています。</p>

				<ul>
				<li>公式サイト: <a href="https://www.python.jp/">Top - python.jp</a>
				</li>
				<li>公式リファレンス: <a href="https://docs.python.org/ja/3/">3.7.4 Documentation</a>
				</li>
				<li>Wikipedia: <a href="https://ja.wikipedia.org/wiki/Python">Python - Wikipedia</a>
				</li>
				</ul>
				</div></div></div></div>
			</div> -->

			<div class="p-tagShow_mainMiddle">
				<div id="TagTrendArticleList-react-component-62b4bbad-fc26-4fc9-afcd-58cb1d7504b2">
					<div class="css-172osot e1mdkbz70">

						<div class="css-faujvq e1mdkbz71"><i class="fa fa-line-chart" style="color:#55c500;margin-right:8px"></i><div class="css-1hmizb3 e1mdkbz72">Trend</div><div class="css-17hxefl e1mdkbz73">Được Like nhiều nhất tuần qua</div>
						</div>
						 @foreach ($post_trends as $post) 
				         @include("user::Elements.article_infor") 
				         @endforeach 
					</div>
				</div>	
			</div>

			<div class="p-tagShow_mainBottom">
				<div id="TagNewestItemList-react-component-838a38a6-292a-4f01-99ed-9d6226af6e48">
					
					<div class="css-dt1zvi">
						<div class="css-1hw5c43"><div class="css-ygmo9w"><i class="fa fa-fw fa-list" style="color:#55c500;margin-right:8px"></i><div>Mới nhất</div></div>
                        <div class="css-178yklu">
                            <div class="css-2imjyh e1v0a77u0">
                                <a class="css-ls5mct" title="posts">Bài viết</a>
                                <a class="css-17f4hjb" title="questions">Câu hỏi</a>
                            </div>
                        </div>
                    </div>

						<div class="tagpostquest">

						@include("common::Tag.tagshow") 
						

					</div>
				</div>
				
			</div>

		</div>

		</div>

		<div class="p-tagShow_end mt-3">
			<div class="css-8fwe4o">
                {{--@include("common::Elements.tagRanking")--}}
                 {{-- @include("common::Elements.organizationRanking") --}}
                

                 @include("common::Elements.userRanking")
			</div>
		</div>	


	</div>
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
 	

    var postData = {
                        'tag_name':$(".css-j6hlwq").html(),
                        'typepage':$(".css-ls5mct")[0].title
                    }
  $.ajax({
   url:window.location.href+"/pagination?page="+page,
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