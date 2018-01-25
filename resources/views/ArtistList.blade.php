@extends('MasterLayout')
@section('content')
<div class="playerContainer">
	<div class="MP_title">
		Artists
	</div>
	<div class="mediumGap"></div>
	<div class="MP_Container">
		<div class="column add-bottom">
			<div id="mainwrap">
			<div id="plwrap">
				<ul id="plList">
                    @for($i = 0 ; $i < sizeof($allArtists) ; $i++)
                        <li  onclick="window.location = '/artist/{{$allArtists[$i]->id}}';">
                            <div class="plItem" id="">
                                <div class="plNum">.</div>
                                <div class="plTitle">{{$allArtists[$i]->name}}</div>
                                <div class="artistTotalSong"><a>{{sizeof($allArtists[$i]->audio_list)}} Songs</a></div>
                            </div>
                        </li>
                    @endfor
				</ul>
			</div>
				{{ $allArtists->links() }}
		</div>
	</div>
</div>
</div>
@endsection