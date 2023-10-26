@extends('common::layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/show.css') }}">
<link rel="stylesheet" href="{{ URL::asset('editor.md/css/editormd.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/assets/highlight/a11y-dark.min.css') }}">

<style type="text/css">
.container {
    /* text-align: center; */
    border-radius: 2em;
}

.cancelbtn {
    background-color: #ccc;
    color: black;

}

.deletebtn {
    background-color: #f44336;
}

.cancelbtn, .deletebtn {
    /* float: left; */
    /* width: 50%; */
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    /* width: 100%; */
    opacity: 0.9;
}
</style>
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

<?php

// var_dump($checkStock);
// if($key  == NULL){
// print_r("notnull");
// }

//print_r($categories[2]['category_name']);

// print_r(date('y'));
// print_r(date('m'));
// print_r(date('d'));
// print_r(date('h'));
// print_r(date('m'));
// print_r(date('s'));
// $time = array($user_id ,date('y'),date('m'),date('d'),date('h'),date('m'),date('s'));
// $k= $s +$time;


// $hashtext = '';
// foreach($time as $t){
//     $hashtext.=chr(intval($t)+65);
// }

// // var_dump($time );
// // print_r(inteval(chr(date('y')++65)));
// // $letter = chr(0+65);

// // print_r(intval(date('y') ));
// //print_r($hashtext)
// var_dump($k);

// $str =$user_id.date('y').date('m').date('d').date('h').date('m').date('s');
// $text =  str_split(strval($str ));


// $hashtext = '';
// foreach ($text as $key => $value){
//     if($key%2 == 0){
//         $hashtext.=chr(intval($value)+97);
//     }else{
//         $hashtext.=$value;
//     }
// }

// print_r($like_id);
// var_dump($commentLikes);
// var_dump($comments);

// print_r($commentLikes[0]['item']);


// print_r($comments[0]['item']);



?>


<?php



// if(isset($like_id_infor)){
//     $like_id = $like_id_infor[0];
//     $like_status = $like_id_infor[1];
// }



?>


