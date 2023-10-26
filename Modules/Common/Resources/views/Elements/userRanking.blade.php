<?php 
$gold =  'css-12okroa';
$silvar = 'css-1gbdfdf'; 
$cu = 'css-wkj968';
?>
<section class="css-8vdkzp">
	<div class="css-ymwvwh">
		<p class="css-ewn6g4">Users Ranking</p>
		<div class="css-k008qs css-cuserr">
			<span tabindex="0" class="css-ir22sg" title="weekly">Weekly</span>
			<span tabindex="0" class="css-tazpgo" title="monthly">Monthly</span>
			<span tabindex="0" class="css-tazpgo" title="all">All</span>
		</div>
	</div>
	<div class="css-1yuhvjn" id="css-cuserr">
		@foreach ($UserRankWeekly as $value)
		<a href="/<?php echo $value['username'];?>" class="css-1f7jh9e">
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
					<img loading="lazy" onerror="this.src = 'https://secure.gravatar.com/avatar/c2df0d82abc13bc84a3bb4eb7e5386d1';" src="<?php echo '/storage/'.$value['profile_photo_path'];?>" alt="<?php echo $value['username'];?>" class="css-q7jbwd">
					<div>
						
						@if($value['fullname'])
                		<div class="css-19ideir">{{$value['fullname']}}</div>
            			@endif  

						<div class="css-1k7xnbo">@<?php echo $value['username'];?> </div>
					</div>
				</div>
				<span class="css-1p4jp1c"><span class="css-17vnfqt">{{$value['contribution']}}</span>điểm cống hiến</span> 
			</div>
		</a>
		@endforeach
	</div>
<!-- 	<div class="css-1ljuops"><span class="fa fa-fw fa-info-circle css-15ro776"></span><a href="/rongvangit-award" style="color:inherit">RongVangIT Award Information</a></div> -->

</section>