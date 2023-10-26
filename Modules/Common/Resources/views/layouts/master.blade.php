<!doctype html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    @include("common::Elements.ga")
    @include("common::Elements.meta")
    @include("common::Elements.scripts")
    @yield('css')


</head>

    @auth


        <!-- // add this dropdown // -->
<!--         <li class="dropdown">
            <a class="dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="glyphicon glyphicon-user"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">

                <li class="dropdown-header">No notifications</li>
            </ul>
        </li> -->
    @endauth
<body>
@include("common::Elements.header") 
    @yield('menu') 

    {{--@include("common::Elements.laravelLogin") --}}
    


    @yield('content')
    

    @yield('script')


@include("common::Elements.footer") 
  <script src="/js/common.js"></script>


    @include("common::Elements.loginModal")

</body>
</html>
