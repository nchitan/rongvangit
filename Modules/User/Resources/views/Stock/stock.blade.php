@extends('common::layouts.master')
@section('css')
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
	<div id="StockItemsPage-react-component-397812d5-0a9d-4a94-bdc8-c2c69585b432">
		<div class="css-8kbjif">
			<div class="css-1wnfvou">
                <!-- quangcao -->
				<!-- <aside class="css-i3pbo"><div id="div-gpt-ad-1584618700918-0" class="ad-300x250" data-test-adunitpath="/383564218/rongvangit.com_loginuser_stock" elementtiming="gpt-div-gpt-ad-1584618700918-0" style=""><div id="google_ads_iframe_/383564218/rongvangit.com_loginuser_stock_2__container__" style="border: 0pt none; width: 300px; height: 0px;"></div></div>
                </aside> -->

				<nav aria-label="Thư mục">
					 

					<p class="css-1c9tso">Thư mục</p>
					<ul>


					@foreach ($categories as $user_category)
						@if (isset($user_category['sub_category_names']))
						<div class="css-dwc3sl"> 
							<li role="link" @if ($loop->first) class="css-19yotky" @else class="css-1s14ib9" @endif>
								<div class="css-5ch6y7">
									<span class="fa fa-folder-open"  style="color: orange;"></span><span class ="css-catname mainfolder" data-cateid= "{{$user_category['id']}}">{{$user_category['category_name']}}</span>
								</div><!-- <div class="css-114vmm9">2</div> -->
							</li>

							<?php
							$sub_category_names = explode(",",  $user_category['sub_category_names']  ); 
							

							foreach ($sub_category_names as $value){
    							$sub_category_name = explode(":", $value);
							?>

								<li role="link" class="css-1s14ib9">
									<div class="css-5ch6y7">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-folder" style="color: orange;"></span><span class="css-catname subfolder" data-cateid="{{ $user_category['id']}}:{{ $sub_category_name[1] }}">{{ $sub_category_name[0] }}</span>
									</div>
									<!-- <div class="css-114vmm9">0</div> -->
								</li>

							<?php } ?>

						</div>

						@else
						<div class="css-dwc3sl"> 
							<li role="link" @if ($loop->first) class="css-19yotky" @else class="css-1s14ib9" @endif>
								<div class="css-5ch6y7">
									<span class="fa fa-folder-open"  style="color: orange;"></span><span class ="css-catname mainfolder" data-cateid= "{{$user_category['id']}}">{{$user_category['category_name']}}</span>
								</div><!-- <div class="css-114vmm9">2</div> -->
							</li>
						</div>
						@endif
					@endforeach
					</ul>



<!-- 					<div class="css-1ynyhby">
						<button class="css-1twp4x">Xem thêm</button>
					</div> -->
				</nav>
				<hr class="css-1x9jzgl">
			</div>
			<div class="css-9raz0i">
				<main>
                    <section class="css-1gxc0n3">
                        <div class="css-6jh486">
                            <h2 class="css-1jolfkj">{{ $categories[0]['category_name']}}</h2>
                            <button aria-label="Đổi tên thư mục" class="fa fa-fw fa-pencil css-1v94q2e"></button>
                            <div class="st-Modal"><div class="st-Modal_backdrop"></div>
                                <div class="st-Modal_body css-142bw3q">
                                    <div class="css-1um06az">
                                        <div class="css-zmuu05">Đổi tên thư mục</div><span class="fa fa-times css-18fwhlf"></span>
                                    </div>
                                    <div class="css-19midj6"><label class="css-2p3y51 e1ohnlou0">Tên thư mục</label>
                                        <input class="css-1w9bxsk e172lo9w0" maxlength="256" placeholder="Nhập tên thư mục mới" value=""><div class="css-1rvqore"><button class="css-x8unf2 e1rb7ucl0" font-size="14">Hủy</button><button class="css-byfy9z e1rb7ucl0" font-size="14">Lưu</button></div>
                                    </div>
                                </div>
                            </div>
                            <button aria-label="Xóa thư mục" data-type='category' data-itemId= "" data-atId="{{ Auth::id() }}" class="fa fa-fw fa-trash css-1v94q2e"></button>
                        </div>
                        <div class="css-xao0zu">Tìm kiếm trong thư mục [ {{ $categories[0]['category_name']}} ]</div><input placeholder="Nhập từ khoá" class="css-bgcf0x e172lo9w0" value="">
                    </section>

					<section class="css-172osot">

						@include("user::UserPage.pagination")



					</section>


				</main>
				
			</div>
			
		</div>
		
	</div>
	

</div>


@endsection
@section('script')
<script src="/js/userpage.js"></script>
@endsection