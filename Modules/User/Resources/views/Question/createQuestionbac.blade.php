@extends('user::layouts.createMaster')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



{{--@include("user::markdown.editor")--}}

<div class="css-1rnpb4k esnipul0">


        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
            Session::forget('success');
            @endphp
        </div>
        @endif


    <div class="css-1qlva0w e1yvkzip0">
        <div class="css-xgff9b ect7rag0">
            <select tabindex="10" class="css-1rqmung ect7rag1">
                <option value="NOT_SET" disabled="" selected="">Chọn kiểu</option>
                <option value="Q&A">Q&amp;A</option>
                <option value="Thảo luận">Thảo luận</option>
            </select></div>

        <div class="css-8atqhb e6f32tx0">
            <div class="css-avt099 e1aqgsb40"><input type="text" required onchange="check()" id="title" placeholder="Nhập Title" tabindex="20" class="css-12fqrnh e1aqgsb41">
               


                <div class="css-axyh e1aqgsb43">Chưa đăng</div></div>
        </div>

    </div>

    <div class="css-kav51v ed5758y0">
        <div class="textoverlay-backdrop" style="box-sizing: border-box; position: absolute; margin: 0px; background: none 0% 0% / auto repeat scroll padding-box border-box rgb(255, 255, 255); background-blend-mode: normal; z-index: -2; left: 0px; top: 109px; height: 33px; width: 1090px;">
            
        </div>
        <div class="textoverlay" style="box-sizing: border-box; border-color: transparent; border-style: solid; color: transparent; position: absolute; white-space: pre-wrap; overflow-wrap: break-word; overflow: hidden; margin: 0px; font-family: Arial; font-size: 14px; font-weight: 400; line-height: 20px; padding: 6px 12px; border-width: 1.25px; z-index: -1; left: 0px; top: 109px; height: 33px; width: 1090px;">
            <div class="textoverlay-positioner" style="display: block; margin-top: 0px;"></div>
        </div>
           <!--  <input id="taglist" autocomplete="off" data-role="tagsinput" placeholder="Nhập tối đa 5 Tag liên quan đến kiến thức được phân tách bằng dấu cách (ví dụ: Ruby Rails)"> -->

        <div class="search-input" style="position: absolute;">
            <input type="hidden" name="curPage" id="curPage" value="1">
            <input type="hidden" name="oldSearchKey" id="oldSearchKey" value="{{ $searchKey ?? '' }}">

            <input  id="tags" required placeholder="Nhập tối đa 5 Tag" name="tags" type="text" data-role="tagsinput" value="" >
        </div>
        <!-- <div class="search-suggest" style="left: 3px;"></div>  -->
        <!-- <div class="search-suggest" style="z-index: 1000; left: 77px; top: 142.969px; bottom: auto;"></div>    -->
            

            <datalist id="mylist">
    


            <!-- <input class="form-control" type="text" data-role="tagsinput" name="tags" style="display: none;">


            <input autocomplete="off" placeholder="Nhập tối đa 5 Tag liên quan đến kiến thức được phân tách bằng dấu cách (ví dụ: Ruby Rails)" tabindex="30" type="text" class="css-19fi7g8 ed5758y1" value="" style="background: transparent;"> -->

    </div>

    <div class="css-8atqhb e1jnj1zp0">
        <div class="css-7pf6at">
            <div class="css-d7a9tj">
                <div class="css-12sjer6">
                    <div class="css-70qvj9">
                        <a class="css-2on3xo">Nội dung</a>
                        <a href="https://help.dekita.com/ja/articles/dekita-question-guideline" target="_blank" class="css-16t3sp6"><div style="display: flex; align-items: center;"><i class="fa fa-book"></i><div style="margin-left: 4px;">Mẫu viết</div></div></a></div><div class="css-1opalb8"><div class="css-1ioylok"><div class=""><i class="fa fa-picture-o"></i><input type="file" style="display: none;"></div></div><div class="css-1ioylok"><div class=""><i class="fa fa-fw fa-smile-o"></i></div></div><div class="css-1ioylok"><a href="https://dekita.com/dekita/posts/c686397e4a0f4f11683d" target="_blank" class=""><i class="fa fa-question-circle" style="color: rgba(0, 0, 0, 0.38);"></i></a></div></div>
                </div>

            
                <div class="css-8atqhb">



<textarea id="editor" required placeholder="Viết và đặt câu hỏi về những gì bạn quan tâm bằng Markdown" tabindex="40" class="css-7zdr9h"  style="overflow: auto; overflow-wrap: break-word; height: 907px;"></textarea>


                @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
                @endif

                </div>

            </div>
            
            <div class="css-1hgsvpo">

                <div class="css-2eqgic">
                    <div class="css-17vefrj"><i class="fa fa-angle-left"></i></div>
                    <div class="css-17vefrj"><i class="fa fa-angle-right"></i></div>
                    <div style="margin: 0px 8px;">Preview</div>
                    

                </div>

                <div class="css-18cl16w">

                    <div class="qa-MdContent it-MdContent">
                        

                        <div id="result">
