@extends('MasterLayout')
@section('content')
<div id="page-wrapper">
	<div class="inner-content">
		
		<div class="music-left">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
					<li>
						<div class="banner-info">
							<a class="trend" href="">TRENDING</a>
						</div>
						<div class="callbacks">
							<img src="images/metalica1.jpg"  alt="">
							<a style="font-size: 20px;" href="">Kill'em All</a>
						</div>
					</li>
					<li>
						<div class="banner-info">
							<a class="trend" href="">TRENDING</a>
						</div>
						<div class="banner-img">
							<img src="images/LPark1.jpg" alt="">
							<a style="font-size: 20px;" href="">Linkin Park</a>
						</div>
					</li>
					<li>
						<div class="banner-info">
							<a class="trend" href="">TRENDING</a>
						</div>
						<div class="banner-img">
							<img src="images/33.jpg" alt="">
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
					<div class="clearfix"> </div>
				</div>

				@for($i=0; $i<sizeof($newReleases) && $i < 8; $i++)
				<div class="col-md-3 content-grid" onClick="window.open('audio/{{$newReleases[$i]->id}}','_blank');">
					<a class="play-icon popup-with-zoom-anim" href=""><img src="{{asset('').$newReleases[$i]->poster}}" title={{$newReleases[$i]->title}}></a>
					<a class="button play-icon popup-with-zoom-anim" href="">{{$newReleases[$i]->title}}</a>
				</div>
				@endfor
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<div class="music-right">
			<div class="recommendationDiv">
				<div class="suggestions">
					<li>Recommended</li>
				</div>
				@for($i=0; $i<sizeof($recommendedSong); $i++)
				
				<div class="recommendSongDiv" id="songButton" onClick="window.open ('audio/{{$recommendedSong[$i]->id}}', '_blank');">
					<img src="{{asset('').$recommendedSong[$i]->poster}}">
					<div class="reducegap"></div>
					<h4 href="">{{$recommendedSong[$i]->title}}</h4>
					<div class="reducegap"></div>
					<li>{{$artist_arr[$i]}}</li>
					<div class="clearfix"></div>
					<li>
						<img src="{{asset('images/starIcon.png')}}" class="ratingStar2">
					</li>
					<li>
						<h3>{{$recommendedSong[$i]->rating}}</h3>
						<li>| &nbsp {{$recommendedSong[$i]->users_listened}} views</li>
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