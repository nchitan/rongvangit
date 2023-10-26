
  <?php $created_at = date( "Y-m-d", strtotime( $post->created_at ) );?>

      <div class="searchResult" data-item-url="/{{ $post->username }}/posts/{{ $post->item }}" data-uuid="{{ $post->item }}"><div class="searchResult_left"><a href="/{{ $post->username }}"><img alt="" title="{{ $post->username }}" class="searchResult_userIcon" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="{{ $post->profile_photo_path }}"></a></div><div class="searchResult_main"><div class="searchResult_header"><a href="/{{ $post->username }}">{{ $post->username }}</a> đã đăng ngày {{ $created_at }} </div><h1 class="searchResult_itemTitle"><a href="/{{ $post->username }}/posts/{{ $post->item }}">{{ $post->title }}</a>
      </h1>
      <ul class="list-unstyled list-inline tagList">

                <?php 

                $tags = explode(",", $post->tags);
                foreach ( $tags as $tag ) {
               
                    echo  '<li class="tagList_item"><a href="/tags/'.mb_strtolower($tag).'">'. $tag.'</a></li>';
                }
                ?>

      </ul>


      <div class="searchResult_snippet">


      <?php

        $start = strpos($post->content,$keyword);
        $content_snippet = strip_tags(substr($post->content,$start,200)).'...';
        echo str_replace($keyword,'<em>'.$keyword.'</em>',$content_snippet);
        //echo str_replace($keyword,''.$keyword.'',$content_snippet);


      ?>


    </div>


    </div>
    <div class="searchResult_sub"><ul class="list-unstyled list-inline searchResult_statusList">
      @if($post->countlike)
      <li>
        <style type="text/css">.ViewerChecked {
        display: inline-block;
        width: 20px;
        height: 20px;
        fill: #55C500;
      }

      .NotChecked {
        display: inline-block;
        width: 20px;
        height: 20px;
        fill: #999;
      }</style>


      <img class="NotChecked" src="{{URL::asset('/images/utils/like.svg')}}" alt="profile Pic" height="40" width="40" style="transform: translateY(-0px)">{{ $post->countlike }}</li>
      @endif

      @if($post->countcomment)
      <li class="searchResult_commentsCount"><i class="fa fa-comment"></i>{{ $post->countcomment }}</li>@endif
     </ul></div></div>



