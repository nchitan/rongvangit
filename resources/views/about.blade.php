<!doctype html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    @include("common::Elements.meta")

    <link rel="stylesheet" href="{{ URL::asset('css/term.css') }}">
   
</head>    

</head>
<body>
@include("common::Elements.header") 
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

	<div class="p-about">

	<section class="ab-Concept"><div class="ab-Heading"><div class="ab-Heading_label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CONCEPT</font></font></div><h2 class="ab-Heading_text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Suy nghĩ của Rồng Vàng IT</font></font></h2></div><section class="ab-Concept_section">

<h3 class="ab-Concept_heading">Rồng vàng IT - Nơi bầy cá chép vượt vũ môn</font></font></h3><p class="ab-Concept_text">
Kỹ sư IT Việt Nam, vốn là những con người cần cù chăm chỉ. Cũng là những người thực sự thông minh, chịu thương chịu khó. 
Vì chỉ có họ mới có đủ sự cần mẫn, kiên nhẫn và tập trung vào từng dòng code nhỏ, để vẽ nên những hệ thống tuyệt vời cho người đời chiêm ngưỡng.
<br>
Trang web này được tạo ra cho những con người đơn giản như vậy.
Để họ thoả sức thể hiện bản thân, đem cái trí tuệ chắt chiu từ những trải nghiệm của cuộc đời mình.
<br>
Cho đời biết mình là ai.
Cũng là cho con cháu sau này có nơi để khảo nghiệm tri thức.
<br>
Trang web này cũng được tạo ra cho những người yêu ngành IT, muốn học hỏi, muốn đóng góp, muốn cống hiến tri thức cho đời.
<br>
Vì họ biết, kiến thức cho đi chính là sự nhận lại nhiều nhất
Và nỗ lực của ta hôm nay có thể giúp đỡ cho cả những thế hệ tương lai mai sau.
<br>
Rồng Vàng IT sẽ là nơi để vinh danh những con người như vậy, những kỹ sư IT Việt Nam đang cần cù học tập và làm việc, để một ngày IT Việt Nam hoá rồng.
</p>

		<h3 class="ab-Concept_heading"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Một nơi có thể thu thập thông tin hữu ích cho kỹ sư IT Việt Nam</font></font></h3><p class="ab-Concept_text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Rồng Vàng IT với sứ mệnh là nơi giúp các kỹ sư IT Việt nam có thể chia sẻ, thu thập và tìm thấy các thông tin hữu ích cho học tập và phát triển sự nghiệp tương lai. <br>Bằng cách viết bài, chia sẻ, đặt câu hỏi mà từng kỹ sư có thể ghi lại quá trình học hỏi phát triển của mình, cũng như bằng cách cùng tương tác với nhau và phát triển thông tin mà các kỹ sư có thể giảm thời gian tìm kiếm thông tin, tăng năng suất và tập trung cho phát triển công việc và sự nghiệp của bạn.
		</font></font></p>
	</section>

	<section class="ab-Concept_section"><h3 class="ab-Concept_heading"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Một nơi kết nối "bạn" và "ai đó" trong cộng đồng IT Việt Nam</font></font></h3><p class="ab-Concept_text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi bạn đọc một bài viết, nó không chỉ đơn thuần là tiếp nhận thông tin, mà còn là sự kết nối với ai đó thông qua bài viết. Bạn có thể kết nối với những người quan tâm đến cùng lĩnh vực hoặc có bộ kỹ năng tương tự thông qua các bài viết của Rồng Vàng IT. Bằng cách kết nối "bạn" và "ai đó", hãy tăng cường sự khám phá và nhận thức mới với tư cách là một kỹ sư IT Việt Nam.</font></font></p>
	</section>

	<section class="ab-Concept_section"><h3 class="ab-Concept_heading"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hãy thiết lập và thể hiện bản sắc của chúng ta với tư cách là một kỹ sư</font></font></h3><p class="ab-Concept_text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Rồng Vàng IT giúp bạn thể hiện điểm mạnh và sở thích của mình bằng cách chia sẻ kinh nghiệm của bạn cho cộng đồng và được đánh giá, đồng thời bằng cách bạn đánh giá các bài viết của người khác mà bạn thấy thú vị khi đọc ... </font><font style="vertical-align: inherit;">Càng nhiều hoạt động như truyền tải và đánh giá được thực hiện trên Rồng Vàng IT, thì càng có nhiều bài viết phù hợp với bạn sẽ được phân phối và chúng tôi hướng tới mục tiêu là nơi bạn có thể kết nối với các kỹ sư IT khác trên toàn Việt Nam và thế giới.</font></font></p></section>
	</section>

		<section class="ab-Signup"><div class="ab-Signup_content"><div class="ab-Signup_image ab-Signup_image--left"></div><a class="ab-Signup_button" href="/register"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đăng ký với tư cách là người dùng</font></font></a><div class="ab-Signup_image ab-Signup_image--right"></div></div>
		</section>
	</div>
</body>
@include("common::Elements.footer") 
@include("common::Elements.scripts")
<script src="/js/common.js"></script>