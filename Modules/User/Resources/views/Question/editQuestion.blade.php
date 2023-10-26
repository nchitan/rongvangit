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

        <div class="css-xgff9b ect7rag0">
            <select tabindex="10" class="css-1rqmung ect7rag1">
                <option value=" {{ old('type') }} {{ $post[0]['type'] }} " disabled="" selected="" > {{ old('type') }} {{ $post[0]['type'] }}

             </option>
                <option value="Q&A">Q&amp;A</option>
                <option value="Thảo luận">Thảo luận</option>
            </select>
        </div>    

        <div class="css-8atqhb f-item01">
            <div class="css-avt099 e1aqgsb40"><input type="text" id="title" placeholder="Tiêu đề" tabindex="20" class="css-12fqrnh e1aqgsb41" value="{{ old('title') }} {{ $post[0]['title'] }}">
               
               
                @if($post[0]['status'] ==1 || $post[0]['status'] ==3)                  
                    <div class="css-okymd3 e1aqgsb44"><a href="/{{ Auth::user()->name }}/questions/{{ $post[0]['item'] }}" target="_blank">Đã xuất bản</a></div>
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
            <span><button  id="clickPost" type="button" class="btn btn-submit">Xuất bản câu hỏi</button></span>
            </div>

        </div>
        @endif

    </div>



<div>
  <div >
      <input id="tags"  name='tags3' placeholder="Gắn ít nhất 1 tag và tối đa 5 tag cho câu hỏi"  value="{{ old('tags') }}  {{ $post[0]['tags'] }}">
  </div>

</div>
                 
    <div class="css-8atqhb e1jnj1zp0">

        <div id="test-editormd" style="">
                                    
            <!-- <textarea style="display:none;">[TOC]</textarea> -->
            <textarea style="display:none;">{{ old('editor') }}  {{$post[0]['editor']}}</textarea>
        </div>

    </div>

    <div class="css-132bea0 eiw8gvr0">

        
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
<input type="hidden" name="type" value="">
<input type="hidden" name="pfmt" value="">
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



    let msg ='Xin hãy nhập: '
    if( _title==''){
        msg+= ' [Tiêu đề bài viết] '
    }
    if(_editor==''){
        msg+= ' [Nội dung bài viết] '
    }
    if(json==''){
        msg+= ' [ít nhất 1 tag] '
    }

    if(msg != 'Xin hãy nhập: '){
        // alert(msg);
        // return false;
    }else{
        $tags =[];
        const obj = JSON.parse(json);    

        $(obj).each(function(key,element){

            $tags.push(element.value)
        });

        url =''
        if($(this).hasClass('btn-submit')){
            
            _action ="/drafts/question/store"
            _pfmt=1
        }else if($(this).hasClass('btn-primary')){
           
            _action="/drafts/question/edit"
            _pfmt =2
        }else if($(this).hasClass('btn-update')){
           
            _action="/drafts/question/store"
            _pfmt =3
           
        }
         var question_type = $('option:selected').val();
        

    // var form = $('#storeform')
    // form.attr('action', _action)
    document.getElementById("storeform").action = _action;
    document.forms["storeform"].title.value =_title;
    document.forms["storeform"].type.value =question_type;
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
            if($("#clickPost").html() =="Xuất bản câu hỏi"){
                $("#clickPost").html('Lưu bản nháp')
                 //$("#clickPost").css("background-color: #e7e7e7", "color: black;")
                 $("#clickPost").removeClass('btn-submit')
                 $("#clickPost").addClass('btn-primary')
            }else{
                $("#clickPost").html('Xuất bản câu hỏi')
                 //$("#clickPost").css("background-color: green")

                 $("#clickPost").removeClass('btn-primary')
                 $("#clickPost").addClass('btn-submit')
            } 
        });
    });


</script>
@endsection