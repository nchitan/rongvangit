@extends('admin::layouts.master')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/show.css') }}">


@section('content')


<div id="UserMainPage">
    <div class="css-1dkykzw">
        <!-- Left -->
        <div class="css-1j4z0qo e1h7t2ir0">
            <!-- profile -->
            
            <!-- following tag -->

         
            <div class="css-1iymp9t"></div>
        </div>
        
        <!-- Right -->
        <div class="css-1jvw5ih epi3w5e0">
            <!-- up -->
            <div class="css-19fauo6">
                <div class="css-1xcoxw euu3pko0">
                    <div class="css-176mg26 euu3pko1"><div class="css-1ty4ybw e1kjopm70"></div><div>Danh sách Bài viết</div></div>

 <div class="css-1t6umzq">

        
        <div class="css-">
            @foreach ($posts as $serie)

            <div class="css-1w5fqid">
                <a href="/{{ $serie->username }}/posts/{{ $serie->item }}" class="css-1okdvfi">{{ $serie->title }}</a>

            </div>
            <?php
            $created = date( "Y-m-d", strtotime( $serie->created_at ) );
            
            echo '<div><p class="css-1ay9vb9">Đăng ngày: <time datetime="'.$created.'">'.$created.'</time></p></div>';
            ?>
        
            <button style="float:right;transform: translateY(-120%);" class="css-post activatepost" data-at="{{ $serie->id }}"><span>Activate</span></button>
            <p class="css-1r0y2zt" style="padding-left: 10px!important"></p>
            @endforeach

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
@endsection