@extends('user::layouts.createMaster')

@section('content')

<style type="text/css">
.allWrapper {

     background-color: #F0F2F5!important; 
}
    
</style>
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


    <div class="css-1qlva0w f-container">

        <div class="css-8atqhb f-item01">
            <div class="css-avt099 e1aqgsb40"><input type="text" id="title" placeholder="Tiêu đề" tabindex="20" class="css-12fqrnh e1aqgsb41" value="{{ old('title') }} {{ $post[0]['title'] }}">
               
               
                @if($post[0]['status'] ==1 || $post[0]['status'] ==3)                  
                    <div class="css-okymd3 e1aqgsb44"><a href="/{{ Auth::user()->name }}/posts/{{ $post[0]['item'] }}" target="_blank">Đã xuất bản</a></div>
                @else

                <div class="css-axyh e1aqgsb43">Chưa xuất bản</div>
                @endif
            </div>
        </div>
         @if($post[0]['status'] ==1 || $post[0]['status'] ==3 )
          <div class="f-item02">
<!--             <div class="f-item03">
                <div class="switchArea">
                  <input type="checkbox" checked id="switch1">
                  <label for="switch1"><span></span></label>
                  <div id="swImg"></div>
                </div>
            </div> -->    
            <div class="f-item0">
            <span><button  id="clickPost" type="button" class="btn btn-update" style="background-color: #0d6efd;">Update nội dung</button></span>
            </div>

          </div>
        @else
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
        @endif

    </div>


<div class="f-item02">
    <div  class="f-item03" style="border: 1px solid darkgray; margin: 6px 10px 0px; border-radius: 3px;">
      <div >
          <input id="tags"  name='tags3' placeholder="Gắn ít nhất 1 tag và tối đa 5 tag cho bài viết"  value="{{ old('tags') }}  {{ $post[0]['tags'] }}">
      </div>

    </div>

    
      <div class="f-item04" >
        @if($post[0]['serie']) 
            <input id="serie" class="chuyende e1aqgsb41" placeholder="Tên chuyên đề (nếu có)"  value="{{ $post[0]['serie'] }} ">
        @elseif($post[0]['serie']) 
            <input id="serie" class="chuyende e1aqgsb41" placeholder="Tên chuyên đề (nếu có)"  value="{{ old('serie') }} ">
        @else

        <input id="serie" class="chuyende e1aqgsb41" placeholder="Tên chuyên đề (nếu có)"  value="">
          @endif
      </div>


      <div class="f-item05" style="float:right;" >
        @if($post[0]['published_at']) 
      
            <p style="color:grey;">Lịch xuất bản</p> <input id="published_at" type="date" id="start" name="trip-start" placeholder="Ngày xuất bản" value="{{ $post[0]['published_at']}}" min="{{ date("Y-m-d") }}" />

        @else
          <p style="color:grey;">Lịch xuất bản</p> <input id="published_at" type="date" id="start" name="trip-start" placeholder="Ngày xuất bản" value="{{ old('published_at') }}" min="{{ date("Y-m-d ") }}" />
        @endif
      </div>


</div>


                                 

    <div class="css-8atqhb e1jnj1zp0">

        <div id="test-editormd" style="">
                                    
            <!-- <textarea style="display:none;">[TOC]</textarea> -->
            <textarea style="display:none;">{{ old('editor') }}  {{$post[0]['editor']}}</textarea>
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
        // $str =Auth::id().date('y').date('m').date('d').date('h').date('m').date('s');
        // $text =  str_split(strval($str ));
        // $item = '';
        // foreach ($text as $key => $value){
        //     if($key%2 == 0){
        //         $item.=chr(intval($value)+97);
        //     }else{
        //         $item.=$value;
        //     }
        // }  

echo '<form id="storeform" method="POST">';
?>
    {{ csrf_field() }}
<input type="hidden" name="title" value="">
<input type="hidden" name="pfmt" value="">
<input type="hidden" name="serie" value="">
<input type="hidden" name="published_at" value="">
<input type="hidden" name="tags" value="">
<input type="hidden" name="editor" value="">
<input type="hidden" name="content" value="">
<input type="hidden" name="action" value="">
<?php echo '<input type="hidden" name="item" value="'.$post[0]['item'].'">
</form>';?>

<form style="display:none" method="POST" enctype="multipart/form-data" id="upload_image" action="{{ url('save') }}" >
    {{ csrf_field() }}
                <input type="file" type="hidden" name="image" placeholder="Choose image" id="image">
            @error('image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror 
           
</form>

@endsection

@section('script')

<script type="text/javascript">
  

$(document).on('click', '#clickPost', function (event) {
    
    const json =   $("#tags")[0].tagifyValue
    _title =document.getElementById('title').value
     _editor=$(".editormd-markdown-textarea").val()
    _content = $(".markdown-body").prop("innerHTML")

    _defaultEditor ='<div class="CodeMirror-activeline" style="position: relative;"><div class="CodeMirror-activeline-background CodeMirror-linebackground"></div><pre class=""><span style="padding-right: 0.1px;"><span cm-text="">​</span></span></pre></div>'
    let msg ='Xin hãy nhập: '
    if( _title==''){
        msg+= ' [Tiêu đề bài viết] '
    }
    if(_editor==_defaultEditor){
        msg+= ' [Nội dung bài viết] '
    }
    if(json==''){
        msg+= ' [ít nhất 1 tag] '
    }

    if(msg != 'Xin hãy nhập: '){
        alert(msg);
        return false;
    }else{
        $tags =[];
        const obj = JSON.parse(json);    

        $(obj).each(function(key,element){

            $tags.push(element.value)
        });

        url =''
        if($(this).hasClass('btn-submit')){
            
            _action ="/drafts/post/store"
            _pfmt=1
        }else if($(this).hasClass('btn-primary')){
           
            _action="/drafts/post/edit"
            _pfmt =2
        }else if($(this).hasClass('btn-update')){
           
            _action="/drafts/post/store"
            _pfmt =3
        }
        

    // var form = $('#storeform')
    // form.attr('action', _action)
    document.getElementById("storeform").action = _action;
    document.forms["storeform"].title.value =_title;
    document.forms["storeform"].serie.value =$('#serie').val();
     document.forms["storeform"].published_at.value =$('#published_at').val();
    document.forms["storeform"].pfmt.value =_pfmt;
    document.forms["storeform"].editor.value =_editor;
    document.forms["storeform"].content.value = _content;
    document.forms["storeform"].tags.value =$tags;
    document.forms["storeform"].action.value ='update';
    document.forms["storeform"].submit();
    }
});   

    $(document).ready(function() {
        //set initial state.
        //$('#switch1').val(this.checked);

        $('#switch1').change(function() {
            if($("#clickPost").html() =="Xuất bản bài viết"){
                $("#clickPost").html('Lưu bản nháp')
                 //$("#clickPost").css("background-color: #e7e7e7", "color: black;")
                 $("#clickPost").removeClass('btn-submit')
                 $("#clickPost").addClass('btn-primary')
            }else{
                $("#clickPost").html('Xuất bản bài viết')
                 //$("#clickPost").css("background-color: green")

                 $("#clickPost").removeClass('btn-primary')
                 $("#clickPost").addClass('btn-submit')
            } 
        });
    });

</script>
@endsection