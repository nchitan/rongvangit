<?php 
$gold =  'css-12okroa';
$silvar = 'css-1gbdfdf'; 
$cu = 'css-wkj968';
?>
<section class="css-8vdkzp"> 
	<div class="css-ymwvwh">
		<p class="css-ewn6g4">Tags ranking</p>
		<div class="css-k008qs css-ctagr">
			<span tabindex="0" class="css-ir22sg" title="weekly">Weekly</span>
			<span tabindex="0" class="css-tazpgo" title="monthly">Monthly</span>
			<span tabindex="0" class="css-tazpgo" title="all">All</span>
		</div>
	</div>
	<div class="css-1yuhvjn" id="css-ctagr">
		 @foreach ($TagRankWeekly as $value)
		<a href="/tags/<?php echo($value['tag_name']);?>" class="css-1f7jh9e">
			<div class="css-16lfj6j">
				<div class="css-fv3lde">
					<div class="css-a6vk0a">
                        @if ($loop->first)
						<span class="fa fa-fw fa-trophy css-12okroa"></span>
                        @elseif ($loop->index === 1)
                         <span class="fa fa-fw fa-trophy css-1gbdfdf"></span>
                        @elseif ($loop->index === 2)
                         <span class="fa fa-fw fa-trophy css-wkj968"></span>
                        @else 
                        <span>{{$loop->index +1}}</span>
                        @endif
					</div>
					<img onerror="this.src = '/images/utils/noimage.png';" src="<?php echo($value['tag_img']); ?>" alt="<?php echo($value['tag_name']);?>" class="css-3xss53"><div class="css-1038633">{{$value['tag_name']}}</div>
				</div>
				<p class="css-1xfnzth"><span class="css-1ex04uq">{{$value['count_post']}}</span>bài viết</p>
			</div>
		</a>
		@endforeach 
	</div>
</section>