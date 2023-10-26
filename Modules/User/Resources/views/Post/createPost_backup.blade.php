@extends('common::layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/show.css') }}">
<link rel="stylesheet" href="{{ URL::asset('editor.md/css/editormd.css') }}">
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
                <div class="css-1duml6f">


                <input type="checkbox" <?php if($like_check != ""){echo 'checked';}?> data-username ="<?php echo $login_username?>" data-item="<?php echo $posts[0]['item']?>" data-type="1" class="css-1drc635" style="border:none !important; background: none !important; display: none;">


                <img id="<?php if(Auth::user()){echo 'likepost';} ?>" src="/images/utils/<?php if($like_check !=''){echo 'liked.svg';}else{echo 'like.svg';}?>" alt="profile Pic" height="40" width="40" style="cursor:pointer" >
                </div>
                
                <?php 
                    if($posts[0]['countlike']){
                        echo '<a href="/'.$posts[0]['name'].'/posts/'.$posts[0]['item'].'/likers" aria-label="3LGTM" class="css-8g69pl">'.$posts[0]['countlike'].'</a>';
                      
                    }else{
                        echo '<span class="css-8g69pl">0</span>';

                    }
                ?>
                        
                    
            </div>

            <div class="css-tubf1g">
                @if (count($checkStock) >0)
                <button class="<?php if(Auth::user()){echo 'css-1drc635';}else{echo 'css-1drc635 authbtn';} ?>" style="border:none">
                    <img id="<?php if(Auth::user()){echo 'stockpost';} ?>" src="{{URL::asset('/images/utils/stocked.svg')}}" alt="profile Pic" height="40" width="40">             
                </button>
                @else
                <button class="<?php if(Auth::user()){echo 'css-1drc635';}else{echo 'css-1drc635 authbtn';} ?>">
                    <img id="stockpost" src="{{URL::asset('/images/utils/stock.svg')}}" alt="profile Pic" height="20" width="20">             
                </button>
                @endif


                <span class="css-1j1r6a0"><?php if($posts[0]['countstock']){ echo $posts[0]['countstock'] ;}else{ echo '0' ;} ?></span>
                
            </div>

            <button class="css-cgslon" type="button" aria-label="twitterでシェア"><span class="fa fa-fw fa-twitter"></span></button>

            <button class="css-cgslon" type="button" aria-label="facebookでシェア"><span class="fa fa-fw fa-facebook"></span></button>
            
            @auth
            <div class="css-79elbk">
                <button type="button" aria-label="オプションを開く" class="css-1ydfkyi">
                    <span class="fa fa-fw fa-ellipsis-h"></span>
                </button>
                     
                <div class="css-l40u17 ">
                    @if   ($posts[0]['name'] == Auth::user()->name)
                    <div class="css-1gj7nt">Kaizen bài viết</div>
                    <a href="/drafts/post/{{  $posts[0]['item'] }}/edit" class="css-1g6mqq7">
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
                    <button class="css-1nt9rv7"><span class="fa fa-fw fa-trash-o css-amwp7n" aria-hidden="true"></span>Xóa bài</button>
                    @else

                    <div class="css-1gj7nt">Kaizen bài viết</div>
                    <a href="/drafts/e1ef8f5fa880befa2695/edit" class="css-1g6mqq7"><span class="fa fa-fw fa-code-fork css-amwp7n" aria-hidden="true"></span>Gửi yêu cầu Kaizen</a>


                    <div class="css-1ode1bp"></div>
                    <button class="css-1nt9rv7"><span class="fa fa-fw fa-flag css-amwp7n" aria-hidden="true"></span>Báo cáo vi phạm</button>
                    @endif


                </div>
                
                 
                <div class="st-Modal">
                    <div class="st-Modal_backdrop"></div>
                    <div class="st-Modal_body">
                        <form><div class="st-Form">
                            <span class="st-Form_label">Bài viết vi phạm lỗi nào dưới đây?</span>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="CommunityGuidelineViolation">Vi phạm nội quy web Rồng Vàng IT</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="IllegalViolation">Vi phạm pháp luật Việt Nam</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="SociallyInappropriate">Vi phạm thuần phong mỹ tục Việt Nam</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="SuspectedSpam">Spam</label>
                        </div>
                        <div class="st-Form st-Form-right"><button type="submit" class="css-qgrf2v e1rb7ucl0" disabled="" font-size="14">Báo cáo vi phạm</button>
                        </div>
                    </form>
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
            <div class="mt-2">
                
            </div>
        </div>

        <div class="p-items_toc">
            <div class="mt-2">
                
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
                <div class="css-8qb8m4">
                    <div class="css-2imjyh">
                        <div class="css-17zza1i">
                            <div>
                                <div class="css-70qvj9"><a href="/<?php echo $posts[0]['name']; ?>" class="css-6su6fj"><img class="css-6su6fj" src="<?php echo '/storage/'.$posts[0]['profile_photo_path']; ?>" width="24" height="24" loading="lazy"></a>
                                    <div class="css-1r4slzx"><a href="/<?php echo $posts[0]['name']; ?>" class="css-1oacuu5">@<!-- --><?php echo $posts[0]['name']; ?></a>
                                    </div>
                                </div>
                                <div class="css-17ay39c">
                                    <?php
                                    $created = date( "Y-m-d", strtotime( $posts[0]['created_at'] ) );
                                    $updated= date( "Y-m-d", strtotime( $posts[0]['updated_at'] ) );
                                    echo '<p class="css-1ay9vb9">Đăng ngày: <time datetime="'.$created.'">'.$created.'</time></p>&nbsp;';
                                    echo '<p class="css-1ay9vb9">Sửa ngày: <time datetime="'.$updated.'">'.$updated.'</time></p>';
                                    ?>

                                </div>
                            </div>
                        </div>  
                    </div>                    
                </div>

                <div class="css-1wa99t2">
                    <span class="fa fa-tags mr-1of2 css-1l3zk9f" aria-hidden="true"></span>

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


            <div class="css-1t6umzq">
                <div class="css-k008qs">
                    <div class="css-1jbemfh">
                        <a href="/<?php echo $posts[0]['name']; ?>">
                        <img loading="lazy" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo '/storage/'.$posts[0]['profile_photo_path'];?>" alt="<?php echo $posts[0]['name']; ?>" class="css-yj4pll">
                    </a>
                </div>
                <div>
                    <div>
                        <a href="/<?php echo $posts[0]['name']; ?>" class="css-1so9b3w">{{$posts[0]['fullname']}}</a>
                    </div>
                    <div>
                        <a href="/<?php echo $posts[0]['name']; ?>" class="css-1otty5d">@<?php echo $posts[0]['name']; ?></a></div><div class="css-mifb2i"><div class="css-52rh9n">
                            <button class="css-dx6q6l">Theo dõi</button>
                        </div>
                        <div class="css-1b0wzno"><a href="/<?php echo $posts[0]['name']; ?>/feed" target="_blank" class="css-9exaa8"><span class="fa fa-fw fa-rss css-8fyty9"></span></a>
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
<div id="author" style="visibility: hidden;">{{ $posts[0]['name']}}</div>

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
            <div class="css-1elw6c9">

                @foreach ($categories as $user_category)
                 @if(in_array($user_category['category_name'], $checkStock))
        
                <div class="css-dwc3sl" data-cateid= "<?php echo $user_category['id'];?>">
                    <span class="fa fa-check-square css-7w3lkf"></span>{{$user_category['category_name']}}
                    <br>&nbsp&nbsp&nbsp&nbsp <span class="fa fa-check-square css-7w3lkf"></span>{{$user_category['category_name']}}
                </div>
                @else
                <div class="css-dwc3sl" data-cateid= "<?php echo $user_category['id'];?>">
                    <span class="fa fa-square css-imaq8p"></span>{{$user_category['category_name']}}
                    <br>&nbsp&nbsp&nbsp&nbsp <span class="fa fa-check-square css-7w3lkf"></span>{{$user_category['category_name']}}
                </div>
                @endif
                @endforeach
            </div>    





            <div class="css-19midj6">
                <button type="button" class="css-1mteic8">
                    <span class="fa fa-plus fa-fw css-45hdgn"></span>
                    <div class="css-6ozust">Tạo thư mục mới</div>
                </button>
            </div>
            <div class="css-1mkdie5"><button class="css-b1sfia e1rb7ucl0" disabled font-size="14">Lưu</button></div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="/js/show.js"></script>
@endsection

