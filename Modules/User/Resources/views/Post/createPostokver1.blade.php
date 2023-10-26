@extends('user::layouts.master')

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

        <div class="css-8atqhb e6f32tx0">
            <div class="css-avt099 e1aqgsb40"><input type="text" required onchange="check()" id="title" placeholder="Nhập Title" tabindex="20" class="css-12fqrnh e1aqgsb41" value="{{ old('title') }}">
               
               


                <div class="css-axyh e1aqgsb43">Chưa đăng</div></div>
        </div>

    </div>

<div class="f-container">
  <div class="f-item01">@include("user::Elements.tagSuggest") </div>
  <div class="f-item02">
    <div class="f-item03">
        <div class="switchArea">
          <input type="checkbox" checked id="switch1">
          <label for="switch1"><span></span></label>
          <div id="swImg"></div>
        </div>
    </div>    
    <div class="f-item04">
    <span><button  id="clickPost" type="button" class="btn btn-submit">Xuất bản bài viết</button></span>
    </div>

  </div>
</div>






<!--     <div class="css-kav51v ed5758y0" style="display: flex!important;"> -->
<!--         <div class="textoverlay-backdrop" style="box-sizing: border-box; position: absolute; margin: 0px; background: none 0% 0% / auto repeat scroll padding-box border-box rgb(255, 255, 255); background-blend-mode: normal; z-index: -2; left: 0px; top: 109px; height: 33px; width: 1090px;">
            
        </div>
        <div class="textoverlay" style="box-sizing: border-box; border-color: transparent; border-style: solid; color: transparent; position: absolute; white-space: pre-wrap; overflow-wrap: break-word; overflow: hidden; margin: 0px; font-family: Arial; font-size: 14px; font-weight: 400; line-height: 20px; padding: 6px 12px; border-width: 1.25px; z-index: -1; left: 0px; top: 109px; height: 33px; width: 1090px;">
            <div class="textoverlay-positioner" style="display: block; margin-top: 0px;"></div>
        </div> -->
           <!--  <input id="taglist" autocomplete="off" data-role="tagsinput" placeholder="Nhập tối đa 5 Tag liên quan đến kiến thức được phân tách bằng dấu cách (ví dụ: Ruby Rails)"> -->

      <!--   <div class="search-input" style="border: solid green 1px;float: left;width: 50px;">
            
        </div> -->
        


        <!-- <div class="search-suggest" style="left: 3px;"></div>  -->
        <!-- <div class="search-suggest" style="z-index: 1000; left: 77px; top: 142.969px; bottom: auto;"></div>    -->
            

        
    


            <!-- <input class="form-control" type="text" data-role="tagsinput" name="tags" style="display: none;">


            <input autocomplete="off" placeholder="Nhập tối đa 5 Tag liên quan đến kiến thức được phân tách bằng dấu cách (ví dụ: Ruby Rails)" tabindex="30" type="text" class="css-19fi7g8 ed5758y1" value="" style="background: transparent;"> -->

<!-- <button  id="clickPost" type="button" class="btn btn-info btn-submit" onclick="publish();">Đăng bài</button>
    </div> -->

                 
                 

    <div class="css-8atqhb e1jnj1zp0">
   @include("user::Elements.editor") 

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

<!--                     <div class="d-grid">
         <button id="clickPost" type="button" class="btn btn-info btn-submit" onclick="save();">Lưu nháp</button>
            </div>

                    <div class="d-grid">
         <button id="clickPost" type="button" class="btn btn-info btn-submit" onclick="publish();">Đăng bài</button>
            </div> -->


                    

                </div>

            </div>
        </div>
        
    </div>

</div>

<?php
        $str =Auth::id().date('y').date('m').date('d').date('h').date('m').date('s');
        $text =  str_split(strval($str ));
        $item = '';
        foreach ($text as $key => $value){
            if($key%2 == 0){
                $item.=chr(intval($value)+97);
            }else{
                $item.=$value;
            }
        }  
echo '<form id="saveForm" method="POST" action="post/edit">';
?>
    {{ csrf_field() }}
<input type="hidden" name="title" value="">
<input type="hidden" name="pfmt" value="">
<input type="hidden" name="tags" value="">
<input type="hidden" name="content" value="">
<?php echo '<input type="hidden" name="item" value="'.$item.'">
</form>';?>


<?php 

echo '<form id="publishForm" method="POST" action="post/store">';
?>
    {{ csrf_field() }}
<input type="hidden" name="title" value="">
<input type="hidden" name="editor" value="">
<input type="hidden" name="pfmt" value="">
<input type="hidden" name="tags" value="">
<input type="hidden" name="content" value="">
<?php echo '<input type="hidden" name="item" value="'.$item.'">
</form>';?>



<script type="text/javascript">
  

$(document).on('click', '#clickPost', function (event) {
    let el = $(this);
    if(el.hasClass('btn-submit')){
        publish()
    }else{
        save()
    }

    });   

function publish(){
    // $(this).action = 'http://localhost:8000/user/store'; //cant work

    // document.forms["publishForm"].username.value = ;
    // console.log(document.forms["publishForm"].username);

    $tag =[];
    const json =   $("#tags")[0].tagifyValue
    const obj = JSON.parse(json);    

    $(obj).each(function(key,element){

        $tag.push(element.value)
    });

    
    document.forms["publishForm"].title.value =document.getElementById('title').value;
    document.forms["publishForm"].editor.value =$("#editor").val()
    document.forms["publishForm"].pfmt.value =1;
    document.forms["publishForm"].content.value = $("#result").prop("outerHTML");
    // document.forms["publishForm"].tag.value = $("input").tagsinput('items')[2];
    document.forms["publishForm"].tags.value =$tag.join(',');

    document.forms["publishForm"].submit();



}

function save(){
    $tag =[];
    const json =   $("#tags")[0].tagifyValue
    const obj = JSON.parse(json);    

    $(obj).each(function(key,element){

        $tag.push(element.value)
    });
    
    document.forms["saveForm"].title.value =document.getElementById('title').value;
    document.forms["saveForm"].title.editor =$("#editor").val()
    document.forms["saveForm"].pfmt.value =2;
    document.forms["saveForm"].content.value = $("#result").prop("outerHTML");
    // document.forms["saveForm"].tag.value = $("input").tagsinput('items')[2];
    document.forms["saveForm"].tags.value =$tag.join(',');

     // document.forms["saveForm"].tag.value = 'laravel, php';

    document.forms["saveForm"].submit();
}

function check(){
    //console.log(document.getElementById('title').value);
  }

// $('#tags').tagsInput();
// console.log($('#tags'));

// delimiter= ',';


// var tagslist = $('#tags_tagsinput').val().split(delimiter['tags']);
// console.log("val",tagslist);

// if ($('#tags').tagExist('ab')) { console.log("have")}


</script>
@endsection