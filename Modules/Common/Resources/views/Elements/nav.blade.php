		<div class="css-1w0hkdc">




			@guest
<!-- 			<div class="css-13b2478"><div class="css-15k3zid">Sign up for free and join this conversation.</div><a href="/register" rel="nofollow" class="css-1f5p3ds">Sign Up</a><div class="css-164r41r">If you already have a RongvangIT account <a href="/login" rel="nofollow">Login</a></div></div> -->

			<section class="css-6qambc"><p class="css-qs2qiw">Rồng Vàng IT là dịch vụ chia sẻ kiến thức dành cho kỹ sư IT Việt Nam.</p><p class="css-rjx7i2">Hãy chia sẻ kiến thức, đặt câu hỏi và ghi lại quá trình trưởng thành của mình. Vì một ngày IT Việt Nam hoá Rồng!</p><a href="/register" class="css-1o1vpnh">Tạo tài khoản</a><a href="/login" class="css-4dsg1h">Đăng nhập</a></section>
			
			@endguest

			@auth
<!-- 			<section class="css-z8u4k7">
				<div class="css-z7mtfw" style="width: 300px;height: 250;">
					

				</div>

				<div class="css-nz5egx">
					<div>
					</div>
					
				</div>
				<div class="css-8875ym">
					<a target="_blank" href="https://github.com/increments/dekita-discussions/discussions/146" class="css-lfdr4t">Xem them</a>
				</div>
			</section> -->
			@endauth


			<div class="css-8fwe4o">
				@include("common::Elements.tagRanking")
				{{--@include("common::Elements.organizationRanking") --}}
				@include("common::Elements.userRanking")
			</div>
		</div>