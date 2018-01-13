@extends('MasterLayout')
@section('content')
<div id="page-wrapper">
	<div class="inner-content">
		
		<div class="music-left">
			<div class="banner-section">
				<div class="banner">
					<div class="callbacks_container">
						<ul class="rslides callbacks callbacks1" id="slider4">
							
							<li>
								<div class="banner-info">
									<a class="trend" href="">TRENDING</a>
								</div>
								<div class="banner-img">
									<img src="images/metalica1.jpg" class="img-responsive" alt="">
									<a style="font-size: 20px;" href="">Kill'em All</a>
								</div>
							</li>
							<li>
								<div class="banner-info">
									<a class="trend" href="">TRENDING</a>
								</div>
								<div class="banner-img">
									<img src="images/acdc1.jpg" class="img-responsive" alt="">
									<a style="font-size: 20px;" href="">Highway to Hell</a>
								</div>
							</li>
							<li>
								<div class="banner-info">
									<a class="trend" href="">TRENDING</a>
								</div>
								<div class="banner-img">
									<img src="images/33.jpg" class="img-responsive" alt="">
									<a style="font-size: 20px;" href="">Title</a>
								</div>
							</li>
						</ul>
					</div>
					<!--banner-->
					<script src="js/responsiveslides.min.js"></script>
					<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						// Slideshow 4
						$("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:true,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							$('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							$('.events').append("<li>after event fired.</li>");
							}
						});
					
						});
					</script>
					<div class="clearfix"> </div>
				</div>
			</div>
			<!--//End-banner-->
			<!--albums-->
			<!-- pop-up-box -->
			<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all">
			<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
			<script>
					$(document).ready(function() {
					$('.popup-with-zoom-anim').magnificPopup({
						type: 'inline',
						fixedContentPos: false,
						fixedBgPos: true,
						overflowY: 'auto',
						closeBtnInside: true,
						preloader: false,
						midClick: true,
						removalDelay: 300,
						mainClass: 'my-mfp-zoom-in'
					});
					});
			</script>
			<!--//pop-up-box -->
			<div class="albums">
				<div class="tittle-head">
					<h3 class="tittle">New Releases <span class="new">New</span></h3>
					<a href="index.html"><h4 class="tittle">See all</h4></a>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-3 content-grid">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="images/v1.jpg" title="allbum-name"></a>
					<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Title</a>
				</div>
				<div id="small-dialog" class="mfp-hide">
					<iframe src="https://player.vimeo.com/video/12985622"></iframe>
					
				</div>
				<div class="col-md-3 content-grid">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="images/v2.jpg" title="allbum-name"></a>
					<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Title</a>
				</div>
				<div class="col-md-3 content-grid">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="images/v3.jpg" title="allbum-name"></a>
					<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Title</a>
				</div>
				<div class="col-md-3 content-grid last-grid">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="images/v4.jpg" title="allbum-name"></a>
					
					<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Title</a>
				</div>
				<div class="col-md-3 content-grid">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="images/v5.jpg" title="allbum-name"></a>
					<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Title</a>
				</div>
				<div id="small-dialog" class="mfp-hide">
					<iframe src="https://player.vimeo.com/video/12985622"></iframe>
					
				</div>
				<div class="col-md-3 content-grid">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="images/v6.jpg" title="allbum-name"></a>
					
					<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Title</a>
				</div>
				<div class="col-md-3 content-grid">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="images/v7.jpg" title="allbum-name"></a>
					<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Title</a>
				</div>
				<div class="col-md-3 content-grid last-grid">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><img src="images/v8.jpg" title="allbum-name"></a>
					<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">Title</a>
				</div>
				<div class="clearfix"> </div>
			</div>
			
		</div>
			
		<div class="music-right">
			<div class="recommendationDiv">
				<div class="suggestions">
					<li>Recommended</li>
				</div>
				@for($i=0; $i<sizeof($recommendedSong); $i++)
					<div class="recommendSongDiv" id="songButton" onclick="ShowMusicPlayer('{{$recommendedSong[$i]->file_path}}')">
						<img src="{{asset('')."images/poster1.jpg"}}">
						<a href="">{{$recommendedSong[$i]->title}}</a>
						<div class="clearfix"></div>
						<li>{{$artist_arr[$i]}}</li>
						<div class="clearfix"></div>
						<li>
							<img src="{{asset('images/starIcon.png')}}" class="ratingStar2">
						</li>
						<li>
							<h3>{{$recommendedSong[$i]->rating}}</h3>
						</li>
					</div>
					<div class="recommendGap"></div>
				@endfor
			</div>
			<link href="css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
			<script type="text/javascript" src="js/jplayer.playlist.min.js"></script>
			
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection