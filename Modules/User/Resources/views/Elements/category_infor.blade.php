            <div class="css-1elw6c9">

                @foreach ($categories as $user_category)
                    <?php $class=''; if (in_array($user_category['category_name'], $checkStock,true)){$class= 'stockcheck stocked';}?>
                    @if (isset($user_category['sub_category_names']))
                    <div class="css-dwc3sl">                        
                        <span class="fa fa-folder-open"  style="color: orange;"></span><span class ="css-catname mainfolder {{ $class }}" data-cateid= "{{ $user_category['id'] }}">{{$user_category['category_name']}}</span>
                        <?php
                            $sub_category_names = explode(",",  $user_category['sub_category_names']  ); 
                            foreach ($sub_category_names as $value){
                                $sub_category_name = explode(":", $value);
                                if(in_array($sub_category_name[0], $checkStock,true)){
                                    echo '<br>&nbsp&nbsp&nbsp&nbsp <span class="fa fa-folder" style="color: orange;"></span><span class ="css-catname subfolder stockcheck stocked" data-cateid= "'.$user_category['id'].':'.$sub_category_name[1].'">'.$sub_category_name[0].'</span>';
                                }else{
                                    echo '<br>&nbsp&nbsp&nbsp&nbsp <span class="fa fa-folder" style="color: orange;"></span><span class ="css-catname subfolder" data-cateid= "'.$user_category['id'].':'.$sub_category_name[1].'">'.$sub_category_name[0].'</span>';
                                }
                            }
                        ?>
                    </div>
                    @else 
                   <div class="css-dwc3sl">
                        <span class="fa fa-folder"  style="color: orange;"></span><span class ="css-catname mainfolder {{ $class }}" data-cateid= "{{$user_category['id']}}">{{$user_category['category_name']}}</span>
                    </div>
                    @endif
                @endforeach
            </div> 