            <div class="css-1j4z0qo e1h7t2ir0">
                <!-- profile -->

                <!-- following tag -->
                <div class="css-1iymp9t">
                    <div class="css-19kzrtu">
                        <h2 class="css-hpde30"><span class="fa fa-tags css-1f8husw"></span><a style="pointer-events: none;" href="/<?php echo $user['name']; ?>/following_tags" class="css-lrv4n2">Tags đang theo dõi</a>
                        </h2>
                        <div class="css-1jux8gx ezs40gf0">
                            @forelse ($following_tags as $following_tag)
                            <a href="/tags/{{ $following_tag->slug }}" class="css-5etkcj ezs40gf1">{{ $following_tag->tag_name }}</a>
                            @empty
                            <div style="text-align:center;font-size: 12px;color: rgba(0,0,0,0.6);margin-bottom: 8px;"><p class="css-1yk0zejj euu3pko2">@<?php echo $user['name']?> chưa theo dõi Tag</p></div>
                            @endforelse

                        </div>
                    </div>
                </div>
                <div class="css-1iymp9t"></div>
            </div>