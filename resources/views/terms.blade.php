<!doctype html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    @include("common::Elements.meta")
<link rel="stylesheet" href="{{ URL::asset('css/term.css') }}">
<style type="text/css">
ol > li > ol > li {
list-style-type:  lower-roman !important;
}
ol > li > ol > li > ol > li {
list-style-type:  lower-latin !important;
}

</style></p><style type="text/css">ol > li > ol > li {
list-style-type:  lower-roman !important;
}
ol > li > ol > li > ol > li {
list-style-type:  lower-latin !important;
}    
</style>

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
  

<div id="main">
    <div class="policy">
        <div class="policy_inner">
            <div class="policy_row">
                <div class="policy_navigation">
                    <div class="list-group">
                        <a class="list-group-item active" href="/terms-of-service"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều khoản Dịch vụ</font></font>
                        </a>

                    </div>

                    <div class="list-group">
                        <a class="list-group-item" href="/guideline"><span class="fa fa-external-link"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nguyên tắc cộng đồng</font></font></a>
                        <!-- <a class="list-group-item" target="_blank" href="http://help.Rồng Vàng IT.com/ja/articles/Rồng Vàng IT-article-guideline"><span class="fa fa-external-link"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Làm thế nào để viết những bài báo tốt</font></font></a> -->
                    </div>
                </div>

                <div class="policy_main">
                   <div class="markdownContent">

<!-- start contente -->
<h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều khoản dịch vụ</font></font></h1><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Rồng Vàng IT là dịch vụ chia sẻ kiến thức dành cho kỹ sư IT Việt Nam. Rồng Vàng IT có các điều khoản sử dụng sau đây. </font><font style="vertical-align: inherit;">Người dùng đã đăng ký sử dụng Rồng Vàng IT (được định nghĩa tại Điều 1) sẽ đọc các Điều khoản Sử dụng này và sử dụng Rồng Vàng IT với tinh thần tôn trọng của họ.</font></font></p>

<h2>
<span id="第一章定義及び本規約について" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chương 1: Định nghĩa và Thuật ngữ</font></font></h2>

<h3>
<span id="第1条定義" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 1 (Định nghĩa)</font></font></h3>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các điều khoản được sử dụng trong Điều khoản dịch vụ của Rồng Vàng IT sẽ có ý nghĩa được nêu dưới đây.</font></font></li>
</ol>

<table class="table">
   <tbody><tr>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dịch vụ này</font></font></td>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đây là Rồng Vàng IT, một trang web chia sẻ thông tin kỹ thuật do team chúng tôi cung cấp.</font></font></td>
   </tr>
   <tr>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tài khoản này</font></font></td>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đây là tài khoản Rồng Vàng IT bắt buộc phải có để sử dụng dịch vụ này.</font></font></td>
   </tr>
   <tr>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng kí</font></font></td>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng dịch vụ này có tài khoản Rồng Vàng IT.</font></font></td>
   </tr>
   <tr>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thỏa thuận này</font></font></td>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các điều khoản và điều kiện liên quan đến việc sử dụng dịch vụ này được gọi là "Điều khoản Dịch vụ Rồng Vàng IT" được thiết lập giữa người dùng đã đăng ký và team của chúng tôi. </font><font style="vertical-align: inherit;">Ngoài ra, </font></font><a href="/guideline" rel="nofollow noopener" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">nguyên tắc cộng đồng</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> được đặt ra với mục đích cho thấy Rồng Vàng IT sẽ là địa điểm như thế nào với những người dùng đã đăng ký và thỏa thuận này cũng đóng vai trò để hiện thực hóa địa điểm được chỉ định trong hướng dẫn cộng đồng. </font><font style="vertical-align: inherit;">Vui lòng kiểm tra các nguyên tắc cộng đồng như một điều kiện tiên quyết cho thỏa thuận này.</font></font></td>
   </tr>
   <tr>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thông tin đăng kí</font></font></td>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đây là thông tin về người dùng đã đăng ký mà chúng tôi chỉ định và đăng ký khi có được tài khoản này. </font><font style="vertical-align: inherit;">Ngoài ra, bạn sẽ được yêu cầu đăng ký tên người dùng và địa chỉ e-mail của bạn trong thông tin đăng ký, nhưng thông tin này và thông tin liên quan đến nó có thể được hiển thị khi bạn đăng một bài viết trên Rồng Vàng IT. </font><font style="vertical-align: inherit;">Do đó, hãy cẩn thận khi sử dụng tên người dùng hoặc địa chỉ email có chứa tên thật của bạn hoặc thông tin nhận dạng cá nhân khác.</font></font></td>
   </tr>
   <tr>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chứng chỉ người dùng này</font></font></td>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Có nghĩa là người dùng đã đăng ký có đủ tư cách trên dịch vụ này, cụ thể là có thể đăng bài viết trên dịch vụ này, bình luận về bài viết được đăng bởi người dùng đã đăng ký khác, hoặc sử dụng các chức năng khác nhau như Like ...</font></font></td>
   </tr>
   <tr>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nội dung đã đăng</font></font></td>
      <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đây là một thuật ngữ chung cho dữ liệu được đăng trên dịch vụ này, bao gồm dữ liệu văn bản như bài đăng, nhận xét và bản tự giới thiệu về hồ sơ công khai được đăng bởi người dùng đã đăng ký sử dụng dịch vụ này, hình ảnh và tệp video / âm thanh.</font></font></td>
   </tr>

