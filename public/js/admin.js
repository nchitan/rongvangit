//ban user
$(document).on('click', 'button.css-user', function (event) {
    let el = $(this); 
    if(el.hasClass('authbtn')) return
    srv_act = el.hasClass('activeuser') ? "add": "del"  
    
    var res = confirm("Bạn có chắc chắn cấm người dùng này không?");
        if( res == true ) {

            var postData = {
                                'srv-at':$(this).attr('data-at'),
                                'srv-act':srv_act
                            } 


            console.log(postData)
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url:  '/admin/banUser' ,
                    dataType: 'json',
                    data: postData,
             }).done(function (data, textStatus, jqXHR) {

                if(srv_act =='add'){
                el.removeClass('activeuser')
                el.addClass('deactiveuser')
                el.html('Deactivate')

                }else if(srv_act =='del'){
                el.removeClass('deactiveuser')
                el.addClass('activeuser')
                el.html('Activate')            
                }

            }).fail(function (data, textStatus, xhr) {
              console.log(data.status)
              console.log(textStatus)
            })
        }else{
            return
        }
})

//ban post
$(document).on('click', 'button.css-post', function (event) {
    let el = $(this); 
    if(el.hasClass('authbtn')) return
    srv_act = el.hasClass('activatepost') ? "add": "del"  
    console.log('clicked')
    
    var res = confirm("Bạn có chắc chắn xoá bài viết này không? Bài viết sẽ không thể phục hồi");
        if( res == true ) {

            var postData = {
                                'srv-at':$(this).attr('data-at'),
                                'srv-act':srv_act
                            } 


            console.log(postData)
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url:  '/admin/banItem' ,
                    dataType: 'json',
                    data: postData,
             }).done(function (data, textStatus, jqXHR) {

                if(srv_act =='add'){
                el.removeClass('activatepost')
                el.addClass('deactivepost')
                el.html('Deactivate')

                }else if(srv_act =='del'){
                el.removeClass('deactivepost')
                el.addClass('activatepost')
                el.html('Activate')            
                }

            }).fail(function (data, textStatus, xhr) {
              console.log(data.status)
              console.log(textStatus)
            })
        }else{
            return
        }
})

$(document).on('mouseenter', 'button.activatepost', function(){

    $(this).html('Ẩn Item')
});
//ツールチップを隠れる処理
$(document).on('mouseleave', 'button.activatepost', function(){
    $(this).html('Activate')
});