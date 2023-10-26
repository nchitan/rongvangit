<!-- <li class="css-s45xmw">
    <div class="css-kmnzss">
        <div class="css-17wtro">記事</div>
    </div>
    <div class="css-btzqj0">(タイトル未設定)</div>
    <div class="css-dc4zyz">Pythonの使い方</div>
    <time class="css-1rbyfv8">7 minutes ago</time>
    <div class="css-1qyizuk">
        <a href="/drafts/4c9992ce31bf1ca469cd/edit" style="text-decoration: none;">
            <button class="css-yyfpfk eaqxejg0"><span class="fa fa-pencil"></span></button>
        </a>
        <button class="css-qb4ekr epn46vq0" style="margin-left: 12px;"><i class="fa fa-trash"></i></button>
    </div>
</li> -->

<?php 

    // $time = strtotime($post->updated_at);
    // $time_difference = time() - $time;
    // $itemtime_ago="";

    // if( $time_difference < 1 ) { $itemtime_ago = 'less than 1 second ago'; }
    // $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
    //             30 * 24 * 60 * 60       =>  'month',
    //             24 * 60 * 60            =>  'day',
    //             60 * 60                 =>  'hour',
    //             60                      =>  'minute',
    //             1                       =>  'second'
    // );

    // foreach( $condition as $secs => $str )
    // {
    //     $d = $time_difference / $secs;

    //     if( $d >= 1 )
    //     {
    //         $t = round( $d );
    //         $itemtime_ago= 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
    //     }
    // }

    // print_r($itemtime_ago);

?>




@if ($key ==0)
<li class="css-s45xmw" data-item="<?php echo $post->item ?>" data-type= "<?php echo $post->type ?>">
@else
<li class="css-1nlq9qn" data-item="<?php echo $post->item ?>" data-type= "<?php echo $post->type ?>">
@endif
    <div class="css-kmnzss">

                 @if ($post->type == '')
                <div class="css-17wtro">Bài viết</div>
                 @elseif  ($post->type == 'Q&A')
                 <div class="css-vrqk98">Câu hỏi</div>
                 @else
                 <div class="css-1ev8g5f">Thảo luận</div>
                 @endif


<!--         @if ($post->status == 2)
        <div class="css-1913ym">Đang sửa</div>
        @endif -->
    </div>
    <div class="css-mmklm6">{{$post->title}}</div>
    <div class="css-dc4zyz"><?php if(strlen($post->content)>200){echo substr($post->content,0,100).'...';}else{echo $post->content;} ?></div>
    <time class="css-1rbyfv8">{{$post->updated_at}}</time>


<!--     echo get_time_ago( time()-2592000 ).'<br>'; -->

    <div class="css-1qyizuk">
        @if ($post->type)
        <a href="/drafts/question/<?php echo $post->item ?>/edit" style="text-decoration: none;">
        @else
        <a href="/drafts/post/<?php echo $post->item ?>/edit" style="text-decoration: none;">
        @endif
            <button class="css-yyfpfk eaqxejg0"><span class="fa fa-pencil"></span></button>
        </a><button class="css-qb4ekr epn46vq0" style="margin-left: 12px;"><i class="fa fa-trash"></i></button>
    </div>
</li>