<!--                             <h2 id="-">Vấn đề</h2>
                        <p>Ghi nội dung vấn đề gặp phải</p>
                        <p>Ví dụ
                        Tôi đang phát triền phần mềm và gặp lỗi, xin hãy giải đáp giùm tôi</p>
                        <h3 id="-">Lỗi phát sinh</h3>
                        <pre><code class=" hljs ">Nhập nội dung lỗi
                        </code></pre><p>Ví dụ</p>
                        <pre><code class=" hljs livecodeserver">NameError (uninitialized <span class="hljs-built_in">constant</span> World)
                        </code></pre><p>Nếu có ảnh lỗi, hãy upload vào đây.</p>
                        <h3 id="-">Source code</h3>
                        <pre><code class="言語名 hljs ">Nhập code vào đây.
                        </code></pre>
                        <p>Ví dụ</p>
                        <pre><code class="ruby hljs "><span class="hljs-function"><span class="hljs-keyword">def</span> </span>greet
                        puts <span class="hljs-constant">Hello</span> <span class="hljs-constant">World</span>
                        <span class="hljs-keyword">end</span>
                        </code></pre>
                        <h3 id="-">Các cách bạn đã thử</h3>
                        <p>Hãy viết các cách bạn đã thử để giải quyết vấn đề tại đây.</p> -->

                        </div> 

                    </div>

                </div>
                
            </div>
            
        </div>

    </div>

    <div class="css-132bea0 eiw8gvr0">
        <div class="css-eo3p0i eob0bxe0">
            <div class="css-dboe1v eob0bxe1"></div>
            <div class="css-1isemmb eob0bxe2">
                <div class="css-jma0kd e9bkwgs0">
<!--                     <button type="button" class="e9bkwgs1 css-12bjd4k e1rb7ucl0" font-size="14" tabindex="50"><i class="fa fa-upload"></i>dekita に投稿</button>
                    <button class="e9bkwgs2 css-9sl1qj e1rb7ucl0" font-size="14" tabindex="51"><i class="fa fa-caret-up"></i></button>

                    <ul class="css-qpf9dh e9bkwgs3"><li><a href="#" tabindex="52" class="css-1f50gip e9bkwgs4"><i class="fa fa-check"></i><i class="fa fa-save"></i>下書き保存</a></li><li><a href="#" tabindex="53" class="css-18si6nk e9bkwgs4"><i class="fa fa-check"></i><i class="fa fa-upload"></i>dekita に投稿</a></li></ul> -->




<!--                      <div class="d-grid">
                 <button id="clickDraft" class="btn btn-info btn-submit" style="margin-right: 10px;">Lưu nháp</button>
            </div> -->

                    <div class="d-grid">
         <button id="clickPost" type="button" class="btn btn-info btn-submit" onclick="save();">Lưu nháp</button>
            </div>

                    <div class="d-grid">
         <button id="clickPost" type="button" class="btn btn-info btn-submit" onclick="publish();">Đăng bài</button>
            </div>


                    

                </div>

            </div>
        </div>
        
    </div>

</div>

<?php
        $str =$user_id.date('y').date('m').date('d').date('h').date('m').date('s');
        $text =  str_split(strval($str ));
        $item = '';
        foreach ($text as $key => $value){
            if($key%2 == 0){
                $item.=chr(intval($value)+97);
            }else{
                $item.=$value;
            }
        }  
echo '<form id="saveForm" method="POST" action="/drafts_questions/news/'.$item.'/edit">';
?>
    {{ csrf_field() }}
<input type="hidden" name="title" value="">
<input type="hidden" name="post-format" value="">
<input type="hidden" name="tags" value="">
<input type="hidden" name="content" value="">
</form>


<?php 

echo '<form id="publishForm" method="POST" action="/'.$username.'/questions/'.$item.'">';
?>
    {{ csrf_field() }}
<input type="hidden" name="title" value="">
<input type="hidden" name="type" value="">
<input type="hidden" name="tags" value="">
<input type="hidden" name="content" value="">
<?php echo '<input type="hidden" name="item" value="'.$item.'">
</form>';?>


<script type="text/javascript">
   ;
    // $('.css-1rqmung').change(function() {
    // //var question-format = $('option:selected').val();
    
    
    // })





function publish(){
    $tag =[];
    $(".tag span").each(function(element){
        $tag.push( $(this).text().replace(/\s/g, ''));
    });
    var question_type = $('option:selected').val();

    document.forms["publishForm"].title.value =document.getElementById('title').value;
    document.forms["publishForm"].content.value = $("#result").prop("outerHTML");
    document.forms["publishForm"].tags.value =$tag.join(',');
    document.forms["publishForm"].type.value =question_type;
    document.forms["publishForm"].submit();
}

function save(){
    $tag =[];
        $(".tag span").each(function(element){
            $tag.push( $(this).text().replace(/\s/g, ''));
        });
    var question_type = $('option:selected').val();
    document.forms["publishForm"].title.value =document.getElementById('title').value;
    document.forms["publishForm"].content.value = $("#result").prop("outerHTML");
    document.forms["publishForm"].tags.value =$tag.join(',');
    document.forms["publishForm"].type.value =question_type;
}

function check(){
    //console.log(document.getElementById('title').value);
  }

$('#tags').tagsInput();
// console.log($('#tags'));

// delimiter= ',';


// var tagslist = $('#tags_tagsinput').val().split(delimiter['tags']);
// console.log("val",tagslist);

// if ($('#tags').tagExist('ab')) { console.log("have")}


</script>
@endsection