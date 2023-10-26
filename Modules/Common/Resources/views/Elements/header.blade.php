
<div id="NewGlobalHeader-react-component-1346444e-25ce-4103-9682-f71e88eff734">
  
  <div class="st-NewHeader">
    <div class="st-NewHeader_container">
      <div class="st-NewHeader_start">
        <a href="/" class="st-NewHeader_logo">
<img src="{{URL::asset('/images/rongvangitvn.png')}}" alt="profile Pic"  width="400" style="transform: translateY(-3px)">
        </a> 
      </div>
      <div class="st-NewHeader_end">
        <div class="st-NewHeader_end">
            <form class="st-NewHeader_search" action="/search" method="get">
              <span class="fa fa-fw fa-search st-NewHeader_searchIcon"></span>
              <input type="search" class="st-NewHeader_searchInput" autocomplete="off" placeholder="Tìm kiếm trên RồngVàngIT" value="" name="q" required="">
            </form>

            <form class="st-NewHeader_searchModal" action="/search" method="get"><input type="text" class="st-NewHeader_searchModalInput" autocomplete="off" placeholder="Tìm kiếm trên RồngVàngIT" value="" name="q" required="">
            </form>

            @auth

            <div class="st-NewHeader_searchButton"><span class="fa fa-fw fa-search"></span></div>

            <div class="st-NewHeader_buttonWrapper">
              <div class="st-NewHeader_notifications" tabindex="0">
                <span class="fa fa-bell fa-fw"></span>

                
                <span class="st-NewHeader_notificationsCount" style="display: none;"></span>
              </div>



            </div>

<!-- <div class="st-NewHeader_notiIframe">
        <li class="dropdown">
            <a class="dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="glyphicon glyphicon-user"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">

                <li class="dropdown-header">No notifications</li>
            </ul>
        </li>

</div>   -->


<div class="st-NewHeader_notiIframe" id="notifications">
    <div class="st-NewHeader_notiHeader"><div><span class="fa fa-bell fa-fw" aria-hidden="true"></span>Thông báo</div></div>
          
    <ul aria-labelledby="css-tgtzqc" id="notificationsMenu">
        <li class="">Bạn chưa có thông </li>
    </ul>
     
</div>



            <div class="st-NewHeader_buttonWrapper">
              <div class="st-NewHeader_loginUser button-88" tabindex="0"><img loading="lazy" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo '/storage/'. Auth::user()->profile_photo_path;?>" alt="{{ Auth::user()->name }}" alt="{{ Auth::user()->name }}">
              </div>
              <div class="st-NewHeader_dropdown">
                <a href="/<?php echo Auth::user()->name?>" class="st-NewHeader_dropdownItem">Trang cá nhân</a>
                <a href="/stock" class="st-NewHeader_dropdownItem">Kho lưu trữ</a>


                <!-- <a href="/badges" class="st-NewHeader_dropdownItem">Huy hiệu</a> -->

                <div class="st-NewHeader_dropdownDivider"></div>

                <a href="/drafts/post" class="st-NewHeader_dropdownItem">Tạo bài viết mới</a>
                <a href="/drafts/question" class="st-NewHeader_dropdownItem">Tạo câu hỏi mới</a>
                <a href="/drafts" class="st-NewHeader_dropdownItem">Bản nháp</a>
                <a href="/<?php echo Auth::user()->name; ?>/private" class="st-NewHeader_dropdownItem">Bài viết riêng tư</a>

<!--                 <a href="/anlan/private" class="st-NewHeader_dropdownItem">Chia sẻ cá nhân</a>
                <a href="/patches" class="st-NewHeader_dropdownItem">Yêu cầu sửa bài</a> -->

                <hr class="st-NewHeader_dropdownDivider">

                <a href="/user/profile" class="st-NewHeader_dropdownItem">Cài đặt tài khoản</a>
                <hr class="st-NewHeader_dropdownDivider">
                <a href="/logout" class="st-NewHeader_dropdownItem">Log out</a>
              </div>
            </div>

              <div class="st-NewHeader_buttonWrapper ml-1">
                <div class="st-NewHeader_postButton" tabindex="0">Tạo mới<!-- <span class="fa fa-fw fa-pencil-square-o mr-1of2"></span> -->
                </div>
                <div class="st-NewHeader_dropdown">
                  <a href="/drafts/post" class="st-NewHeader_dropdownItem">Bài viết mới</a>
                  <a href="/drafts/question" class="st-NewHeader_dropdownItem">Câu hỏi mới</a>
               </div>
             </div>
             @endauth

             @guest

            <div class="st-NewHeader_searchButton st-NewHeader_searchButton_notLoginOrBeta"><span class="fa fa-fw fa-search"></span></div>

            <a class="st-NewHeader_loginLink" href="/login" rel="nofollow">Login</a><a class="st-NewHeader_signupButton" href="/register" rel="nofollow">Sign up</a>

             @endguest

        </div>
        </div>
        
      

      <div class="st-NewHeader_overlay"></div>
     </div> 
    </div></div>
