@extends('MasterLayout')
@section('content')
<div class="playerContainer">
	<div class="MP_title">
		Albums
	</div>
	<div class="mediumGap"></div>
	<div class="MP_Container">
		<div class="recommendationDiv">
				@for($i=0; $i<sizeof($albums); $i++)
					<div class="recommendSongDiv" id="songButton">
						<img src="{{asset('').$albums[$i]->poster}}">
						<div class="reducegap"></div>
						<h4>{{$albums[$i]->title}}</h4>
						<div class="reducegap"></div>
						<li>Created By : <a href="">{{$addedBy[$i]}}</a></li>
						
						<div class="clearfix"></div>
						<li>{{$albums[$i]->created_at}}</li>
						<div class="albumTotalSong"><h5>{{sizeof($albums[$i]->audio_list)}}</h5></div>
					</div>
					<div class="recommendGap"></div>
				@endfor
		</div>
		{{ $albums->links() }}
	</div>
</div>
</div>
@endsection