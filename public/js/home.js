$(document).on("click",".css-ctagr span",function(s){let a=$(this);$(".css-ctagr span").each(function(s,t){a[0].title==t.title?($(t).removeClass("css-tazpgo"),$(t).addClass("css-ir22sg")):($(t).removeClass("css-ir22sg"),$(t).addClass("css-tazpgo"))});var t={time:a.html()};$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",url:"tagsRank",dataType:"json",data:t}).done(function(s,a,t){$("#css-ctagr").empty(),$gold="css-12okroa",$silver="css-1gbdfdf",$cu="css-wkj968",s.timely.forEach(function(s,a){0==a?_class=$gold:1==a?_class=$silver:2==a&&(_class=$cu),tempHtml='<a href="/tags/'+s.tag_name+'" class="css-1f7jh9e"><div class="css-16lfj6j"><div class="css-fv3lde"><div class="css-a6vk0a">',tempHtml+=a<3?'<span class="fa fa-fw fa-trophy '+_class+'"></span>':"<span>"+(a+1)+"</span>",error="onerror=\"this.src = '/images/utils/noimage.png' ;\"",tempHtml+="</div><img "+error+'  src="'+s.tag_img+'" alt="'+s.tag_name+'" class="css-3xss53"><div class="css-1038633">'+s.tag_name+'</div></div><p class="css-1xfnzth"><span class="css-1ex04uq">'+s.count_post+"</span>bài viết</p></div></a>",$("#css-ctagr").append(tempHtml)})}).fail(function(s,a,t){})}),$(document).on("click",".css-cuserr span",function(s){let a=$(this);$(".css-cuserr span").each(function(s,t){a[0].title==t.title?($(t).removeClass("css-tazpgo"),$(t).addClass("css-ir22sg")):($(t).removeClass("css-ir22sg"),$(t).addClass("css-tazpgo"))}),window.location.href.indexOf("tags")>-1?db="/usersRankTag":db="usersRank";var t={time:a.html(),tag_name:$(".css-j6hlwq").html()};$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",url:db,dataType:"json",data:t}).done(function(s,a,t){$("#css-cuserr").empty(),$gold="css-12okroa",$silver="css-1gbdfdf",$cu="css-wkj968",s.timely.forEach(function(s,a){0==a?_class=$gold:1==a?_class=$silver:2==a&&(_class=$cu),error="onerror=\"this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1' ;\"",tempHtml='<a href="/'+s.username+'" class="css-1f7jh9e"><div class="css-16lfj6j"><div class="css-fv3lde"><div class="css-a6vk0a">',tempHtml+=a<3?'<span class="fa fa-fw fa-trophy '+_class+'"></span>':"<span>"+(a+1)+"</span>",tempHtml+="</div><img "+error+' loading="lazy" src="/storage/'+s.profile_photo_path+'" alt="'+s.username+'" class="css-q7jbwd"><div><div class="css-19ideir">'+s.username+'</div><div class="css-1k7xnbo">@'+s.username+' </div></div></div><span class="css-1p4jp1c"><span class="css-17vnfqt">'+s.contribution+"</span>điểm cống hiến</span> </div></a>",$("#css-cuserr").append(tempHtml)})}).fail(function(s,a,t){})}),$(document).on("click",".css-1fcd6q4 button",function(s){let a=$(this);if(!a.hasClass("authbtn")){srv_act=a.hasClass("css-hvs9iy")?"add":"del";var t={"srv-tgi":a.attr("data-tagid"),"srv-act":srv_act};$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",url:"/tagfollow",dataType:"json",data:t}).done(function(s,t,e){"add"==srv_act?(a.removeClass("css-hvs9iy"),a.addClass("css-hn90qn"),a.html("Đang theo dõi")):"del"==srv_act&&(a.removeClass("css-hn90qn"),a.addClass("css-hvs9iy"),a.html("Theo dõi"))}).fail(function(s,a,t){})}}),$(document).on("mouseenter","button.css-hn90qn",function(){$(this).html("Bỏ theo dõi")}),$(document).on("mouseleave","button.css-hn90qn",function(){$(this).html("Đang theo dõi")}),$(document).on("click",".css-2imjyh a",function(s){let a=$(this);a.removeClass("css-17f4hjb"),a.addClass("css-ls5mct"),a.next().removeClass("css-ls5mct"),a.next().addClass("css-17f4hjb"),a.prev().removeClass("css-ls5mct"),a.prev().addClass("css-17f4hjb"),window.location.href.indexOf("tags")>-1?db="/tag_quest":window.location.href.indexOf("timeline")>-1?db="/timeline_quest":window.location.href.indexOf("user")>-1&&(db="/user_quest");var t={tag_name:$(".css-j6hlwq").html(),typepage:a[0].title};$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",url:window.location.href+db,dataType:"html",data:t}).done(function(s,a,t){$(".tagpostquest").empty().html(s)}).fail(function(s,a,t){})});