<!doctype html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    @include("common::Elements.meta")
    @include("common::Elements.scripts")
    @yield('css')


</head>


<body>
@include("admin::Elements.header") 
    @yield('menu') 

    {{--@include("common::Elements.laravelLogin") --}}
    


    @yield('content')
    

    @yield('script')


  <script src="/js/common.js"></script>
  <script src="/js/admin.js"></script>

</body>
</html>