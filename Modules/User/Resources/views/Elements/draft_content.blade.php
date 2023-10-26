<div class="css-1cwgncl e1s4dniw0">
	<div class="css-1tqngyh">
		@if ($post)
		<div class="css-g7g0ap">
			<div class="css-1coeexk">
				 @if ($post->type == '')
				<div class="css-17wtro">Bài viết</div>
				 @elseif  ($post->type == 'Q&A')
				 <div class="css-vrqk98">Câu hỏi</div>
				 @else
				 <div class="css-1ev8g5f">Thảo luận</div>
				 @endif


<!-- 				@if ($post->status == 2)
				<div class="css-3du3ps">Đang sửa</div>
				@endif -->
			</div>

			<div class="css-6rk9bb">{{$post->title}}</div>
			<div class="css-1ol10sz">
				<div class="css-1jux8gx eadp2oc0">
					<?php 
					$tags = explode(",", $post->tags);
					foreach ( $tags as $tag ) {
					    echo '<div class="css-14hhgyl eadp2oc1">'.$tag.'</div>';
					}
					?>
				</div>
			</div>

			<div class="it-MdContent">

				<?php

				     echo($post->content);
				    ?>
			</div>

		</div>
		<div class="css-y9pszt"><div class=""><a href="/drafts/<?php if($post->type){echo 'question/'.$post->item; }else{ echo  'post/'.$post->item ;} ?>/edit" style="text-decoration: none;"><button class="css-yyfpfk eaqxejg0"><span class="fa fa-pencil"></span></button></a></div><div class=""><button class="css-qb4ekr deletedraft" data-itemId="{{ $post->id }}" data-atId="{{ Auth::id() }}" data-type ="<?php if ($post->type == '') {echo 'post_draft';} else {echo 'question_draft' ;}?>" style="margin-top: 24px;"><i class="fa fa-trash"></i></button></div>
		</div>
		@else
		<div style="margin:20px 0;text-align:center"><p class="css-1yk0zej euu3pko2">Chưa có gì ở đây cả</p></div>
		@endif
	</div>

</div>