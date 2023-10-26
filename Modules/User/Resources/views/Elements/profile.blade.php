<div class="css-1iymp9t">
    <div class="css-1cw2pgk">
        <div class="css-zivsmz"></div>
        <div class="css-3rwjcu">
            <img loading="lazy" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo '/storage/'.$user['profile_photo_path'];?>" class="css-u6wu90">

       


            @if($user['fullname'])
                <div class="css-fa2xvq">{{$user['fullname']}}</div>
            @endif    
            <div class="css-eak5mp"><?php echo '@'.$user['name']; ?></div>

            <div class="css-nqy5i5">
                @if($user->github)
                <a href="{{ $user->github }}" target="_blank" rel="noopener" class="css-u4wt3t"><span class="fa fa-github css-ry3l85"></span></a>
                @endif

         <!--        <a href="https://twitter.com/BrneUna" target="_blank" rel="noopener" class="css-u4wt3t"><span class="fa fa-twitter css-sr4s2q"></span></a> -->
                @if($user->facebook)
                <a href="{{ $user->facebook }}" target="_blank" rel="noopener" class="css-u4wt3t"><span class="fa fa-facebook-square css-1yzymgn" ></span></a>
                 @endif

                @if($user->zalo)
                <a href="{{ $user->zalo }}" target="_blank" rel="noopener" class="css-u4wt3t"><img src="images/utils/zalo.svg" style="width:18px; height: 18px; transform: translateY(1px);" ></span></a>
                 @endif
                @if($user->youtube)
                <a href="{{ $user->youtube }}" target="_blank" rel="noopener" class="css-u4wt3t"><span style="font-size:20px" class="fa-brands fa-youtube"></span></a>
                 @endif



              <!--   <a href="https://www.linkedin.com/in/tet-su-690a89232" target="_blank" rel="noopener" class="css-u4wt3t"><span class="fa fa-linkedin-square css-1mio6od"></span></a> -->
          <!--       <a href="/kiyoshi/feed" target="_blank" rel="noopener" class="css-u4wt3t"><span class="fa fa-rss css-32n5yd"></span></a> -->
            </div>
        </div>
        
        <div class="css-xt7d7z">
            <div class="css-17rni8d">
                @include("common::Elements.contribution")
            </div>
            <div class="css-86h3r5">
                <a href="/<?php echo $user['name']; ?>" class="css-1it6av2">{{ $user_infor->post_count }}<br>Bài viết</a>
                <a href="/<?php echo $user['name']; ?>/following" class="css-1it6av2">{{ $user_infor->folowing_count }}<br>Đang theo dõi</a>
                <a href="/<?php echo $user['name']; ?>/followers" class="css-1it6av2">{{ $user_infor->folower_count_count }}<br>Người theo dõi</a>
                
            </div>
        </div>

        @if($user->about)
            <div class="css-4znuir">{{ $user->about }}</div>
            @endif
        @if (  Auth::user() && $user['name'] == Auth::user()->name)
        <a href="/user/profile" class="css-xweau3 eg0gnpx0">Cài đặt</a>
        @else



            @auth
                @if ($checkFollow)
                    <button class="css-follow css-1pacd3k" data-at="<?php echo $user['id']?>"><span>Đang theo dõi</span></button>
                @else
                    <button class="css-follow css-10keyvc" data-at="<?php echo $user['id']?>"><span>Theo dõi</span></button>
                @endif
            @endauth

            @guest
            <button class="css-follow css-10keyvc authbtn"><span>Theo dõi</span></button>
            @endguest
        @endif 

        <div class="css-178yklu">
            @if($user->website)
            <div class="css-fv3lde">
                <div class="css-c8d3rd"><span class="fa fa-globe css-44iyq9"></span></div>
                <a href="{{ $user->website }}" target="_blank" rel="noopener noreferrer nofollow" class="css-hm64qx">{{ $user->website }}</a>
            </div>
            @endif

            @if($user->adress)
            <div class="css-fv3lde"><div class="css-c8d3rd"><span class="fa fa-map-marker css-44iyq9"></span></div><p class="css-hm64qx">{{ $user->adress }}</p>
            </div>
            @endif

            @if($user->university)
            <div class="css-fv3lde"><div class="css-c8d3rd"><span class="fa fa-building css-44iyq9"></span></div><p class="css-hm64qx">{{ $user->university }}</p>
            </div>
            @endif
        </div>



        <!-- <div class="css-178yklu"><div class="css-fv3lde"><div class="css-c8d3rd"><span class="fa fa-globe css-44iyq9"></span></div><a href="https://www.youtube.com/channel/UCmMFmjhf1BXB1tlLcbkVRrg" target="_blank" rel="noopener noreferrer nofollow" class="css-hm64qx">https://www.youtube.com/channel/UCmMFmjhf1BXB1tlLcbkVRrg</a></div></div> -->

        




    </div>
</div>