<div class="p-items_wrapper">
    <div class="post-container">

        <div class="css-cq4c1a">
 

     

           <button class="css-cgslon" type="button" aria-label="twitterでシェア"><span class="fa fa-fw fa-twitter"></span></button>

            <button class="css-cgslon" type="button" aria-label="facebookでシェア"><span class="fa fa-fw fa-facebook"></span></button>
            
            @auth
            <div class="css-79elbk">
                <button type="button" aria-label="" class="css-1ydfkyi">
                    <span class="fa fa-fw fa-ellipsis-h"></span>
                </button>
                     
                <div class="css-l40u17 ">
                    @if   ($posts[0]['name'] == Auth::user()->name)
                    <div class="css-1gj7nt">Kaizen bài viết</div>
                    <a href="/drafts/post/{{  $posts[0]['item'] }}/edit" class="css-1g6mqq7">
                        <span class="fa fa-fw fa-pencil css-amwp7n" aria-hidden="true"></span>Sửa bài
                    </a>

                    <button data-item="{{ $posts[0]['item']}}" class="css-1nt9rv7 publish"><span class="fa fa-fw fa-globe css-amwp7n" aria-hidden="true"></span>Công khai bài viết</button>


                    <div class="css-1ode1bp"></div>
                    <button class="css-1nt9rv7 deleteitem"><span class="fa fa-fw fa-trash-o css-amwp7n" aria-hidden="true"></span>Xóa bài</button>
                    @else

                    <div class="css-1gj7nt">Kaizen bài viết</div>
                    <a href="/drafts/e1ef8f5fa880befa2695/edit" class="css-1g6mqq7"><span class="fa fa-fw fa-code-fork css-amwp7n" aria-hidden="true"></span>Gửi yêu cầu Kaizen</a>


                    <div class="css-1ode1bp"></div>
                    <button class="css-1nt9rv7 report"><span class="fa fa-fw fa-flag css-amwp7n" aria-hidden="true"></span>Báo cáo vi phạm</button>
                    @endif


                </div>
                
                 
         
                <div class="st-Modal report">
                    <div class="st-Modal_backdrop"></div>
                    <div class="st-Modal_body">
                        <form id = "reportuser" class = "reportuser">
                            {{ csrf_field() }}
                            <input type="hidden" name="reported_id" value="{{ $posts[0]['user_id']}}">
                        <input type="hidden" name="item_type" value="post">
                        <input type="hidden" name="item_id" value="{{ $posts[0]['post_id']}}">
                        
                            <div class="st-Form">
                            <span class="st-Form_label">Bài viết vi phạm lỗi nào dưới đây?</span>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="1">Vi phạm nội quy web Rồng Vàng IT</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="2">Vi phạm pháp luật Việt Nam</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="3">Vi phạm thuần phong mỹ tục Việt Nam</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="4">Spam</label>
                        </div>
                        <div class="st-Form st-Form-right"><button type="submit" class="css-qgrf2v2 e1rb7ucl0" disabled="" font-size="14">Báo cáo vi phạm</button>
                        </div>
                    </form>
                </div>
            </div>


            
        </div>
   

                <div class="st-Modal deleleItem">
                    <div class="st-Modal_backdrop"></div>
                    <div class="st-Modal_body">

                    <div class="container">
                          <h1>Xóa bài viết</h1>
                          <p >Bạn có chắc chắn xóa bài viết? Bài viết sau khi xóa sẽ <span style="color:red">không thể hồi phục</span>!</p>
                        
                
                          <div class="clearfix">
                            <button type="button" onclick="closeModal()" class="cancelbtn">Cancel</button>
                            <button type="button" data-type="post" data-itemId="{{ $posts[0]['post_id'] }}" data-atId="{{ $posts[0]['user_id'] }}" class="deletebtn">Delete</button>
                          </div>
                    </div>


            
                    </div>
                </div>
  

        @endauth

        @guest    
            <div class="css-79elbk">
                <button type="button" aria-label="オプションを開く" class="css-1ydfkyi authbtn">
                    <span class="fa fa-fw fa-ellipsis-h"></span>
                </button>
            </div>
        @endguest



        </div>

        <div class="p-items_options">
     <div class="css-4k3u1z">
            <a href="https://laptrinhcanban.com/" target="_blank"> <img src="{{URL::asset('/images/utils/laptrinhcanban.com.png')}}" alt="profile Pic" height="100%" width="100%" style="cursor: pointer;"></a>
    </div>
        </div>

        <div class="p-items_toc">


            <div class="css-pvblll">
                <div id="personalized-feed-side-ad" >
                    <div class="fb-page" data-href="https://www.facebook.com/rongvangit" data-tabs="timeline" data-width="300px" data-height="300px" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/rongvangit" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/rongvangit">Rồng Vàng IT.com</a></blockquote></div>
                </div>
            </div> 

            <div class="it-Toc">
                <strong class="toc-title">Nội dung</strong>
                <?php


                $someHtmlContent = $posts[0]['content'];
                $markupFixer  = new TOC\MarkupFixer();
                $tocGenerator = new TOC\TocGenerator();


                // This generates the Table of Contents in HTML
                $htmlOut = "<div class='it-Toc_nav'>" . $tocGenerator->getHtmlMenu($someHtmlContent, 2, 3). "</div>";

                echo $htmlOut;

                ?>

            </div>

        </div>

        <div class="p-items_main">

            <div class="css-1t6umzq">
                <div color="info" style="margin-bottom:24px" class="ege6nxl0 css-45lq7d e1qhcoec0"><p>Bài viết này đang ở trạng thái <i class="fa fa-lock" style="margin-right: 4px"></i><b>Riêng tư</b>.<b> Chỉ có người viết và những người được chia sẻ địa chỉ </b> mới có thể xem bài viết này.</p></div>

                      <div class="css-8qb8m4">
                    <div class="css-2imjyh">
                        <div class="css-17zza1i">
                            <div>
                                <div class="css-70qvj9"><a href="/<?php echo $posts[0]['name']; ?>" class="css-6su6fj"><img class="css-6su6fj" src="<?php echo '/storage/'.$posts[0]['profile_photo_path']; ?>" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" width="24" height="24" loading="lazy"></a>
                                    <div class="css-1r4slzx"><a href="/<?php echo $posts[0]['name']; ?>" class="css-1oacuu5">@<!-- --><?php echo $posts[0]['name']; ?></a>
                                    </div>
                                </div>
                                <div class="css-17ay39c">
                                    <?php
                                    $created = date( "Y-m-d", strtotime( $posts[0]['created_at'] ) );
                                    
                                    echo '<p class="css-1ay9vb9">Đăng ngày: <time datetime="'.$created.'">'.$created.'</time></p>&nbsp;';
                                    if($posts[0]['created_at'] != $posts[0]['updated_at']){
                                        $updated= date( "Y-m-d", strtotime( $posts[0]['updated_at'] ) );
                                        echo '<p class="css-1ay9vb9">Sửa ngày: <time datetime="'.$updated.'">'.$updated.'</time></p>';
                                    }
                                    ?>
                                    <span>{{ $countview }} Lượt xem</span>
                                </div>
                            </div>
                        </div>  
                    </div> 
                    <h1 class="css-cgzq40">{{ $posts[0]['title'] }}</h1>                   
                

                <div class="css-1wa99t2">
                    <span class="fa fa-tags mr-1of2 css-1l3zk9f" aria-hidden="true"></span></div>

            <?php 

                $tags = explode(",", $posts[0]['tags']);
                foreach ( $tags as $tag ) {
                    echo  '<a href="/tags/'.mb_strtolower($tag).'" class="css-1ynjcyf">'. $tag.'</a>';
                }
            ?>
                
                </div>

                <section class="it-MdContent">
                    <div id="personal-public-article-body">
                            
                        <!-- Viết post tại đây -->
                        <div id="post-content">
                        <?php

                         echo($posts[0]['content']);
                        ?>



                        </div>
                        

                    </div>
                    
                </section>
                <div class="css-1yzj1fm"><button class="css-l1ga49" type="button" aria-label="twitterでシェア"><span class="fa fa-fw fa-twitter"></span></button><button class="css-l1ga49" type="button" aria-label="facebookでシェア"><span class="fa fa-fw fa-facebook"></span></button></div>

                

            </div>





