@guest
<div class="css-13b2478"><div class="css-15k3zid">Sign up for free and join this conversation.</div><a href="/register" rel="nofollow" class="css-1f5p3ds">Sign Up</a><div class="css-164r41r">If you already have a RongvangIT account <a href="/login" rel="nofollow">Login</a></div></div>
@endguest

@auth

<?php 
// $str =Auth::id().date('y').date('m').date('d').date('h').date('m').date('s');
// $text =  str_split(strval($str ));
// $item_comment = '';
// foreach ($text as $key => $value){
//     if($key%2 == 0){
//         $item_comment.=chr(intval($value)+97);
//     }else{
//         $item_comment.=$value;
//     }
// } 
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

if(strpos($url, "posts") !== false){
    $t= "bình luận";

} else{
    $t= "trả lời";
}  

?>

<div class="css-16ai9md">
    <div>
        <div class="css-1eb4shr e1kr2j5i0">
            <img class="css-100alwu eyfquo10" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo '/storage/'.$posts[0]['profile_photo_path'];?>" width="36" height="36" loading="lazy">
            <span class="css-y8vo6o e1kr2j5i1">Đăng <?php echo $t;?> </span>
        </div>
        <div class="css-1fnrshs e1kr2j5i2">
            <div class="css-k008qs e1kr2j5i3">
                <div class="css-1w8dyws e1kr2j5i4">Nội dung</div>
                <div class="css-1kbv4lt e1kr2j5i4">Xem trước</div></div>

        </div>
        <div class="css-ee6kxn e1kr2j5i10">
                <textarea name="new" placeholder="Nhập bình luận" class="css-ty7eka e1kr2j5i12" id="comment_block" style="overflow: hidden scroll; overflow-wrap: break-word; resize: none; height: 100px;"></textarea>
                <div class="co-Item_text css-5ldyj5 e1kr2j5i11" id="comment_content" style="margin-bottom: 0px; display: none;"><div class="co-Item_text"></div>
            </div>
        </div>
        <div class="css-1hbfboa e1kr2j5i13">
            <div class="css-18fgn0k e1kr2j5i14" style=""><span class="css-hlm1x e1kr2j5i15"><i class="fa fa-picture-o"></i>Chọn ảnh</span>

            </div>
        <button data-itemId="{{ $posts[0]['post_id'] }}" data-action = 'create' data-caId='' class="css-qgrf2v e1rb7ucl0" font-size="14" style="margin-left: auto;">Đăng
        </button>
        </div><input type="file" style="display: none;">
    </div></div>

@endauth