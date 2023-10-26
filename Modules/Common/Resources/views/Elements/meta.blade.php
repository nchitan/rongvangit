<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
 <meta name="viewport" content=" width=device-width, initial-scale=1, maximum-scale=5"> 
 <?php
   
    $url =  "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $titlepage = '';
    if((strpos($url, "posts") == true) || (strpos($url, "questions") == true) ){
        $titlepage =  $posts[0]['title'].' | Rồng Vàng IT.com';
     
        echo '<meta name="keywords" content="'.$posts[0]['tags'].'">';       
        
    }else{
       $titlepage = 'Rồng Vàng IT.com';
    }
    
    echo '<title>'.$titlepage.'</title>';
    
    echo '<link rel="canonical" href="'.$url.'">';
?>      
        


<link rel="icon" href="https://rongvangit.com/favicon.ico">
<meta property="og:image" content="https://rongvangit.com/images/utils/rongvangitlogo.png">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ URL::asset('css/common.css') }}">


<!-- <link rel="stylesheet" type="text/css" href="{{ Module::asset('post:css/v25_common.css')  }}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ Module::asset('post:css/common.css')  }}"> -->


<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"> -->

<!-- boottrap button va code -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

<!-- font awesome -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->

<!-- make tag -->
<!-- <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-tagsinput.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ URL::asset('css/common.css') }}"> -->



<!-- <link rel="stylesheet" href="{{ URL::asset('css/github.css') }}"> -->

<!-- <link rel="stylesheet" href="{{ URL::asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/create.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/notifi.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/show.css') }}"> -->


<!-- <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/styles/default.min.css"> -->