</tbody></table>

<h3>
<span id="第2条適用範囲利用規約の変更" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 2 (Thay đổi về phạm vi và điều khoản sử dụng)</font></font></h3>

<ol>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thỏa thuận này áp dụng cho tất cả các mối quan hệ pháp lý phát sinh từ việc sử dụng dịch vụ này giữa người dùng đã đăng ký và team của chúng tôi. </font><font style="vertical-align: inherit;">Người dùng đã đăng ký sẽ sử dụng dịch vụ này sau khi đồng ý với thỏa thuận này.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu người dùng đã đăng ký đăng ký tài khoản này thì được coi là đã đồng ý với thỏa thuận này.</font></font></p></li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Team chúng tôi có thể thay đổi (bao gồm cả việc bổ sung) nội dung của thỏa thuận này mà không cần có sự đồng ý của người dùng đã đăng ký nếu áp dụng bất kỳ mục nào sau đây.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi các thay đổi đối với các Điều khoản này vì lợi ích chung của người dùng đã đăng ký.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Việc thay đổi thỏa thuận này không đi ngược lại mục đích của người dùng đã đăng ký đăng ký sử dụng dịch vụ này và hợp lý về mức độ cần thiết của việc thay đổi, sự phù hợp của nội dung thay đổi, nội dung thay đổi và các trường hợp khác liên quan đến sự thay đổi. Khi đó là một điều tốt.</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi chúng tôi thay đổi thỏa thuận này, chúng tôi sẽ thông báo cho bạn trên blog chính thức về sự thay đổi của thỏa thuận này và nội dung và ngày có hiệu lực của thỏa thuận đã thay đổi ít nhất một tuần trước ngày có hiệu lực của thỏa thuận đã thay đổi, sẽ được tiết lộ bằng chức năng thông báo trong Rồng Vàng IT.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu người dùng đã đăng ký sử dụng dịch vụ này sau ngày các điều khoản được thay đổi có hiệu lực thì được coi là đã đồng ý với những thay đổi của các điều khoản này.</font></font></p></li>
</ol>

<h2>
<span id="第二章本サービスの利用について" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chương 2: Giới thiệu về việc sử dụng dịch vụ này</font></font></h2>

<h3>
<span id="第3条利用登録" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 3 (Đăng ký)</font></font></h3>

<ol>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Những người muốn sử dụng dịch vụ này với tư cách là người dùng đã đăng ký sẽ có được tài khoản này sau khi đăng ký sử dụng với dịch vụ này.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Mỗi người dùng đã đăng ký chỉ có thể có một tài khoản.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký phải cập nhật thông tin thành viên của mình luôn cập nhật, đầy đủ và chính xác tại thời điểm đăng ký và sau khi đăng ký, đồng thời cập nhật thông tin kịp thời khi thông tin đã đăng ký thay đổi.</font></font></p></li>
</ol>

