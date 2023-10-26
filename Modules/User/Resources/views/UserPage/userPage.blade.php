@extends('common::layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/mypage.css') }}">
<style type="text/css">
#UserMainPage{
    background-color: #F0F2F5;
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

<?php 

// foreach($post_ratings as $x => $x_value) {
//   echo "Key=" . $x . ", Value=" . $x_value;
//   echo "<br>";
// }

?>



<div id="UserMainPage">
    <div class="css-1dkykzw">
        <!-- Left -->
        <div class="css-1j4z0qo e1h7t2ir0">
            <!-- profile -->
            @include("user::Elements.profile")
            <!-- following tag -->

            @include("user::Elements.tagfollowing")
            <div class="css-1iymp9t"></div>
        </div>

        <div class="css-1jvw5ih epi3w5e0">
            <!-- up -->
            @include("user::Elements.thongke")

            <!-- mid -->
           




            <!-- down -->
            <div class="css-19fauo6">
                <div class="css-172osot">
                    <div class="css-1hw5c43">
                        <div class="css-9uhy8p">
                            <a  class="css-12j8vkg" title="articles">Articles</a>
                            <a class="css-g0sx2j" title="questions">Questions</a>
                            <a  class="css-g0sx2j" title="like">LIKE</a>
                        </div>
                        <div class="css-vzb2sn">
                            <a class="css-1f922ah" title="posts">Posts</a>
                            <a class="css-zlb6o7" title="comments" >Comments</a>
                            <!-- <a href="/<?php echo $user['name']; ?>/edit_requests" class="css-zlb6o7">Edit Request</a> -->

                        </div>
                    </div>
                        


                    <div>
                        <div class="css-1ebnygn">
                            @include("common::Elements.pagination")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="/js/userpage.js"></script>
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
                        'css-un':$('.css-eak5mp').html().replace('@', ''),
                        'css-tp':$(".css-1f922ah")[0].title,
                    }
  $.ajax({
   url: window.location.href+ "/pagination?page="+page,
   data: postData,
   success:function(data)
   {
  
    $('.css-1ebnygn').html(data);
   }
  });
 }
 
});
</script>
@endsection