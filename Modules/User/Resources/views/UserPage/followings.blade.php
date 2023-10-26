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
                    <div class="css-176mg26 euu3pko1"><div class="css-1ty4ybw e1kjopm70"></div><div>Đang theo dõi</div></div>
                    <div class="css-178yklu euu3pko3">
                        @foreach ($followers as $follower)
                        <li class="css-1gqtz85 euu3pko4">
                            <a href="/<?php echo $follower->name ?>">
                                <img loading="lazy" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo  $follower->profile_photo_path ?>" class="css-10b4kh3">
                            </a>
                            <div class="css-124d71f euu3pko5">
                                <a href="/<?php echo $follower->name ?>" class="css-gt06v3 euu3pko6">
                                    <div class="css-178yh29 euu3pko7"><?php if($follower->fullname) { echo($follower->fullname); } else { echo ($follower->name);} ?></div>
                                    <div class="css-jztj9t euu3pko8">@<?php echo $follower->name ?></div>
                                </a>
                                @if ($follower->about)
                                <p class="css-kpafit euu3pko9">{{ $follower->about }}
                                </p>
                                @endif
                            </div>
                            <div class="css-135kj0i euu3pko10">
                                @auth
                                    <?php 
                                    $login_user = Auth::user();
                                    if($login_user->id == $follower->id){
                                        $checkFollow_temp='same';

                                    }elseif($login_user->isFollowing($follower->id)) {
                                        $checkFollow_temp="true";
                                    }else{
                                        $checkFollow_temp="false";
                                    }
                                

                                    ?>
                                    @if ($checkFollow_temp == "true")
                                        <button class="css-follow css-1pacd3k" data-at="{{ $follower->id }}"><span>Đang theo dõi</span></button>
                                    @elseif ($checkFollow_temp == "same")
                                        <p></p>
                                    @else
                                        <button class="css-follow css-10keyvc" data-at="{{ $follower->id }}"><span>Theo dõi</span></button>
                                    @endif
                                @endauth

                                @guest
                                <button class="css-follow css-10keyvc authbtn"><span>Theo dõi</span></button>
                                @endguest
                            </div>
                        </li>
                        @endforeach
                    </div>
                    {{ $followers->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')
<script src="/js/userpage.js"></script>
@endsection