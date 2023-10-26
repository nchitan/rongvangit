<!doctype html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    @include("common::Elements.meta")
    @include("common::Elements.scripts")
    <link rel="stylesheet" href="{{ URL::asset('css/create.css') }}">
    <!-- md editor -->
    <link rel="stylesheet" href="/editor.md/css/style.css" />
    <link rel="stylesheet" href="/editor.md/css/editormd.css" />

    <!-- tagify -->
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

 

    <style type="text/css">
    .CodeMirror-scroll {
        /*background-color: rgb(245, 246, 246);*/
    }
    </style>
</head>
<body>


<div class="allWrapper">    



  


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
  


    @yield('content') 


        @yield('script')
       



   </div>



    <!-- tagifi -->
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
    <script type="text/javascript">
    var input = document.querySelector('input[name=tags3]'),
        tagify = new Tagify(input, {whitelist:[],maxTags: 5,delimiters : ",",pattern: /^.{0,100}$/}),
        controller; // for aborting the call

    // listen to any keystrokes which modify tagify's input
    tagify.on('input', onInput)

    function onInput( e ){
      var value = e.detail.value
      tagify.whitelist = null // reset the whitelist

      // https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
      controller && controller.abort()
      controller = new AbortController()

      // show loading animation and hide the suggestions dropdown
      tagify.loading(true).dropdown.hide()


    $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url:'/getTagsSuggest',
        dataType: 'json',
        data: {'tag': value},
    }).done(function (result, textStatus, jqXHR) {
        var suggesetWordList = [];
        var suggestWord = result['suggestWord'];

        
        $.each(suggestWord,function (index, val) {
            suggesetWordList.push(val['tag_name']);
        });
          tagify.whitelist = suggesetWordList // update whitelist Array in-place
          tagify.loading(false).dropdown.show(value) // render the suggestions dropdown
        //getSuggest(suggesetWordList);

    }).fail(function (data, textStatus, xhr) {
        console.log(data.status);
    });

    }

    </script>

    <!-- editor.md -->
    <script src="/editor.md/js/jquery.min.js"></script>
    <script src="/editor.md/editormd.js"></script>
    <script src="/js/common.js"></script>
        <script src="/js/create.js"></script>
    <script type="text/javascript">
        var testEditor;

        $(function() {
            // testEditor = editormd("test-editormd", {
            //     width   : "90%",
            //     height  : 640,
            //     syncScrolling : "single",
            //     path    : "../lib/"
            // });
            
            
            // or
            testEditor = editormd({
                id      : "test-editormd",
                width   : "100vw",
                height  : '85vh',
                path    : "/editor.md/lib/"
            });
            
        });
    </script>


</body>



</html>
