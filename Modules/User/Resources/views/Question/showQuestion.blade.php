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
            <div class="css-1x8nfy4">
                <div class="css-1duml6f @guest {{ 'authbtn' }} @endguest">  


                <input type="checkbox" <?php if($like_check != ""){echo 'checked';}?> data-atId="<?php echo $posts[0]['user_id']?>" data-itemId="<?php echo $posts[0]['post_id']?>" data-type="1" class="css-1drc635" style="border:none !important; background: none !important; display: none;">


                <img title="thích" id="<?php if(Auth::user()){echo 'likepost';} ?>" src="/images/utils/<?php if($like_check !=''){echo 'liked.svg';}else{echo 'like.svg';}?>" alt="profile Pic" height="40" width="40" style="cursor:pointer" >
                </div>
                
                <?php 
                    if($posts[0]['countlike']){
                        echo '<a href="/'.$posts[0]['name'].'/questions/'.$posts[0]['item'].'/likers" aria-label="3LGTM" class="css-8g69pl">'.$posts[0]['countlike'].'</a>';
                      
                    }else{
                        echo '<span class="css-8g69pl">0</span>';

                    }
                ?>
                        
                    
            </div>



<span class="zalo-share-button css-cgslon" title="chia sẻ qua zalo" style="margin: 15px 4px" data-href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=https://rongvangit.com/'.$posts[0]['name'].'/posts/'.$posts[0]['item'];?>" data-oaid="579745863508352884" data-layout="3" data-color="blue" data-customize=false></span>

            <a target="_blank" rel="noopener noreferrer" href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=https://rongvangit.com/'.$posts[0]['name'].'/posts/'.$posts[0]['item'];?>" title="chia sẻ qua facebook" class="css-cgslon"><i class="fa fa-facebook"></i></a>
            
            @auth
            <div class="css-79elbk">
                <button type="button" aria-label="オプションを開く" class="css-1ydfkyi">
                    <span class="fa fa-fw fa-ellipsis-h"></span>
                </button>
                     
                <div class="css-l40u17 ">
                    @if   ($posts[0]['name'] == Auth::user()->name)
                    <div class="css-1gj7nt">Kaizen bài viết</div>
                    <a href="/drafts/question/{{  $posts[0]['item'] }}/edit" class="css-1g6mqq7">
                        <span class="fa fa-fw fa-pencil css-amwp7n" aria-hidden="true"></span>Sửa bài
                    </a>

               

<!--                     <div class="css-1ode1bp"></div>
                    <div class="css-1gj7nt">記事の情報</div>
                        <a href="/anlanphan/items/0cbd479005d8b51d8d8d/revisions" class="css-1g6mqq7">
                            <span class="fa fa-fw fa-history css-amwp7n" aria-hidden="true"></span>編集履歴</a>
                        <a href="/anlanphan/items/0cbd479005d8b51d8d8d/patches" class="css-1g6mqq7">
                            <span class="fa fa-fw fa-inbox css-amwp7n" aria-hidden="true"></span>編集リクエスト一覧</a>
                        <a href="/anlanphan/items/0cbd479005d8b51d8d8d.md" class="css-1g6mqq7"><span class="fa fa-fw fa-file-text-o css-amwp7n" aria-hidden="true"></span>Markdown で本文を見る</a> -->
                    <div class="css-1ode1bp"></div>
                    <button class="css-1nt9rv7 deleteitem"><span class="fa fa-fw fa-trash-o css-amwp7n" aria-hidden="true"></span>Xóa bài</button>
                    @else

                    <div class="css-1gj7nt">Kaizen bài viết</div>
                    <a href="/drafts/e1ef8f5fa880befa2695/edit" class="css-1g6mqq7"><span class="fa fa-fw fa-code-fork css-amwp7n" aria-hidden="true"></span>Gửi yêu cầu Kaizen</a>


                    <div class="css-1ode1bp"></div>
                    <button class="css-1nt9rv7"><span class="fa fa-fw fa-flag css-amwp7n" aria-hidden="true"></span>Báo cáo vi phạm</button>
                    @endif


                </div>
                
                 
            <div class="st-Modal report">
                    <div class="st-Modal_backdrop"></div>
                    <div class="st-Modal_body">
                        <form id = "reportuser" class = "reportuser">
                            {{ csrf_field() }}
                            <input type="hidden" name="reported_id" value="{{ $posts[0]['user_id']}}">
                        <input type="hidden" name="item_type" value="question">
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
                          <p >Bạn có chắc chắn xóa bài viết? Bài viết sau khi xóa sẽ <span style="color:red">không thể phục hồi</span>!</p>
                        
                
                          <div class="clearfix">
                            <button type="button" onclick="closeModal()" class="cancelbtn">Cancel</button>
                            <button type="button" data-type="question" data-itemId="{{ $posts[0]['post_id'] }}" data-atId="{{ $posts[0]['user_id'] }}" class="deletebtn">Delete</button>
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