<div class="css-1t6umzq"><div><div class="css-k008qs"><div class="css-1jbemfh"><a href="/{{ $posts[0]['name'] }}"><img loading="lazy" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo '/storage/'.$posts[0]['profile_photo_path']; ?>"  alt="{{ $posts[0]['name'] }}" class="css-yj4pll"></a></div><div><div><a href="/{{ $posts[0]['name'] }}" class="css-1so9b3w">{{ $posts[0]['fullname'] }}</a></div><div><a href="/{{ $posts[0]['name'] }}" class="css-1otty5d"><?php echo'@'.$posts[0]['name'];?></a></div><div class="css-wwf5qc">@if($posts[0]['about']) {{ $posts[0]['about'] }} @endif</div><div class="css-mifb2i">
@auth
@if ($checkFollow =='true')
<div class="css-52rh9n"><button class="css-follow css-1pacd3k" data-at="<?php echo $posts[0]['user_id']?>"><span>Đang theo dõi</span></button></div>
@elseif ($checkFollow =='false')
<div class="css-52rh9n"><button class="css-follow css-10keyvc" data-at="<?php echo $posts[0]['user_id']?>"><span>Theo dõi</span></button></div>
@endif
@endauth
@guest
<div class="css-52rh9n"><button class="css-follow css-10keyvc authbtn"><span>Theo dõi</span></button></div>@endguest

    <div class="css-1b0wzno">

        @if($user->facebook)
        <a href="{{ $user->facebook }}" target="_blank" class="css-9exaa8"><span class="fa fa-fw fa-facebook css-8fyty9"></span>
        </a>
         @endif
        @if($user->zalo)
        <a href="{{ $user->zalo }}" target="_blank" rel="noopener" class="css-9exaa8"><img src="/images/utils/zalo.svg" style="width:15px; height: 15px; transform: translateY(0px);" ></span></a>
        @endif
        @if($user->github)
                <a href="{{ $user->github }}" target="_blank" rel="noopener" class="css-9exaa8"><span class="fa fa-github css-ry3l85"></span></a>
        @endif
        @if($user->youtube)
        <a href="{{ $user->youtube }}" target="_blank" rel="noopener" class="css-9exaa8"><span style="font-size:20px" class="fa-brands fa-youtube"></span></a>
         @endif
            @if($user->website)
            <div class="css-fv3lde">
                <a href="{{ $user->website }}" target="_blank" rel="noopener noreferrer nofollow" class="fa fa-globe css-9exaa8"></a>
     
            @endif
       <!--  <a href="/{{ $posts[0]['name'] }}/feed" target="_blank" class="css-9exaa8"><span class="fa fa-fw fa-rss css-8fyty9"></span>
        </a> -->
    </div>