<h3>
<span id="第4条ユーザー名とパスワード" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 4 (Tên người dùng và mật khẩu)</font></font></h3>

<ol>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký chịu trách nhiệm quản lý tên người dùng của chính họ và mật khẩu đăng nhập mà họ đã đặt.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành động được thực hiện bằng cách sử dụng tên người dùng và mật khẩu đăng nhập được coi là đã được thực hiện bởi người dùng đã đăng ký có tên người dùng và mật khẩu.</font></font></p></li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Địa chỉ email và các thông tin khác được đăng ký để lấy tên người dùng và mật khẩu đăng nhập của bạn phải chính xác và không áp dụng cho những điều sau:</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các biểu hiện bạo lực, gợi nhớ đến các thế lực chống đối xã hội hoặc các biểu hiện tình dục có thể xúc phạm đến trật tự công cộng và đạo đức</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bất kỳ điều gì có thể vi phạm quyền sở hữu trí tuệ của bên thứ ba</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Những người khác phù hợp với các mục trên</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tên người dùng và mật khẩu đăng nhập thuộc về người dùng đã đăng ký và không được phép chuyển nhượng hoặc cho mượn chúng cho một cá nhân, team hoặc tổ chức khác với tên tại thời điểm đăng ký.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký sẽ ngay lập tức liên hệ với chúng tôi nếu tên người dùng hoặc mật khẩu đăng nhập bị rò rỉ cho bên thứ ba, nếu nó được bên thứ ba sử dụng hoặc nếu có rủi ro về những điều này. </font><font style="vertical-align: inherit;">Ngoài ra, chúng tôi sẽ không chịu trách nhiệm về bất kỳ tổn thất hoặc thiệt hại nào gây ra bởi việc sử dụng tên người dùng hoặc mật khẩu đăng nhập không hợp lệ do hành động hoặc thiếu sót của người dùng đã đăng ký, và chúng tôi sẽ không bồi thường.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi người dùng đã đăng ký đăng ký dịch vụ này bằng ID của một dịch vụ bên ngoài, việc đăng ký và sử dụng ID đó, v.v. sẽ tuân theo các điều khoản của từng thỏa thuận do dịch vụ bên ngoài quy định và team sẽ chịu trách nhiệm về nội dung. không.</font></font></p></li>
</ol>


<h3>
<span id="第７条投稿内容の利用" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 5 (Sử dụng nội dung đã đăng)</font></font></h3>

<ol>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký cấp cho team quyền sử dụng nội dung đã đăng (bao gồm sao chép, sao chép, sửa đổi, cấp phép phụ cho bên thứ ba và tất cả các mục đích sử dụng khác) miễn phí. </font><font style="vertical-align: inherit;">Phạm vi của giấy phép bao gồm việc team cấp phép lại nội dung đã đăng cho những người dùng đã đăng ký khác thông qua dịch vụ này.</font></font></p></li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Team chúng tôi hoặc bên thứ ba được team ủy thác có thể sử dụng và xuất bản nội dung được đăng trên dịch vụ này trên team hoặc trang web của bên thứ ba. </font><font style="vertical-align: inherit;">Trong trường hợp này, team hoặc bên thứ ba được team ủy thác có thể thực hiện các hành vi sau đây.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi như tóm tắt, trích đoạn, thay đổi kích thước hoặc cắt bớt nội dung đã đăng</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hành động hiển thị tên người dùng và các mục đã đăng ký khác khi người dùng đã đăng ký đăng hoặc gửi</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký cho phép những người dùng đã đăng ký khác sử dụng mã, đoạn trích và các chương trình tương tự khác được đăng trên trang này miễn phí, bất kể chúng dành cho mục đích thương mại hay tư nhân và những người dùng đã đăng ký khác có thể sử dụng điều này.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Giấy phép của người dùng đã đăng ký trong mỗi đoạn trên sẽ không có bất kỳ hạn chế nào về khu vực, nghĩa vụ thông báo bản quyền hoặc các điều kiện ngẫu nhiên khác.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Team chúng tôi sẽ không chịu trách nhiệm về bất kỳ thiệt hại nào gây ra cho người dùng đã đăng ký đã đăng nội dung đã đăng do việc team, người dùng hoặc các bên thứ ba khác sử dụng nội dung đã đăng.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chúng tôi có thể tùy ý lưu nội dung đã đăng, và nếu chúng tôi thấy cần thiết (bao gồm nhưng không giới hạn các trường hợp vi phạm thỏa thuận này), chúng tôi sẽ được sự đồng ý của người đăng. Chúng tôi có thể xóa hoặc sửa đổi nội dung bài đã lưu mà không cần xin ý kiến.</font></font></p></li>
</ol>

