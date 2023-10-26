 @guest
	<div class="st-Modal st-Modal-login"><div class="st-Modal_backdrop"></div>
		<div class="st-Modal_body"><div class="css-gg4vpm">
			<div class="css-1tbyqbm">Tại sao không đăng ký và nhận được nhiều hơn từ RồngVàngIT ?</div>
			<button aria-label="閉じる" class="fa fa-fw fa-times css-yh67nw"></button>
		</div><p class="css-1mi8o62">Bạn cần đăng nhập để sử dụng chức năng này, cùng hàng loạt các chức năng tuyệt vời khác của RồngVàngIT !</p>
		<div class="css-ryur0b">
			<div>
				<ol class="css-26shl7">
					<li>1. Bạn sẽ nhận được các bài viết phù hợp bằng chức năng theo dõi tag và người dùng.</li>
					<li class="css-1yuhvjn">2. Bạn có thể đọc lại các thông tin hữu ích bằng chức năng lưu trữ nội dung.</li>
					<li class="css-1yuhvjn">3. Chia sẻ kiến thức, đặt câu hỏi và ghi lại quá trình trưởng thành của mình cùng RồngVàngIT !</li>
				</ol>
				<a href="/register" rel="nofollow" class="css-eln2kn">Tạo tài khoản</a>
				<a href="/login" rel="nofollow" class="css-1197zgb">Đăng nhập</a>
			</div>
			<!-- <img src="//cdn.rongvangit.com/assets/public/rongvangitn-for-login-modal-014e085d3e40a240e3fe8d61b70b29a9.png" alt="" class="css-1x1nsjm"> -->

			<img src="{{URL::asset('/images/utils/rongkute.png')}}" class="css-1x1nsjm" alt="profile Pic" height="150" width="150" style="">
		</div>

		</div>
	</div>
@endguest

@auth

<div id="userLogged" style="visibility: hidden;">{{ Auth::user()->name}}</div>
@endauth