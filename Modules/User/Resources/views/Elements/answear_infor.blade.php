

          <article class="css-81mxb5">
            <?php $created_at = date( "Y-m-d", strtotime( $post->created_at ) );?>
            <header class="css-1a6wa7t">
                <div class="css-70qvj9">
                    <a href="/<?php echo $post ->username; ?>" class="css-hqvexg">
                        <img class="css-100alwu eyfquo10" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo '/storage/'.$post->profile_photo_path?>" width="20" height="20" loading="lazy">
                    </a>
                    <p class="css-1dtnjt5"><a href="/<?php echo $post ->username; ?>" class="css-y8q94p">@<?php echo $post ->username; ?></a><p class="css-1hmn1pl">Đăng ngày: <time datetime="<?php echo $post->created_at ?>"><?php echo $created_at ?></time></p></p>
                </div>

            </header>


            <div class="css-9v1ub6" >
                <a href="<?php echo '/'.$post ->username.'/questions/'.$post->item ?>#answear-<?php echo $post->id ?>" class="css-13fpj8m">
                    <p><?php if(strlen($post->content)>200){echo substr($post->content,0,200).'...';}else{echo $post->content;} ?></p>
                </a>
            </div>

            <div class="css-70qvj9">
                <?php 
                if ($post->type =="Q&A"){
                echo  '<div class="css-1409chb">'.$post->type.'</div>';
                }else{
                     echo  '<div class="css-17879sv">'.$post->type.'</div>';      
                }

                ?>

                <h2><a href="/<?php echo $post ->username; ?>/questions/<?php echo $post->item?>" class="css-1iomb4h"><?php echo $post->title?></a>
                </h2>
            </div>

            <footer class="css-1t3oi0e">
                <div>
                    <div class="css-vvapww">
                        <span aria-hidden="true" class="fa fa-tags css-7m9bsf"></span>
                        <?php 

                        $tags = explode(",", $post->tags);
                        foreach ( $tags as $tag ) {
                            echo  '<a href="/tags/'.mb_strtolower($tag).'" class="css-1ynjcyf">'. $tag.'</a>';
                        }
                        ?>
                    </div>
                    <div class="css-70qvj9">
                        <img src="{{URL::asset('/images/utils/like.svg')}}" alt="profile Pic" height="25" width="25" style="transform: translateY(-3px)">
                        <div class="css-1laxd2k"><?php if($post->count){echo ($post->count);}else{echo "0";}?></div><div class="css-1isemmb"></div>
                        <div class="css-rhtbwo"><span>Trả lời</span><span class="css-1isemmb">{{$post->count_answear}}</span></div>
                    </div>
                </div>
                <div>
 <!--                    <button class=" css-i3madw">
                    <img src="{{URL::asset('/images/utils/stock.svg')}}" alt="profile Pic" height="20" width="20">
                    </button> -->
                </div>
            </footer>
        </article>