<h3>
<span id="第８条投稿内容の著作権" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 6 (Bản quyền nội dung đã đăng)</font></font></h3>

<ol>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Về việc xử lý bản quyền, v.v. của nội dung đã đăng sẽ được quy định tại từng mục sau đây.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng có tất cả các quyền liên quan đến nội dung được ghi trong nội dung đã đăng (quyền sở hữu trí tuệ như quyền sáng chế, quyền nhãn hiệu, bản quyền, quyền riêng tư bao gồm thông tin cá nhân, quyền chân dung, v.v., team bảo mật và các quyền tài sản khác) hoặc đảm bảo rằng team có các giấy phép, quyền, sự đồng ý và cho phép cần thiết để sử dụng nội dung đã đăng theo mục 3 của phần này. </font><font style="vertical-align: inherit;">Trong trường hợp không chắc chắn xảy ra tranh chấp với bên thứ ba, vấn đề sẽ được giải quyết bằng chi phí và trách nhiệm của người dùng, và không gây bất tiện hoặc thiệt hại nào cho team.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các quyền được định nghĩa trong Điều 21-28 của Đạo luật Bản quyền được bảo lưu bởi người dùng hoặc bên thứ ba.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng có thể hiển thị, chỉnh sửa, sao chép, in lại, phân phối, truyền tải công khai, v.v. nội dung đã đăng cho team không độc quyền và nếu team xác định rằng nó hữu ích, nội dung đó sẽ được hiển thị theo giấy phép (có thể cấp phép lại và có thể chuyển nhượng giấy phép) để sử dụng (bao gồm cả trường hợp tạo và sử dụng các tác phẩm phái sinh như xuất bản, video, dịch thuật và đặt chỗ điện tử) là miễn phí.</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ngay cả khi chúng tôi hiển thị, chỉnh sửa, sao chép, in lại, phân phối, truyền tải công khai, v.v. nội dung đã đăng dựa trên giấy phép dựa trên mục 3 của đoạn trước, chúng tôi sẽ sử dụng tên người dùng và người dùng, do chính chúng tôi hoặc của một người thứ ba. Tên và tên xử lý, cũng như các tên và thông tin khác đại diện cho người dùng có thể được hiển thị hoặc có thể không được hiển thị.</font></font></p></li>

<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Team chúng tôi sẽ không chịu trách nhiệm về bất kỳ thiệt hại nào gây ra cho người dùng đã đăng ký hoặc bên thứ ba liên quan đến việc sử dụng nội dung đã đăng của team.</font></font></p></li>
</ol>

<h3><span id="第９条資格喪失後の投稿の取扱い" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 7 (Xử lý bài viết sau khi bị loại)</font></font></h3>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ngay cả sau khi người dùng đã đăng ký mất tư cách người dùng này, Chúng tôi vẫn có thể sử dụng nội dung của bài đăng.</font></font></p>


<h3><span id="第９条資格喪失後の投稿の取扱い" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 8 (Quảng cáo trên Rồng Vàng IT)</font></font></h3>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bạn không mất phí sử dụng dịch vụ Rồng Vàng IT. Thay vào đó, các doanh nghiệp và tổ chức sẽ phải trả tiền cho chúng tôi để hiển thị quảng cáo sản phẩm và dịch vụ của họ cho bạn. Khi sử dụng Sản phẩm của chúng tôi, bạn đồng ý để chúng tôi hiển thị quảng cáo mà chúng tôi cho rằng phù hợp với bạn cũng như sở thích của bạn.</font></font></p>


