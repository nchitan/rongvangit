                <div class="st-Modal report">
                    <div class="st-Modal_backdrop"></div>
                    <div class="st-Modal_body">
                        <form id = "reportuser" class = "reportuser">
                            {{ csrf_field() }}

                        <input type="hidden" name="reported_id" value="{{ $posts[0]['user_id']}}">
                        <input type="hidden" name="item_type" value="post">
                        <input type="hidden" name="item_id" value="{{ $posts[0]['post_id']}}">
                       

                            <div class="st-Form">
                            <span class="st-Form_label">Bài viết vi phạm lỗi nào dưới đây?</span>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="1">Vi phạm nội quy web Rồng Vàng IT</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="2">Vi phạm pháp luật Việt Nam</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="3">Vi phạm thuần phong mỹ tục Việt Nam</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="4">Spam</label>
                        </div>
                        <div class="st-Form st-Form-right"><button type="submit" class="css-qgrf2v2 e1rb7ucl0" disabled="" font-size="14">Báo cáo vi phạm</button>
                        </div>
                    </form>
                </div>
            </div>

 <!--                            <div class="st-Modal report">
                    <div class="st-Modal_backdrop"></div>
                    <div class="st-Modal_body">
                        <form><div class="st-Form">
                            <span class="st-Form_label">Bài viết vi phạm lỗi nào dưới đây?</span>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="CommunityGuidelineViolation">Vi phạm nội quy web Rồng Vàng IT</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="IllegalViolation">Vi phạm pháp luật Việt Nam</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="SociallyInappropriate">Vi phạm thuần phong mỹ tục Việt Nam</label>
                        </div>
                        <div class="st-Form">
                            <label><input type="checkbox" class="st-Form_checkbox" value="SuspectedSpam">Spam</label>
                        </div>
                        <div class="st-Form st-Form-right"><button type="submit" class="css-qgrf2v e1rb7ucl0" disabled="" font-size="14">Báo cáo vi phạm</button>
                        </div>
                    </form>
                </div>
            </div> -->