            <div class="css-19fauo6">
                <div class="css-1fs6fgn e1ojqm5t7">
                    <div>$ Thống kê của @<?php echo $user['name']?></div>
                    <div class="css-1cz0syp e1ojqm5t8">
                        <div class="css-1o5xglv e1ojqm5t0">
                            <div class="css-wer91p e1ojqm5t1">Bài viết đã đăng</div>
                            @if(count($post_ratings) > 0)
                              <ul class="css-193cml2 e1ojqm5t2">     
                                <?php
                                    $c = count($post_ratings);
                                    if ($c > 5){ $c = 5; };
                                    $keys = array_keys($post_ratings);
                                    for ($x = 0; $x < $c ; $x++) {
                                      echo '<li class="css-1tjc8k4 e1ojqm5t3"><span class="css-1s0lzlm e1ojqm5t4">'.$keys[$x].'<!-- -->:</span><span class="css-9yocrl e1ojqm5t5">'.$post_ratings[$keys[$x]].'%</span></li>';
                                    }
                                ?>
                             </ul>
                            @else
                                <ul class="css-193cml2 e1ojqm5t2"><span class="css-uu2o83 e1ojqm5t6">No data</span></ul>
                            @endif
                        </div>

                        <div class="css-1o5xglv e1ojqm5t0"><div class="css-wer91p e1ojqm5t1">Bài viết đã LIKE</div>
                            @if(count($post_like_ratings) > 0)
                              <ul class="css-193cml2 e1ojqm5t2">     
                                <?php
                                    $c = count($post_like_ratings);
                                    $keys = array_keys($post_like_ratings);
                                    if ($c > 5){ $c = 5; };
                                    for ($x = 0; $x < $c ; $x++) {
                                      echo '<li class="css-1tjc8k4 e1ojqm5t3"><span class="css-1s0lzlm e1ojqm5t4">'.$keys[$x].'<!-- -->:</span><span class="css-9yocrl e1ojqm5t5">'.$post_like_ratings[$keys[$x]].'%</span></li>';
                                    }
                                ?>
                             </ul>
                            @else
                                <ul class="css-193cml2 e1ojqm5t2"><span class="css-uu2o83 e1ojqm5t6">No data</span></ul>
                            @endif
                        </div>
                        
                        <div class="css-1o5xglv e1ojqm5t0">
                            <div class="css-wer91p e1ojqm5t1">Câu hỏi đã trả lời</div>
                            @if(count($answear_ratings) > 0)
                              <ul class="css-193cml2 e1ojqm5t2">     
                                <?php
                                    $c = count($answear_ratings);
                                    $keys = array_keys($answear_ratings);
                                    if ($c > 5){ $c = 5; };
                                    for ($x = 0; $x < $c ; $x++) {
                                      echo '<li class="css-1tjc8k4 e1ojqm5t3"><span class="css-1s0lzlm e1ojqm5t4">'.$keys[$x].'<!-- -->:</span><span class="css-9yocrl e1ojqm5t5">'.$answear_ratings[$keys[$x]].'%</span></li>';
                                    }
                                ?>
                             </ul>
                            @else
                                <ul class="css-193cml2 e1ojqm5t2"><span class="css-uu2o83 e1ojqm5t6">No data</span></ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>