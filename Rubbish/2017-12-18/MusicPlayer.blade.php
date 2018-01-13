@extends('MasterLayout')
@section('content')

<div class="playerContainer">
	<div class="MP_title">
		Title
	</div>
	<div class="mediumGap"></div>
	<div class="MP_Container">
		<div class="column add-bottom">
			<div id="mainwrap">
				<div id="nowPlay">
					<span class="left" id="npAction">Paused...</span>
					<span class="right" id="npTitle"></span>
				</div>
				<div id="audiowrap">
					<div id="audio0">
					<audio preload id="audio1" controls="controls" class="audio_div">Your browser does not support HTML5 Audio!</audio>
				</div>
				<div id="tracks">
					<a id="btnPrev" >
						<img src="images/prev.png" class="backButton">
					</a>
					<a id="btnNext">
						<img src="images/next.png" class="backButton">
					</a>
				</div>
			</div>
			<div id="plwrap">
				<ul id="plList">
					<li>
						<div class="plItem">
							<div class="plNum">01.</div>
							<div class="plTitle">Test Song</div>
						</div>
					</li>
					<li>
						<div class="plItem">
							<div class="plNum">02.</div>
							<div class="plTitle">Test Song</div>
						</div>
					</li>
					<li>
						<div class="plItem">
							<div class="plNum">03.</div>
							<div class="plTitle">Test Song</div>
						</div>
					</li>
					<li>
						<div class="plItem">
							<div class="plNum">04.</div>
							<div class="plTitle">Test Song</div>
						</div>
					</li>
					<li>
						<div class="plItem">
							<div class="plNum">05.</div>
							<div class="plTitle">Test Song</div>
						</div>
					</li>
					<li>
						<div class="plItem">
							<div class="plNum">05.</div>
							<div class="plTitle">Test Song</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js'></script>
    <script src='http://api.html5media.info/1.1.8/html5media.min.js'></script>
    <script type="text/javascript">
        
        var b = document.documentElement;
b.setAttribute('data-useragent', navigator.userAgent);
b.setAttribute('data-platform', navigator.platform);

jQuery(function ($) {
    var supportsAudio = !!document.createElement('audio').canPlayType;
    if (supportsAudio) {
        var index = 0,
            playing = false,
            mediaPath = '',
            extension = '',
            tracks = [{
                "track": 1,
                "name": "Test Song",
                "file": "testSongs/song1"
            }, {
                "track": 2,
                "name": "Test Song",
                "file": "testSongs/song2"
            }, {
                "track": 3,
                "name": "Test Song",
                "file": "testSongs/song3"
            }, {
                "track": 4,
                "name": "Test Song",
                "file": "testSongs/song4"
            }, {
                "track": 5,
                "name": "Test Song",
                "file": "testSongs/song5"
            }],
            trackCount = tracks.length,
            npAction = $('#npAction'),
            npTitle = $('#npTitle'),
            audio = $('#audio1').bind('play', function () {
                playing = true;
                npAction.text('Now Playing...');
            }).bind('pause', function () {
                playing = false;
                npAction.text('Paused...');
            }).bind('ended', function () {
                npAction.text('Paused...');
                if ((index + 1) < trackCount) {
                    index++;
                    loadTrack(index);
                    audio.play();
                } else {
                    audio.pause();
                    index = 0;
                    loadTrack(index);
                }
            }).get(0),
            btnPrev = $('#btnPrev').click(function () {
                if ((index - 1) > -1) {
                    index--;
                    loadTrack(index);
                    if (playing) {
                        audio.play();
                    }
                } else {
                    audio.pause();
                    index = 0;
                    loadTrack(index);
                }
            }),
            btnNext = $('#btnNext').click(function () {
                if ((index + 1) < trackCount) {
                    index++;
                    loadTrack(index);
                    if (playing) {
                        audio.play();
                    }
                } else {
                    audio.pause();
                    index = 0;
                    loadTrack(index);
                }
            }),
            li = $('#plList li').click(function () {
                var id = parseInt($(this).index());
                if (id !== index) {
                    playTrack(id);
                }
            }),
            loadTrack = function (id) {
                $('.plSel').removeClass('plSel');
                $('#plList li:eq(' + id + ')').addClass('plSel');
                npTitle.text(tracks[id].name);
                index = id;
                audio.src = mediaPath + tracks[id].file + extension;
            },
            playTrack = function (id) {
                loadTrack(id);
                audio.play();
            };
        extension = audio.canPlayType('audio/mpeg') ? '.mp3' : audio.canPlayType('audio/ogg') ? '.ogg' : '';
        loadTrack(index);
    }
});

    </script>

@endsection