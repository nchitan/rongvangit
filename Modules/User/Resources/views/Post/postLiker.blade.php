@extends('common::layouts.master')
@section('css')

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

<div id="main">
    <div class="container itemsLikers mt-4">
        <div class="row">
            <div style="padding-top:10px">
            <ol class="breadcrumb"><li><a href="/{{ $user }}/posts/{{ $post ->item }}">{{ $post ->title }}</a></li><li class="active">/ Likers</li></ol>
        </div>

        <ul class="GridList">
            @forelse ($likers as $liker)
            <li class="media GridList__user">
                <a href="/<?php echo $liker->name; ?>"><img class="media__image userthumb userthumb--l" src="<?php echo '/storage/'.$liker->profile_photo_path ; ?>" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" width="24" height="24" loading="lazy">
                </a>
                <div class="media__body"><h4 class="UserInfo__name"><a href="/<?php echo $liker->name ?>"><?php if($liker->fullname) { echo($liker->fullname); } else { echo ($liker->name);} ?></a></h4>

         <!--        <div id="UserFollowButton-react-component-f1681773-dfdf-41fc-9cca-b9aedfc18b4c"><span class="userFollowButton"><button class="btn btn-default btn-block userFollowButton_inner btn-xs"><i class="i fa fa-user-plus"></i>フォロー</button></span></div> -->

                            <div class="css-135kj0i euu3pko10">
                                @auth
                                    <?php 
                                    $login_user = Auth::user();
                                    if($login_user->id == $liker->id){
                                        $checkFollow_temp='same';

                                    }elseif($login_user->isFollowing($liker->id)) {
                                        $checkFollow_temp="true";
                                    }else{
                                        $checkFollow_temp="false";
                                    }
                                

                                    ?>
                                    @if ($checkFollow_temp == "true")
                                        <button class="css-follow css-1pacd3k" style="width: 60%!important" data-at="{{ $liker->id }}"><span><i class="i fa fa-user-plus"></i>Following</span></button>
                                    @elseif ($checkFollow_temp == "same")
                                        <p></p>
                                    @else
                                        <button class="css-follow css-10keyvc" style="width: 60%!important" data-at="{{ $liker->id }}"><span><i class="i fa fa-user-plus"></i>Follow</span></button>
                                    @endif
                                @endauth

                                @guest
                                <button class="css-follow css-10keyvc authbtn" style="width: 60%!important"><span>Follow</span></button>
                                @endguest
                            </div>


                      
                </div>
            </li>
            @empty

            @endforelse


        </ul>  

        <div class="text-center">
          {{ $likers->links() }}
        </div>  



        </div>
    </div>
</div>

@endsection

@section('script')
<script src="/js/show.js"></script>
<script src="/js/userpage.js"></script>
<!-- <script src="/assets/highlight/highlight.min.js"></script> -->
<script src="/assets/marked/marked.js"></script>
<script src="/js/editor.js"></script>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>

@endsection