<h2>
<span id="第三章遵守事項禁止事項アカウント凍結削除等について" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chương 3: Các mục tuân thủ, các mục bị cấm, đóng băng / xóa tài khoản, v.v.</font></font></h2>

<h3>
<span id="第11条遵守すべき事項禁止事項" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 9 (Những vấn đề cần tuân thủ / Những điều cấm)</font></font></h3>

<ol>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký phải tuân thủ các yếu tố sau khi sử dụng dịch vụ này.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nhận biết rằng dịch vụ này là dịch vụ "ghi lại và chia sẻ kiến thức về kỹ sư" và đăng nội dung tương ứng.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tạo ra những bài viết có ý thức truyền tải, đồng thời cố gắng thể hiện chính xác nội dung bài viết trong tiêu đề và gắn thẻ bài viết, nhằm thúc đẩy việc ghi chép và chia sẻ kiến thức.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trừ khi có quy định khác trong thỏa thuận này hoặc được sự chấp thuận của team chúng tôi, không đăng các bài viết được đánh giá khách quan là nhằm mục đích quảng cáo hoặc bán hàng.</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu team chúng tôi xác định rằng người dùng đã đăng ký chưa tuân thủ các hành động được nêu trong đoạn trên, team có thể yêu cầu người dùng đã đăng ký sửa hoặc xóa nội dung đã đăng của bài viết có liên quan. </font><font style="vertical-align: inherit;">Trong trường hợp này, nếu người dùng không phản hồi việc chỉnh sửa hoặc xóa trong vòng 1 tuần kể từ khi yêu cầu từ chúng tôi, chúng tôi có thể đặt bài viết tương ứng ở chế độ riêng tư.</font></font></p></li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký không được vi phạm các luật sau đây khi sử dụng dịch vụ này.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi vi phạm quyền sở hữu trí tuệ như bản quyền và bằng sáng chế</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hành vi xâm phạm quyền chân dung và quyền công khai</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi xâm phạm quyền riêng tư</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hành vi vi phạm hoặc xâm phạm thông tin bí mật, thông tin cá nhân hoặc thông tin khác được bảo vệ bởi bên thứ ba</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nội dung phỉ báng, xúc phạm và các hành vi khác cản trở hoạt động kinh doanh của bên thứ ba</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Gian lận, hành động mở và vận hành một bài giảng trong chuỗi vô hạn hoặc hành vi gạ gẫm những hành vi này</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi vi phạm Đạo luật chống truy cập trái phép, các hành vi thuộc tội cản trở hoạt động kinh doanh như làm hỏng máy tính (Điều 234-2 BLHS), và các hành vi thực hiện các thao tác trái phép trên máy tính của team và những người khác.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hành vi tiết lộ thông tin vi phạm đạo đức, trật tự công cộng</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi khác liên quan đến tội phạm hoặc các hành vi vi phạm pháp luật và các quy định</font></font></li>
</ol>
</li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký không được tham gia vào các hành vi không phù hợp xã hội sau đây khi sử dụng dịch vụ này.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi có thể gây ra hoặc thúc đẩy tội phạm, chẳng hạn như thông báo tội phạm hoặc hướng dẫn tội phạm</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các biểu hiện phân biệt đối xử dựa trên chủng tộc, dân tộc, tín ngưỡng, giới tính, địa vị xã hội, nơi cư trú, đặc điểm thể chất, tiền sử bệnh tật, học vấn, tài sản và thu nhập, v.v.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi được coi là có vấn đề về mặt đạo đức theo quan điểm xã hội chung và các hành vi tiết lộ thông tin gây khó chịu cho bên thứ ba.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hành vi gây phiền nhiễu, hành vi quấy rối, hành vi tố cáo, hành vi gây thiệt hại về tinh thần hoặc tài chính cho bên thứ ba mà không có quyền lợi chính đáng</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Bạn có thể tự gọi mình là cá nhân, team hoặc nhóm khác với chính mình, sử dụng tên của team hoặc nhóm cụ thể mà không có thẩm quyền hoặc tự gọi mình là cá nhân, team hoặc nhóm hư cấu. Hành vi giả vờ có liên minh kinh doanh hoặc hợp tác với một tổ chức</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hành vi mạo danh bên thứ ba để sử dụng dịch vụ hoặc làm sai lệch thông tin</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ngoài các mục trước, các hành vi được coi là hành vi không phù hợp với xã hội tương tự như các hành vi này.</font></font></li>
</ol>
</li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ngoài hai điều khoản trên, người dùng đã đăng ký không được thực hiện các hành vi sau đây vi phạm các quy tắc hoặc mục đích của dịch vụ này, thỏa thuận này, khi sử dụng dịch vụ này.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hành vi đánh cắp, thu thập, tích lũy, thay đổi hoặc sử dụng thông tin cá nhân của người khác hoặc hành vi thao túng hoặc thay đổi trái phép thông tin cá nhân của một người hoặc thông tin của người dùng đã đăng ký khác.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hành động đặt thông báo đầu trang, chân trang, quảng cáo và thông báo bản quyền mà chúng tôi hiển thị theo tiêu chuẩn bằng cách thay đổi thiết kế trang trong dịch vụ này ở chế độ riêng tư mà không có sự cho phép của chúng tôi</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi chuyển hướng, bán hoặc bán lại dịch vụ này mà không có sự đồng ý của chúng tôi</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Về mặt khách quan, các hành vi được công nhận là gạ gẫm cho mục đích quảng cáo / khuyến mại hoặc thương mại (bao gồm nhưng không giới hạn ở hoạt động tối ưu hóa trang tìm kiếm hoặc đăng bài cho mục đích liên kết). </font><font style="vertical-align: inherit;">Tuy nhiên, điều này không áp dụng nếu team xác định riêng về dịch vụ này.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các hành vi khác vi phạm các quy định hoặc mục đích của dịch vụ này và thỏa thuận này</font></font></li>
</ol>
</li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu team xác định rằng người dùng đã đăng ký đã thực hiện các hành vi được quy định trong ba khoản trên, team có thể thực hiện các biện pháp sau theo phán quyết của team mà không cần thông báo trước. </font><font style="vertical-align: inherit;">Trong trường hợp này, ngay cả khi người dùng đã đăng ký bị thiệt hại, chúng tôi sẽ không bồi thường.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Riêng tư hoặc xóa bài viết có liên quan</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Đóng băng hoặc xóa tài khoản này của người dùng đã đăng ký</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ngay cả khi chúng tôi từ bỏ (dù rõ ràng hay ngụ ý) quyền của người dùng đã đăng ký vi phạm thỏa thuận này, điều đó không có nghĩa là từ bỏ quyền của người dùng đã đăng ký khác vi phạm thỏa thuận này.</font></font></p></li>
</ol>

