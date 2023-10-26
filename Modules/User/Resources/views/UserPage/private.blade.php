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
        
        <!-- Right -->
        <div class="css-1jvw5ih epi3w5e0">
            <!-- up -->
            <div class="css-19fauo6">
                <div class="css-1xcoxw euu3pko0">
                    <div class="css-176mg26 euu3pko1"><div class="css-1ty4ybw e1kjopm70"></div><div>Bài viết riêng tư</div></div>
                    <ul class="css-178yklu euu3pko3">    
                        @forelse ($posts as $post)
                                <?php $created_at = date( "Y-m-d", strtotime( $post->created_at ) );?>
                                <div class="css-0 e1gzbnx91">
                                    <div class="css-1ufzjqr e1gzbnx92">
                                        <div class="css-1tn172s e1gzbnx93"><span class="fa fa-tags mr-1of2" style="font-size:13px;color:#999999;margin-right:6px"></span>

                <?php 

                $tags = explode(",", $post->tags);
                foreach ( $tags as $tag ) {
                    echo  '<a href="/tags/'.mb_strtolower($tag).'" class="css-1sigjo2">'. $tag.'</a>';
                }
                ?>


                                        </div>

                                        <div class="css-2imjyh e1gzbnx95">
                                            <a href="/<?php echo $post->username; ?>/posts/<?php echo $post->item?>" class="css-gofxc6"><?php echo $post->title?></a>
                                        </div>

                                        



                                        <div style="display:flex"><div class="css-bgzfx e1gzbnx97"></div><div class="css-1jp3b9m e1gzbnx98">{{ $created_at }}</div>
                                    </div>
                                    <hr>
                                   </div>
                                    

           

                                </div>



                        @empty
                            <div style="margin:20px 0;text-align:center"><p class="css-1yk0zej euu3pko2">Chưa có gì ở đây cả</p></div>
                        @endforelse
                    </ul>
                        <div class="text-center">
                            {{ $posts->links() }}
                     </div>  
                    
                </div>
            </div>
        </div>

    </div>
</div>



@endsection
@section('script')
<script src="/js/userpage.js"></script>
@endsection