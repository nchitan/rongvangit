<?php 
// printf($user_infor->question_count);
// printf($user_infor->post_count);

	$contribution =
	   $user_infor->post_count * 1 +
       $user_infor->answear_count * 0.2 + 
       $user_infor->comment_count * 0.1 + 
       $user_infor->question_count* 0.1 + 

       $user_infor->liked_post_count * 1 + 
       $user_infor->liked_comment_count * 0.5 + 
       $user_infor->liked_question_count * 0.5 + 
       $user_infor->liked_answear_count * 0.5 + 
       $user_infor->stocked_post_count * 0.5 + 

       $user_infor->request_aproval*1 + 
       $user_infor->request_send*0.2 ; 
?>



<span class="css-hm64qx">{{ $contribution }} &nbsp Điểm cống hiến</span>