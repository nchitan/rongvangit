<!-- tag -->
<script src="https://unpkg.com/@yaireo/tagify"></script>
  <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
  <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


  
<!-- <input name='tags3' type="hidden" pattern='^[A-Za-z_✲ ]{0,15}$'> -->

<input id="tags"  name='tags3' placeholder="Gắn ít nhất 1 tag và tối đa 5 tag cho bài viết"  value="{{ old('tags') }}">
  

<style type="text/css">
.tagify {

    --tags-border-color: white!important;
    --tags-hover-border-color:  white!important;
    --tags-focus-border-color:  white!important;
/*    height: 40px!important;
    width: 400px!important;*/
    text-align: left!important;
    background-color: white;
}
.tagify__dropdown {
     text-align: left!important;
}
</style>
<script type="text/javascript">
var input = document.querySelector('input[name=tags3]'),
    tagify = new Tagify(input, {whitelist:[],maxTags: 5,delimiters : ",",pattern: /^.{0,15}$/}),
    controller; // for aborting the call

// listen to any keystrokes which modify tagify's input
tagify.on('input', onInput)

function onInput( e ){
  var value = e.detail.value
  tagify.whitelist = null // reset the whitelist

  // https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
  controller && controller.abort()
  controller = new AbortController()

  // show loading animation and hide the suggestions dropdown
  tagify.loading(true).dropdown.hide()


$.ajax({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'post',
    url:'/getTagsSuggest',
    dataType: 'json',
    data: {'tag': value},
}).done(function (result, textStatus, jqXHR) {
    var suggesetWordList = [];
    var suggestWord = result['suggestWord'];

    
    $.each(suggestWord,function (index, val) {
        suggesetWordList.push(val['tag_name']);
    });
      tagify.whitelist = suggesetWordList // update whitelist Array in-place
      tagify.loading(false).dropdown.show(value) // render the suggestions dropdown
    //getSuggest(suggesetWordList);

}).fail(function (data, textStatus, xhr) {
    console.log(data.status);
});

}


// $(document).ready(function() {
//     //set initial state.
//     //$('#switch1').val(this.checked);

//     $('#switch1').change(function() {
//         if($("#clickPost").html() =="Xuất bản bài viết"){
//             $("#clickPost").html('Lưu bản nháp')
//              //$("#clickPost").css("background-color: #e7e7e7", "color: black;")
//              $("#clickPost").removeClass('btn-submit')
//              $("#clickPost").addClass('btn-primary')
//         }else{
//             $("#clickPost").html('Xuất bản bài viết')
//              //$("#clickPost").css("background-color: green")

//              $("#clickPost").removeClass('btn-primary')
//              $("#clickPost").addClass('btn-submit')
//         }
       
       
//         // if(this.checked) {
//         //     var returnVal = confirm("Are you sure?");
//         //     $(this).prop("checked", returnVal);
//         // }
//         // $('#switch1').val(this.checked);        
//     });
// });
</script>