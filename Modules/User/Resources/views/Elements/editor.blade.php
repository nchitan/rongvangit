<!-- md editor -->
<link rel="stylesheet" href="/editor.md/css/style.css" />
<link rel="stylesheet" href="/editor.md/css/editormd.css" />

<div id="test-editormd" style="">
                                
<!-- <textarea style="display:none;">[TOC]</textarea> -->
<textarea style="display:none;"></textarea>
</div>

<script src="/editor.md/js/jquery.min.js"></script>
        <script src="/editor.md/editormd.js"></script>
        <script type="text/javascript">
            var testEditor;

            $(function() {
                // testEditor = editormd("test-editormd", {
                //     width   : "90%",
                //     height  : 640,
                //     syncScrolling : "single",
                //     path    : "../lib/"
                // });
                
                
                // or
                testEditor = editormd({
                    id      : "test-editormd",
                    width   : "100vw",
                    height  : '85vh',
                    path    : "/editor.md/lib/"
                });
                
            });
</script>

<style type="text/css">
.CodeMirror-scroll {
    /*background-color: rgb(245, 246, 246);*/
}
</style>