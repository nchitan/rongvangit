## Lấy first chilrd trong each từ this

```js
element.children(":first").toggleClass("redClass");
```

## Xoá disable trong class
```js
$(".css-1ha05ki").removeAttr("disabled")
```

## Thêm html vào element
```js
$('.css-19midj6').empty();
        tmpHtml ='<button type="button" class="css-1mteic8"><span class="fa fa-plus fa-fw css-45hdgn"></span><div class="css-6ozust">カテゴリーの新規作成</div></button>';
        $('.css-19midj6').append(tmpHtml);
```

## Check khi xảy ra even
```js
    $(document).on('click','button.css-1ha05ki', function(){

        });
```

## Kiểm tra disable hay ko
```js
$('#anchorID').prop("disabled");
```

## Them xoa disable
```js
    $(document).on('click', '.css-1elw6c9 span',function(e){
        
        child = $(".css-1elw6c9").children()

        child.each(function( index , value) {
           if($(value).children(":first").hasClass('fa-check-square')){
                $(".css-b1sfia").removeAttr("disabled")
                return false
           }else{
                $(".css-b1sfia").attr("disabled","disabled")
           }
        });
    }); 

```

## Kiem tra mot button voi class chi dinh
```js
    $(document).on('click','button.css-b1sfia', function(){

    });
```


## Tao ajax
```js
var postData = {
                            'username': login_username,
                            'type' : type,
                            'item':item,
                            'check':check,
                        };

        $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url:  '/like',
                dataType: 'json',
                data: postData,
         }).done(function (data, textStatus, jqXHR) {

        }).fail(function (data, textStatus, xhr) {

        });

```
## Lấy last element lấy từ tên classname
```js
a= $(".css-1q0wz2m:last")

Without jQuery:

var divs = document.getElementById("test").getElementsByTagName("div");
var lastChild = divs[divs.length - 1];
```



## THêm html vào trước hay sau





## Tao time tu string lay tu db
```js
let d = new Date(data['comment']['created_at']);

var h = ("0"+d.getHours()).slice(-2);
var m = ("0"+d.getMinutes()).slice(-2);
var s = ("0"+d.getSeconds()).slice(-2);


let year = d.getFullYear();
let month = d.getMonth() + 1; //月が代入される
let day = d.getDate()

let created_day= year+"-"+ month+"-"+day+" "+h+":"+m

```


## join 
```sql
select * from categories
LEFT JOIN user_stocks on user_stocks.username = categories.username
and user_stocks.item = 'b2c0d1j0i0d5a'
where categories.username = 'kiyoshi'
ORDER BY categories.username
```

## Lấy value của check option
```js
    $('.css-1rqmung').change(function() {
    var r = $('option:selected').val();
    
    console.log(r);
})
```

## Kiem tra chart trong string
```js
        if (window.location.href.indexOf('posts') > -1)
        {
          db = '/commentPost'
        }else{
          db = '/answearQuestion'
        }
        ```


## So sanh voi so 0
Trong sql không so sánh với số 0. thay vào đó dùng Not null
```sql
WHERE count_answear IS NULL
```
bad:
```sql
WHERE count_answear = 0
```



## Cách click ngoài model và đóng model
```sql
$(".open").on("click", function(e) { //with event now
    e.stopPropagation(); //stopping propagation here
    var modalId = $(this).data("modal");
    var $modal = $("#" + modalId);
    $modal.show();
});
```

Mở moal
Key là thêm stipProgation
```sql
$(document).on('click', '.st-NewHeader_buttonWrapper img', function(e){
e.stopPropagation();


    $('.st-NewHeader').addClass('is-dropdown-open')
    var div = $(this).parent('').next().addClass('is-open right')
    

});
```

Đóng modal
```sql
$(document).on('click',function(e){
    console.log(e.target.closest('.st-NewHeader_dropdown'))

   if (e.target.closest('.st-NewHeader_dropdown') == null) {
        $('.st-NewHeader').removeClass('is-dropdown-open')
        $('.st-NewHeader_dropdown').removeClass('is-open right')
   }
});
```


## So sánh với null
```sql
if (e.target.closest('.st-NewHeader_dropdown') == null) {
```


## focus va dich chuyen man hinh
```javascript
$(this).parent().last()[0].scrollIntoView(true)
```

## Them child vao cuoi 
```sql
$(this).parent().append(tmpHtml1)
```

## Lay child dau tien cuar parent
```sql
$(this).parent().children(':first-child').addClass('fa-folder-open')
```

## upload file bang jquerry
```javascript
$('#image').trigger('click')

$('#image').on('change', function (e) {
    $('#upload_image').submit(function(event) {
     
        event.preventDefault();
       
        $.ajax({
            url: '/save',
            type: 'POST',
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data, status)
            {
                 console.log("done");
                 $('#upload_image')[0].reset();

            },
            error: function (xhr, desc, err)
            {
                console.log("error");

            }
        }); 
    });

}); 

$('#upload_image').submit()
```

## Ajax bi chay nhieu lan khi up anh
https://www.koikikukan.com/archives/2013/12/11-015555.php

```javascript
$(function(){
    var jqxhr;
    $('#execute').click(function(){
        if (jqxhr) {
            return;
        }
        jqxhr = $.ajax({
```