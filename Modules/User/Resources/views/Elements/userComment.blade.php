
@if (count($comments) != 0)

@foreach ($comments as $comment)
<section class="css-1q0wz2m">
	<div class="css-vdedeo" id="comment-<?php echo $comment['id'];?>" ><div class="css-70qvj9"><a href="/<?php echo $comment['name'];?>" class="css-q2y3yl">
		<img loading="lazy" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo '/storage/'.$comment['profile_photo_path'];?>" alt="<?php echo $comment['name'];?>" class="css-5wkws1"></a>
		<a href="/<?php echo $comment['name'];?>" class="css-q2y3yl"><?php echo '@'.$comment['name'];?></a>
	</div>
	<div class="css-70qvj9"><time class="css-7m9bsf"><?php echo (date( "Y-m-d H:m", strtotime( $comment['created_at'] ) )); if($comment['created_at'] != $comment['updated_at']){echo '(đã sửa)' ;} ?></time>
		<div class="css-dfpqc0"><span class="css-p9qzma"><span class="fa fa-ellipsis-h"></span></span>
			<div class="css-u4hpc5">
                <?php 
                    $currenturl =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

                    if(strpos($currenturl, "posts") !== false){
                        $link= $_SERVER["HTTP_HOST"].'/'.$posts[0]['name'].'/posts/'.$posts[0]['item'].'#comment-'.$comment['id'];

                    } else{
                        $link= $_SERVER["HTTP_HOST"].'/'.$posts[0]['name'].'/questions/'.$posts[0]['item'].'#answear-'.$comment['id'];
                    } 
                ?>
                <div class="css-1mcn277 copy" data-link ="<?php echo  $link ;?>">Copy link</div>
               
                @auth 

                
                @if( $comment['user_id'] == Auth::id() )
                <div class="css-1mcn277 edit" data-caId="{{ $comment['id'] }}">Sửa bình luận</div>
                @else

                <!-- <div class="css-1mcn277 report">Báo cáo</div> -->
                @endif
                <div class="css-1mcn277 delete" data-caId="{{ $comment['id'] }}" >Xóa bình luận</div>
                @endauth 
			</div>
		</div>
	</div>
</div>

<div>
<?php
   echo($comment['content']);
?>



</div>

<div class="css-ebwgjf">
<!-- 	<div class="css-1duml6f">
		<div class="css-1e8ng0n">
			<img id="likepost" src="/images/utils/like.svg" alt="profile Pic" height="40" width="40" style="cursor:pointer">

		</div><div class="">
				<button class="css-nje458"></button>
			</div>
		</div> -->


		<div class="css-1duml6f @guest {{ 'authbtn' }} @endguest">  
			<input type="checkbox" <?php if(in_array($comment['id'], $commentLikes_check)){echo 'checked';}?> data-atId ="<?php echo $comment['id'];?>" data-comid ="<?php echo $comment['id'];?>" data-itemID="<?php echo $posts[0]['post_id']?>" data-type="2" class="css-1drc635" style="border:none !important; background: none !important; display: none;">

			<img class="likecomment" src="/images/utils/<?php if(in_array($comment['id'], $commentLikes_check)){echo 'liked.svg';}else{echo 'like.svg';}?>" alt="profile Pic" height="40" width="40" style="cursor:pointer" >
		</div>
		<div class="co-Item_likeLabel"><?php 
                    if($comment['count']){
                    	echo ($comment['count']);
                    }else{echo "0";}?>
		</div>


	</div>
</section>



@endforeach

@else
<?php 
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

if(strpos($url, "posts") !== false){
    echo '<div class="css-1gbpb5n">Bài viết chưa có bình luận. Hãy trở thành người bình luận đầu tiên!</div>';
} else{
    echo '<div class="css-1gbpb5n">Câu hỏi chưa có ai trả lời. Giúp người hỏi ngay thôi!</div>';
}

?>

@endif


<!-- Report -->

<!-- <div class="st-Modal"><div class="st-Modal_backdrop"></div><div class="st-Modal_body"><form><div class="st-Form"><span class="st-Form_label">どのような問題がありますか？</span></div><div class="st-Form"><label><input class="st-Form_checkbox" type="checkbox" value="CommunityGuidelineViolation">コミュニティガイドライン違反</label></div><div class="st-Form"><label><input class="st-Form_checkbox" type="checkbox" value="IllegalViolation">法律違反</label></div><div class="st-Form"><label><input class="st-Form_checkbox" type="checkbox" value="SociallyInappropriate">社会的に不適切</label></div><div class="st-Form"><label><input class="st-Form_checkbox" type="checkbox" value="SuspectedSpam">スパムの疑い</label></div><div class="st-Form st-Form-right"><button type="submit" class="css-qgrf2v e1rb7ucl0" disabled="" font-size="14">送信</button></div></form></div></div> -->


