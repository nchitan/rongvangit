
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php 
$currentURL = url()->full();

?>

@if(strpos($currentURL,'/drafts/') === false)

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0&appId=3084959888222500&autoLogAppEvents=1" nonce="GymNAI1m"></script>

<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

<!-- This makes the current user's id available in javascript -->
@if(!auth()->guest())
    <script>
        window.Laravel.userId = <?php echo auth()->user()->id; ?>
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>
@endif

<script src="/js/userpage.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-V4YLT7EG3C"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-V4YLT7EG3C');
</script>

@endif








<!-- <script src="/js/bootstrap-tagsinput.js"></script>
<script src="/assets/marked/marked.js"></script> -->



<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/highlight.min.js"></script> -->

<!-- <script>hljs.highlightAll();</script> -->



<!-- highlight -->

<!-- <script src="/assets/highlight/highlight.min.js"></script> -->


<!-- <link rel="stylesheet" href="{{ URL::asset('/assets/highlight/a11y-dark.min.css') }}"> -->

<!-- <link rel="stylesheet" href="{{ URL::asset('/assets/highlight/stackoverflow-dark.min.css') }}"> -->

<!-- <script src="/js/editor.js"></script> -->

<!-- <script src="/assets/jquery/jquery.min.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->