<h3>
<span id="第12条本アカウントの凍結又は削除" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 10 (Đóng băng hoặc xóa tài khoản này)</font></font></h3>

<ol>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu chúng tôi xác định điều đó hoặc có thể có những lý do sau, chúng tôi có thể đóng băng hoặc xóa tài khoản của người dùng này.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi thông tin tại thời điểm đăng ký hoặc thông tin sau khi đăng ký là không chính xác.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi tên người dùng và mật khẩu đăng nhập bị sử dụng bất hợp pháp.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi thông tin được cung cấp bởi dịch vụ này được sử dụng một cách bất hợp pháp.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi việc sử dụng bị hủy bỏ trong các dịch vụ khác của team chúng tôi có thể được sử dụng bằng cách sử dụng tên người dùng và mật khẩu đăng nhập.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi vi phạm các điều ghi trong điều khoản 8.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi có một lý do hợp lý nhằm chấm dứt việc sử dụng của người dùng.</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu người dùng đã đăng ký bị đóng băng hoặc xóa tài khoản này, họ sẽ không thể sử dụng các dịch vụ khác có thể được sử dụng bằng tài khoản này.</font></font></p></li>
</ol>

<h2>
<span id="第四章本サービスの提供について" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chương 4: Cung cấp dịch vụ này</font></font></h2>

