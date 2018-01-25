@extends('MasterLayout')
@section('content')
<div class="bamPash">
	
	<div class="proPicDiv">
		<img src="{{asset('').$user->profilePic}}" class="proPic">
		<div class="profileDetails">
			<h1>{{$user->name}}</h1>
			<div class="mediumGap"></div>
			<div class="profileListDiv">
				<div class="profileListTitle">
					<img src="{{asset('images/mailIcon.png')}}">
					&nbsp E-mail
				</div>
				<div class="profileListDescr">
					{{$user->email}}
				</div>
			</div>
			
			<div class="profileListDiv">
				<div class="gap2"></div>
				<div class="profileListTitle">
					<img src="{{asset('images/contribIcon.png')}}">
					&nbsp Contrib.
				</div>
				<div class="profileListDescr">
					+30
				</div>
			</div>
			
			<div class="profileListDiv">
				<div class="gap2"></div>
				<div class="profileListTitle">
					<img src="{{asset('images/joinedIcon.png')}}">
					&nbsp Joined
				</div>
				<div class="profileListDescr">
					{{$user->created_at}}
				</div>
			</div>

			<div class="profileListDiv">
				<div class="gap2"></div>
				<div class="profileListTitle">
					<img src="{{asset('images/aboutMeIcon.png')}}">
					&nbsp About Me
				</div>
				<div class="aboutMeDescr">
					{{$user->about_me}}
				</div>
			</div>
			
			
			<div class="gap2"></div>

			@if(Auth::check() == true && Auth::user()->_id == $user->_id)
			<div class="profileListDiv">
				<a href={{"/updateUserProfile/".$user->_id}} class="profileUpdateButton">Update</a>
			</div>
			@endif
		</div>
	</div>
	<div class="albums">
		<div class="tittle-head">
			<h3 class="tittle">Uploaded Songs</h3>
			<div class="clearfix"> </div>
		</div>
		@foreach($uploaded_song as $song)
			<div class="col-md-3 content-grid">
				<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
					<img src={{asset('').$song->poster}}>
					<div class="songUpdateButton"><img src="{{asset('images/update.png')}}" title="Update" ></div>
				</a>
				<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">{{$song->title}}</a>
			</div>
		@endforeach
		<div class="clearfix"> </div>
		<a class="seeAll" href="">See All</a>
	</div>

	<div class="albums">
		<div class="tittle-head">
			<h3 class="tittle">Uploaded Albums</h3>
			<div class="clearfix"> </div>
		</div>
		@foreach($uploaded_song as $song)
			<div class="col-md-3 content-grid">
				<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
					<img src={{asset('').$song->poster}}>
					<div class="songUpdateButton"><img src="{{asset('images/update.png')}}" ></div>
				</a>
				<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">{{$song->title}}</a>
			</div>
		@endforeach
		<div class="clearfix"> </div>
		<a class="seeAll" href="">See All</a>
	</div>

	<div class="hugeGap"></div>
</div>
<div class="danPash">
	<div class="mediumGap"></div>
	<div class="recommendationDiv">
		<div class="suggestions">
			<li>Recently Played</li>
		</div>
		@for($i=0; $i<sizeof($recentList); $i++)
		<div class="recommendSongDiv" onClick="window.open('/audio/{{$recentList[$i]->id}}','_blank');">
			<img src={{asset('').$recentList[$i]->poster}}>
			<div class="reducegap"></div>
			<h4 href="">{{$recentList[$i]->title}}</h4>
			<div class="reducegap"></div>
			<div class="clearfix"></div>
			<li>{{$artistArr[$i]}}</li>
			<div class="clearfix"></div>
			<li>
				<img src="{{asset('images/starIcon.png')}}" class="ratingStar2">
			</li>
			<li>
				<h3>{{$recentList[$i]->rating}}</h3>
			</li>
			<li>| &nbsp {{$recentList[$i]->users_listened}} views</li>
		</div>
		<div class="recommendGap"></div>
		@endfor
	</div>
</div>
@endsection