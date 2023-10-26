@extends('admin::layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/admin.css') }}">
@endsection

@section('content')

<div id="main">
    <div class="container itemsusers mt-4">
        <div class="row">
            <div style="padding-top:10px">
            <ol class="breadcrumb"><li>Danh sách user bị report </li><li class="active">/ users</li></ol>
        </div>

        <ul class="GridList">
            @forelse ($list as $user)
            <li class="media GridList__user">
                <a href="/<?php echo $user->name; ?>"><img class="media__image userthumb userthumb--l" src="<?php echo '/storage/'.$user->profile_photo_path ; ?>" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" width="24" height="24" loading="lazy">
                </a>
                <div class="media__body"><h4 class="UserInfo__name"><a href="/<?php echo $user->name ?>"><?php if($user->fullname) { echo($user->fullname); } else { echo ($user->name);} ?></a></h4>

         <!--        <div id="UserFollowButton-react-component-f1681773-dfdf-41fc-9cca-b9aedfc18b4c"><span class="userFollowButton"><button class="btn btn-default btn-block userFollowButton_inner btn-xs"><i class="i fa fa-user-plus"></i>フォロー</button></span></div> -->

                            <div class="css-135kj0i euu3pko10">
                            
                                <a target="_blank" href="/<?php echo $user->name ?>" class="css-user infor">User Page</a>
                                @if ($user -> role_id == 6)
                                <button class="css-user activeuser" data-at="{{ $user->id }}"><span>Activate</span></button>
                                @elseif ($user -> role_id == 7)
                                <button class="css-user deactiveuser" data-at="{{ $user->id }}"><span>Deactivate</span></button>
                                @endif
                          
                            </div>


                      
                </div>
            </li>
            @empty

            @endforelse


        </ul>  

        <div class="text-center">
          {{ $list->links() }}
        </div>  



        </div>
    </div>
</div>

@endsection

@section('script')
<script src="/js/admin.js"></script>
<!-- <script src="/js/userpage.js"></script> -->
<!-- <script src="/assets/highlight/highlight.min.js"></script> -->
<!-- <script src="/assets/marked/marked.js"></script>
<script src="/js/editor.js"></script>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script> -->

@endsection