<div class="css-1rcxwlu e1y1ssrz1">
    <div class="css-1lekzkb e1y1ssrz2">
        <div class="css-1au4f8r elkmrco0">
            <a href="/{{ $posts[0]['name'] }}">
                <img loading="lazy" src="<?php echo '/storage/'.$posts[0]['profile_photo_path']; ?>" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" width="32" height="32" class="css-ib6xve">
            </a>
            <a href="/{{ $posts[0]['name'] }}">
                <div class="css-1ipqce2 elkmrco1">@<!-- -->{{ $posts[0]['name'] }}</div></a>
            <?php
                $created = date( "Y-m-d", strtotime( $posts[0]['created_at'] ) );
                
                echo '<time datetime="'.$created.'" class="css-1lryg11 elkmrco2">&nbsp;Đăng ngày: '.$created.'</time>';
                if($posts[0]['created_at'] != $posts[0]['updated_at']){
                    $updated= date( "Y-m-d", strtotime( $posts[0]['updated_at'] ) );
                    echo '<time datetime="'.$updated.'" class="css-1lryg11 elkmrco2">&nbsp;&nbsp;Sửa ngày: '.$updated.'</time>';
                }
            ?>
            <span style="color: #999999;">&nbsp;&nbsp;&nbsp;{{ $countview }} Lượt xem</span>
        </div>

  

    </div>

    <div class="css-43byj2 e1y1ssrz3"><div class="css-3k83re e1y1ssrz8"><div class="css-zrh2pa e1y1ssrz10">Q&amp;A</div></div>
    </div><h1 class="css-1sehtxb e1y1ssrz5">{{ $posts[0]['title'] }}</h1>

<div class="css-1dtnjt5 e1y1ssrz6">
    <div class="css-14u913p e1y1ssrz4">
        <div class="css-3k83re e1y1ssrz8">
            <?php 
            if ($posts[0]['type'] =="Q&A"){
            echo  '<div class="css-zrh2pa">'.$posts[0]['type'].'</div>';
            }else{
                 echo  '<div class="css-17879sv">'.$posts[0]['type'].'</div>';      
            }?>
        </div>
    </div>

    <div class="css-1jux8gx ezs40gf0">
                        <?php 
                            $tags = explode(",", $posts[0]['tags']);
                            foreach ( $tags as $tag ) {
                                echo  '<a href="/tags/'.mb_strtolower($tag).'" class="css-5etkcj ezs40gf1">'. $tag.'</a>';
                            }
                        ?>
    </div>
</div>


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
                <div class="css-1yzj1fm">
                    <span class="zalo-share-button css-l1ga49" title="chia sẻ qua zalo" style="margin: 15px 4px" data-href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=https://rongvangit.com/'.$posts[0]['name'].'/posts/'.$posts[0]['item'];?>" data-oaid="579745863508352884" data-layout="3" data-color="blue" data-customize=false></span>

                    <a target="_blank" rel="noopener noreferrer" href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=https://rongvangit.com/'.$posts[0]['name'].'/posts/'.$posts[0]['item'];?>" title="chia sẻ qua facebook" class="css-l1ga49"><i class="fa fa-facebook"></i></a>
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
                    <p class="css-1r0y2zt">Trả lời</p>

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
            <div class="css-1mkdie5"><button data-at ="{{ $posts[0]['user_id'] }}" class="css-b1sfia e1rb7ucl0" disabled font-size="14">Lưu</button></div>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
<script src="/assets/marked/marked.js"></script>
<script src="/js/editor.js"></script>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>
@endsection