<h3>
<span id="第13条本サービスの変更中断終了" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 11 (Thay đổi / gián đoạn / chấm dứt dịch vụ này)</font></font></h3>

<ol>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi chúng tôi thay đổi nội dung của dịch vụ này, chúng tôi sẽ thông báo cho bạn bằng phương thức đăng nội dung thay đổi trên blog chính thức của chúng tôi, v.v.</font></font></p></li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">team có thể tạm ngừng dịch vụ này mà không cần thông báo trước trong trường hợp có bất kỳ lý do nào sau đây.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi team chúng tôi gặp trục trặc bất ngờ về hệ thống máy chủ.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi thực hiện bảo trì hoặc sửa chữa liên quan đến dịch vụ này, bất kể đó là phản ứng thường xuyên hay khẩn cấp.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi việc cung cấp dịch vụ này trở nên khó khăn do dịch bệnh như thiên tai, hỏa hoạn, mất điện, tai nạn, bệnh truyền nhiễm.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ngoài ra, khi phù hợp với từng mục trước.</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chúng tôi có thể chấm dứt dịch vụ này với thời gian thông báo tối thiểu là 10 ngày. </font><font style="vertical-align: inherit;">Chúng tôi sẽ thông báo cho bạn về việc chấm dứt dịch vụ này bằng cách đăng nó trên blog chính thức của chúng tôi hoặc bằng cách thông báo cho bạn về dịch vụ này.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">team sẽ không chịu trách nhiệm về bất kỳ thiệt hại nào gây ra cho người dùng đã đăng ký liên quan đến việc thay đổi, gián đoạn hoặc chấm dứt dịch vụ này theo ba đoạn trên.</font></font></p></li>
</ol>

<h3>
<span id="第14条ユーザーによる本サービスの終了" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 12 (Người dùng chấm dứt dịch vụ này)</font></font></h3>

<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký có thể chấm dứt việc sử dụng dịch vụ này theo quyết định riêng của họ. </font><font style="vertical-align: inherit;">Người dùng đã đăng ký phải thông báo cho team theo thủ tục rút tiền do team thiết lập.</font></font></p>

<h3>
<span id="第15条免責条項" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 13 (Tuyên bố từ chối trách nhiệm)</font></font></h3>

<ol>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký phải chuẩn bị, cài đặt và vận hành hợp lý thiết bị, phần mềm và phương tiện liên lạc để truy cập Internet cần thiết cho việc sử dụng dịch vụ này bằng trách nhiệm và chi phí của riêng họ. </font><font style="vertical-align: inherit;">Chúng tôi không tham gia vào môi trường truy cập của người dùng đã đăng ký và không chịu trách nhiệm về việc chuẩn bị và vận hành của họ.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Khi liên hệ với người dùng đã đăng ký, chúng tôi có thể liên hệ với bạn bằng e-mail được gửi đến địa chỉ e-mail đã đăng ký. </font><font style="vertical-align: inherit;">Người dùng đã đăng ký phải duy trì thông tin địa chỉ e-mail đã đăng ký một cách chính xác để họ có thể nhận e-mail từ chúng tôi, và nếu vì lý do nào đó mà họ không thể nhận e-mail, họ sẽ nhanh chóng thay đổi địa chỉ e-mail của mình. </font><font style="vertical-align: inherit;">Chúng tôi sẽ không chịu trách nhiệm nếu người dùng đã đăng ký gặp bất lợi do không thể nhận được liên hệ từ chúng tôi do không thể thay đổi hoặc đặt địa chỉ email.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trách nhiệm đối với tất cả thông tin được tiết lộ bởi người dùng đã đăng ký trên dịch vụ này, bao gồm văn bản, mã, đoạn trích, âm thanh, video, hình ảnh và thông tin kèm theo hình ảnh, thuộc về người đã đăng ký tiết lộ thông tin. </font><font style="vertical-align: inherit;">Chúng tôi không chịu trách nhiệm về nội dung thông tin do người dùng đã đăng ký trong dịch vụ tiết lộ.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu người dùng đã đăng ký làm tổn hại đến danh dự của người khác, xâm phạm quyền riêng tư, vi phạm luật bản quyền hoặc xâm phạm quyền của người khác theo bất kỳ cách nào khác thì người dùng đã đăng ký phải tự chịu trách nhiệm.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu người dùng đã đăng ký gặp bất lợi khi đăng, nhận xét hoặc sử dụng chương trình trên dịch vụ này bởi một người dùng đã đăng ký khác, người dùng đã đăng ký sử dụng những điều này sẽ phải chịu trách nhiệm và team sẽ chịu mọi trách nhiệm không.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nếu bên thứ ba tuyên bố rằng đã bị bất tiện do thông tin được tiết lộ bởi người dùng đã đăng ký xuất hiện, người dùng đã đăng ký sẽ tự giải quyết vấn đề này bằng rủi ro và chi phí của mình, và team sẽ không chịu trách nhiệm ...</font></font></p></li>
</ol>