</div>
</div>
</div>
</div>
</div>




<!--             <div class="css-1t6umzq">
                <div>
                    <div class="it-Ads_afterBodyContainer it-Ads_afterBodyContainer-wide">
                        <div class="mt-2">
                
                        </div>
                    
                    </div>
                    <div class="it-Ads_afterBodyContainer it-Ads_afterBodyContainer-wide">
                        <div class="mt-2">
                
                        </div>
                    
                    </div>
                    
                </div>
                

            </div> -->

<!--             <div class="css-13dx3yv">
                <div class="css-lkue19">
                    <div id="logly-lift-4279494" visibility="visible">
                        <div id="logly-lift-widget">
                            <div id="logly-lift-widget-header"> 
                                <span>Bài viết liên quan</span><span class="logly-lift-credit logly-lift-credit2"><a href="https://www.logly.co.jp/privacy.html" target="_top" rel="nofollow noopener">Recommended by<span class="logly-lift-credit-logo" title="logly"></span></a></span>  
                            </div>



                            
                        </div>
                        
                    </div>
                    

                </div>

            </div> -->
            <div class="css-cejglh">
                <div id="comments" class="css-8atqhb">
                    <p class="css-1r0y2zt">Bình luận</p>

                    <div class="css-comment" >
                      @include("user::Elements.userComment")
                    </div>  



                      @include("user::Elements.comment")
                </div>      
            </div>

        </div>

    </div>
</div>


<!-- stock modal -->
<div id="stockmodel">
    <div class="st-Modal">
    <!-- <div class="st-Modal is-open"> -->




        <div class="st-Modal_backdrop"></div>
        <div class="st-Modal_body css-tlvft">
            <div class="css-e5tuit">
                <div class="css-1gykiw6">Danh sách thư mục</div>
                <button type="button" class="css-g11wic"><span class="fa fa-times fa-fw css-1wvl6ln"></span></button>
            </div>
   
            @include("user::Elements.category_infor") 




            <div class="css-19midj6">
                <button type="button" class="css-1mteic8">
                    <span class="fa fa-plus fa-fw css-45hdgn"></span>
                    <div class="css-6ozust">Tạo thư mục mới</div>
                </button>
            </div>
            <div class="css-1mkdie5"><button data-at ="{{ $posts[0]['user_id'] }}" data-itemId ="{{ $posts[0]['post_id'] }}" class="css-b1sfia e1rb7ucl0" disabled font-size="14">Lưu</button></div>
        </div>
    </div>
</div>

<form style="display:none" method="POST" enctype="multipart/form-data" id="upload_image" action="{{ url('save') }}" >
    {{ csrf_field() }}
                <input type="file" type="hidden" name="image" placeholder="Choose image" id="image">
            @error('image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror 
           
</form>

@endsection

@section('script')
<script src="/js/show.js"></script>
<script src="/js/userpage.js"></script>
<script src="/assets/highlight/highlight.min.js"></script>
<script src="/assets/marked/marked.js"></script>
<script src="/js/editor.js"></script>

<script type="text/javascript">
    
    
</script>
@endsection

