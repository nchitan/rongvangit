$(document).ready(function(){$(document).on("click",".st-NewHeader_buttonWrapper .st-NewHeader_loginUser",function(e){if(e.stopPropagation(),$(".st-NewHeader").hasClass("is-dropdown-open"))$(".st-NewHeader").removeClass("is-dropdown-open"),$(".st-NewHeader_dropdown").removeClass("is-open right");else{$(".st-NewHeader").addClass("is-dropdown-open");$(this).next().addClass("is-open right")}}),$(document).on("click",".st-NewHeader_buttonWrapper .st-NewHeader_postButton",function(e){if(e.stopPropagation(),$(".st-NewHeader").hasClass("is-dropdown-open"))$(".st-NewHeader").removeClass("is-dropdown-open"),$(".st-NewHeader_dropdown").removeClass("is-open right");else{$(".st-NewHeader").addClass("is-dropdown-open");$(this).next().addClass("is-open right")}}),$(document).on("click",function(e){null!=e.target.closest(".st-NewHeader_dropdown")&&null!=e.target.closest(".st-NewHeader_buttonWrapper")||($(".st-NewHeader").removeClass("is-dropdown-open"),$(".st-NewHeader_dropdown").removeClass("is-open right"),$(".st-NewHeader_notiIframe").removeClass("is-open"))}),$(document).on("click",".st-NewHeader_buttonWrapper span",function(e){e.stopPropagation(),$(".st-NewHeader").hasClass("is-dropdown-open")?($(".st-NewHeader").removeClass("is-dropdown-open"),$(".st-NewHeader_notiIframe").removeClass("is-open right")):($(".st-NewHeader").addClass("is-dropdown-open"),$(".st-NewHeader_notiIframe").addClass("is-open"))})}),$(document).on("click","button.css-follow",function(e){let t=$(this);if(!t.hasClass("authbtn")){srv_act=t.hasClass("css-10keyvc")?"add":"del";var s={"srv-at":$(this).attr("data-at"),"srv-act":srv_act};$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",url:"/follow",dataType:"json",data:s}).done(function(e,s,o){"add"==srv_act?(t.removeClass("css-10keyvc"),t.addClass("css-1pacd3k"),t.html("Đang theo dõi")):"del"==srv_act&&(t.removeClass("css-1pacd3k"),t.addClass("css-10keyvc"),t.html("Theo dõi"))}).fail(function(e,t,s){})}}),$(document).on("mouseenter","button.css-1pacd3k",function(){$(this).html("Bỏ theo dõi")}),$(document).on("mouseleave","button.css-1pacd3k",function(){$(this).html("Đang theo dõi")}),$(document).on("click",".authbtn",function(e){$(".st-Modal-login")&&$(".st-Modal-login").addClass("is-open")}),$(document).on("click",".css-yh67nw",function(e){$(".st-Modal-login").removeClass("is-open")}),$(document).on("click",".st-Modal_backdrop",function(e){$(".st-Modal").removeClass("is-open")}),$(document).on("click","#reportuser .st-Form input",function(e){n=0,$("input[type=checkbox]").each(function(){$(this).is(":checked")&&(n+=1)}),n>0?$(".css-qgrf2v2").removeAttr("disabled"):$(".css-qgrf2v2").prop("disabled",!0)}),$(document).on("click","#reportuser button.css-qgrf2v2",function(e){var t;$("#reportuser").submit(function(e){if(e.preventDefault(),t)return;const s=[];$("input[type=checkbox]").each(function(){$(this).is(":checked")&&s.push($(this).val())}),data=JSON.stringify(s);var o={reported_id:$('input[name="reported_id"]').val(),item_type:$('input[name="item_type"]').val(),item_id:$('input[name="item_id"]').val(),data:data};t=$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",url:"/report",dataType:"json",data:o}).done(function(e,t,s){$(".st-Modal").removeClass("is-open"),alert("Cảm ơn bạn đã cùng xây dựng trang web. Nội dung report đã được gửi đến admin.")}).fail(function(e,t,s){$(".st-Modal").removeClass("is-open"),alert("Cảm ơn bạn đã cùng xây dựng trang web. Nội dung report đã được gửi đến admin.")})}),$("#reportuser").submit()});