@extends('user::layouts.createMaster')

@section('content')

<style type="text/css">
.allWrapper {

     background-color: #F0F2F5!important; 
}
.tagify__input{
   font-size: 16px;
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
                <option value="NOT_SET" disabled="" selected="">Chọn kiểu</option>
                <option value="Q&A">Q&amp;A</option>
                <option value="Thảo luận">Thảo luận</option>
            </select></div>    

        <div class="css-8atqhb f-item01">
            <div class="css-avt099 e1aqgsb40"><input type="text" id="title" placeholder="Tiêu đề" tabindex="20" class="css-12fqrnh e1aqgsb41" value="{{ old('title') }}">
               
               


                <!-- <div class="css-axyh e1aqgsb43">Chưa đăng</div> -->

            </div>
        </div>

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

    </div>



<div style="border: 1px solid darkgray; margin: 6px 10px 0px; border-radius: 3px;">
  <div >
      <input id="tags"  name='tags3' placeholder="Gắn ít nhất 1 tag và tối đa 5 tag cho câu hỏi"  value="{{ old('tags') }}">
  </div>

</div>
                 
    <div class="css-8atqhb e1jnj1zp0">

        <div id="test-editormd" style="">
                                    
            <!-- <textarea style="display:none;">[TOC]</textarea> -->
            <textarea style="display:none;">{{ old('editor') }}  </textarea>
        </div>

    </div>

    <div class="css-132bea0 eiw8gvr0">

        
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
<?php echo '<input type="hidden" name="item" value="'.$item.'">
</form>';?>
<div class="st-Modal"><div class="st-Modal_backdrop"></div><div class="st-Modal_body"><div class="css-1vbwa3u">Đăng câu hỏi lên Rồng Vàng IT</div><div class="css-34dx58"><div class="css-yxqu09"><span class="css-vskrqn">
      <p>Xin hãy xác nhận
        <a href="/guideline" target="_blank">
           Nguyên tắc cộng đồng
        </a>
        trước khi đăng câu hỏi này.
      </p>
      <p>Ở đó có ghi các quy tắc về nội dung để mọi người cùng có trải nghiệm tốt hơn.</p>
      <p>
        Mọi ý kiến xin vui lòng liên hệ với 
        <a href="https://www.facebook.com/rongvangit" target="_blank">
          Rồng vàng IT team.
        </a>
        
      </p>
    </span></div></div><div class="css-1dxqm26"><button type="button" class="css-1iwvira e1rb7ucl0" font-size="14">Huỷ</button><button type="button" class="css-4ybakh e1rb7ucl0" font-size="14">Đăng bài</button></div></div></div>

<form style="display:none" method="POST" enctype="multipart/form-data" id="upload_image" action="{{ url('save') }}" >
    {{ csrf_field() }}
                <input type="file" type="hidden" name="image" placeholder="Choose image" id="image">
            @error('image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror 
           
</form>>
@endsection

@section('script')

<script type="text/javascript">

$(document).on('click', '#clickPost', function (event) {
        if($(this).hasClass('btn-submit')){
            $('.st-Modal').addClass('is-open')
        }else if($(this).hasClass('btn-primary')){
           
            _action="question/edit"
            _pfmt =2
            store(_action, _pfmt)
        }
})
$(document).on('click', '.css-4ybakh', function (event) {    
            _action ="question/store"
            _pfmt=1   
    store(_action, _pfmt)
});
  

function store(_action, _pfmt){
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
        alert(msg);
        return false;
    }else{
        $tags =[];
        const obj = JSON.parse(json);    

        $(obj).each(function(key,element){

            $tags.push(element.value)
        });

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
    document.forms["storeform"].action.value ='create';
    document.forms["storeform"].submit();
    }
}

    $(document).ready(function() {
        //set initial state.
        //$('#switch1').val(this.checked);


        $('#switch1').change(function() {
            console.log("clos")
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