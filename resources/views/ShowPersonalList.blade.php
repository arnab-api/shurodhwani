@extends('MasterLayout')
@section('content')
<div class="playerContainer">
	<div class="MP_title">
		My Playlists
	</div>
	<div class="createPlaylist" onclick="">
		<img src={{asset('images/createPlaylist.png')}}>
		<h3>Create New</h3>
	</div>
	<div class="mediumGap"></div>
	<div class="MP_Container">
		<div class="albums">
			@for($i=0; $i<sizeof($album_list); $i++)
			<div class="col-md-3 content-grid">
				<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
					<img src={{asset('').$album_list[$i]->poster}}>
					<div class="songUpdateButton"><img src="{{asset('images/update.png')}}" ></div>
				</a>
				<a class="button play-icon popup-with-zoom-anim" href="#small-dialog">{{$album_list[$i]->title}}</a>
			</div>
			@endfor
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
@endsection