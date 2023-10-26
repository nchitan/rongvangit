@extends('common::layouts.master')

@section('content')

<?php 

?>

<div id="HomeTrendPage-react-component-11b5bc6a-c592-4545-9c78-3b7e9a6d3ebe">
	<div class="css-1nwi02o">
		<!-- navi bar -->
		@include("common::Elements.nav")
		<!-- navi bar end -->

		<div class="css-13bbk6m">
			<main role="main" class="css-1v96c6s">
				<div class="css-13qqtfl">
				</div>
				<section> 
					<div class="css-1p44k52">
						
						@foreach ($posts as $post)
                  @include("user::Elements.article_infor")
                @endforeach


					</div>
					<div class="css-1pw930v">
						<button class="css-d5ljyb">もっと読む</button>
					</div>
				</section>				
			</main>
		</div>
		<!-- adv bar -->
		@include("common::Elements.adv")
		<!-- adv bar end -->
	</div>
</div>

@endsection
@section('script')
<script src="/js/home.js"></script>
@endsection