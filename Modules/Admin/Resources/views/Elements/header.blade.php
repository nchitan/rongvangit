
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
              <div class="st-NewHeader_loginUser button-88" tabindex="0"><img loading="lazy" src="https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1">
              </div>
              <div class="st-NewHeader_dropdown">
               
                
                <a href="/admin/index" class="st-NewHeader_dropdownItem">Dashboard</a>
                <hr class="st-NewHeader_dropdownDivider">
                <a href="/admin/user" class="st-NewHeader_dropdownItem">Danh sách user</a>
                <a href="/admin/userReport" class="st-NewHeader_dropdownItem">Danh sách user bị report</a>
                <a href="/admin/userBanList" class="st-NewHeader_dropdownItem">Danh sách user bị ban</a>
                <hr class="st-NewHeader_dropdownDivider">
                <a href="/admin/item" class="st-NewHeader_dropdownItem">Danh sách post</a>
                <a href="/admin/itemReport" class="st-NewHeader_dropdownItem">Danh sách post bị report</a>


                <hr class="st-NewHeader_dropdownDivider">

                <a href="/admin/profile" class="st-NewHeader_dropdownItem">Cài đặt Admin</a>
                <hr class="st-NewHeader_dropdownDivider">
                <a href="/admin/logout" class="st-NewHeader_dropdownItem">Log out</a>
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