<h3>
<span id="第16条不保証" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 14 (không đảm bảo)</font></font></h3>

<ol>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Do đặc điểm của dịch vụ này là một trang cộng đồng nên chúng tôi sẽ cung cấp dịch vụ này như hiện tại.</font></font></p></li>
<li>
<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chúng tôi không đảm bảo các nội dung sau đây.</font></font></p>

<ol>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dịch vụ này thích ứng với môi trường sử dụng của người dùng đã đăng ký và hoạt động bình thường.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nội dung dịch vụ của dịch vụ này đáp ứng hoặc có lợi cho các yêu cầu của người dùng đã đăng ký.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thông tin do chúng tôi hoặc những người dùng đã đăng ký khác cung cấp trong dịch vụ này là chính xác, thích hợp, hợp lệ, cập nhật, hợp pháp hoặc đầy đủ.</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Việc cung cấp dịch vụ này là ngay lập tức hoặc an toàn</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Không có khiếm khuyết trong dịch vụ này</font></font></li>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các thông tin khác nhau hoặc nội dung đã đăng được đăng ký hoặc đăng tải bởi người dùng đã đăng ký sẽ không bị mất thông qua dịch vụ này.</font></font></li>
</ol>
</li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký sẽ tự chịu rủi ro khi sử dụng dịch vụ này và người dùng đã đăng ký phải chịu trách nhiệm về tất cả các hành động được thực hiện liên quan đến việc sử dụng dịch vụ này và kết quả của nó.</font></font></p></li>
</ol>

<h2>
<span id="第五章一般条項" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chương 5: Quy định chung</font></font></h2>

<span id="第18条本サービス提供に関わる知的財産権" class="fragment"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Điều 15 (Quyền sở hữu trí tuệ liên quan đến việc cung cấp dịch vụ này)</font></font></h3>

<ol>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Trừ khi được chỉ định khác, tất cả các chương trình, phần mềm, nhãn hiệu, tên thương mại hoặc quyền sở hữu trí tuệ và các quyền khác liên quan đến chúng tạo nên dịch vụ này và các máy chủ mà chúng tôi sử dụng để cung cấp dịch vụ này sẽ là team của chúng tôi. Hoặc nó thuộc về bên thứ ba người có thẩm quyền hợp pháp để cấp phép sử dụng cho team của chúng tôi.</font></font></p></li>
<li><p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Người dùng đã đăng ký không được sao chép, xuất bản, phát sóng, truyền tải công khai hoặc sử dụng các quyền sở hữu trí tuệ của team hoặc bên thứ ba ngoài phạm vi sử dụng cá nhân mà không có sự cho phép trước và rõ ràng ...</font></font></p></li>
</ol>

</ol>

<hr>

<ul>
<li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thành lập ngày 15 tháng 4 năm 2022</font></font></li>

<!-- <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sửa đổi vào ngày tháng  năm </font></font></li> -->
</ul>

<p>
<!-- end conttent -->

                   </div>
                </div>

 
            </div>
        </div>
    </div>
</div>

@include("common::Elements.scripts")
<script src="/js/common.js"></script>