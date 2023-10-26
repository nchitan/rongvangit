@extends('common::layouts.master')

@section('content')
<div class="allWrapper">
<div class="p-tagShow">
	<div class="p-tagShow_container px-2 px-1@s pt-4 pt-1@s">
	<div class="p-tagShow_start">
	<div id="TagInfo-react-component-71d9f7a2-96f2-4440-bab2-efa53a2bc241"><div class="css-3kggic"><h1 class="css-1yjvs5a"><span class="css-ik5ql"><a title="タグの画像を変更する" href="/tags/laravelsail/edit" class="css-vozs05"><img src="//cdn.rongvangit.com/assets/icons/medium/missing-2e17009a0b32a6423572b0e6dc56727e.png" alt="laravelsail" class="css-r91awh"></a></span><span class="css-j6hlwq">LaravelSail</span><a href="/tags/laravelsail/feed" target="_blank" class="css-tv5spp"><span class="fa fa-fw fa-rss"></span></a></h1><div class="css-1kouxxg"><div class="css-1cmf7z7"><div class="css-i1gocq"><span class="css-la3nd4">16</span><span class="css-lk7pct">記事</span></div></div><div class="css-11ze7cv"><div class="css-pu36gg"><span class="css-la3nd4">0</span><span class="css-lk7pct">フォロワー</span></div></div></div><div class="css-8atqhb"><div class="css-1fcd6q4 e1p3oil80"><button class="css-hvs9iy e1yjhub90">記事をフォローする</button><button class="css-hvs9iy e1yjhub90">質問をフォローする</button></div></div></div></div>
	      <script type="application/json" class="js-react-on-rails-component" data-component-name="TagInfo" data-dom-id="TagInfo-react-component-71d9f7a2-96f2-4440-bab2-efa53a2bc241">{"tag":{"trendArticles":{"edges":[]},"encryptedId":"XJBB48ywQlFb9km8qS3S7RrkrWI=--xml/jA7AHnj3yVM+--HYAHvtW7umgJBXUDroQ/4w==","isFollowableByViewer":true,"isFollowedByViewer":false,"isSubscribableAnswerableByViewer":true,"isSubscribedAnswerableByViewer":false,"largeIconUrl":"//cdn.rongvangit.com/assets/icons/medium/missing-2e17009a0b32a6423572b0e6dc56727e.png","name":"LaravelSail","urlName":"laravelsail","itemsCount":16,"followersCount":0}}</script>
	      
	</div>

		<div class="p-tagShow_main">
			<div class="p-tagShow_mainTop">
				<div id="TagAbout-react-component-1dd4c0f0-5ebd-4642-af90-e922fb6b54b2"><div class="tsa-Content"><div class="tsa-Content_heading"><span class="fa fa-fw fa-book"></span>About</div><div class="tsa-Content_section p-tagShow_MdContent p-tagShow_MdContent-open"><div class="tsa-MdContent"><p>PythonはGuido van Rossumが設計した動的型付け言語です。Pythonは多くのデベロッパーによってライブラリの開発が行われており、Webページから科学研究まで幅広く利用されています。</p>

				<ul>
				<li>公式サイト: <a href="https://www.python.jp/">Top - python.jp</a>
				</li>
				<li>公式リファレンス: <a href="https://docs.python.org/ja/3/">3.7.4 Documentation</a>
				</li>
				<li>Wikipedia: <a href="https://ja.wikipedia.org/wiki/Python">Python - Wikipedia</a>
				</li>
				</ul>
				</div></div></div></div>
			</div>

			<div class="p-tagShow_mainMiddle">
				<div id="TagTrendArticleList-react-component-62b4bbad-fc26-4fc9-afcd-58cb1d7504b2">
					<div class="css-172osot e1mdkbz70">

						<div class="css-faujvq e1mdkbz71"><i class="fa fa-line-chart" style="color:#55c500;margin-right:8px"></i><div class="css-1hmizb3 e1mdkbz72">トレンド</div><div class="css-17hxefl e1mdkbz73">先週LGTMの多かった記事</div>
						</div>
						{{-- @foreach ($posts as $post) --}}
				         {{-- 	@include("common::Elements.article_infor") --}}
				        {{-- @endforeach --}}
					</div>
				</div>	
			</div>

			<div class="p-tagShow_mainBottom">
				<div id="TagNewestItemList-react-component-838a38a6-292a-4f01-99ed-9d6226af6e48">
					
					<div class="css-dt1zvi">
						<div class="css-1hw5c43"><div class="css-ygmo9w"><i class="fa fa-fw fa-list" style="color:#55c500;margin-right:8px"></i><div>最近の投稿</div></div><div class="css-178yklu"><div class="css-2imjyh e1v0a77u0"><a class="css-ls5mct e1v0a77u1">記事</a><a class="css-17f4hjb e1v0a77u1">質問</a></div></div></div>

						<div>

							{{-- @foreach ($posts as $post) --}}
				         {{-- 	@include("common::Elements.article_infor") --}}
				        {{-- @endforeach --}}
							

				        <ul class="css-5flwkf"><li class="css-18v043o"></li><li class="css-xkoxod"><span>1 / 3134</span></li><li class="css-tly37u"><a class="fa fa-angle-right css-elbs6l" rel="next" aria-label="Next Page"></a></li></ul>
						

					</div>
				</div>
				
			</div>

		</div>

		</div>

		<div class="p-tagShow_end mt-3">
			<div class="css-8fwe4o">
				@include("common::Elements.tagRanking")
				@include("common::Elements.organizationRanking")
				@include("common::Elements.userRanking")
			</div>
		</div>	


	</div>
</div>
</div>
@endsection