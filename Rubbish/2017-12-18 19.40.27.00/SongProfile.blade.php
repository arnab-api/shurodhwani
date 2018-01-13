@extends('MasterLayout')
@section('content')
<div class="bamPash">
    
    <div class="mediumGap"></div>
    <div class="songPosterDiv">
        <img src="{{asset('').$audio->poster}}">
        
        <div  class="addToFavIcon">
            <div class="click">
                <span class="fa fa-heart-o"></span>
                <div class="ring"></div>
                <div class="ring2"></div>
                <p class="info">Added to favourites!</p>
            </div>
        </div>

        <div class="songProfileHeader">
            <h3>{{$audio->title}}</h3>
            <div class="ratingDiv">
                <img src="{{asset('images/starIcon.png')}}">
                <h5>7.9</h5>
            </div>
        </div>
        <div class="musicPlayerContainer">
            <div id="audiowrap">
                <div><audio preload id="audio1" controls="controls">Your browser does not support HTML5 Audio!</audio></div>
            </div>
        </div>
    </div>
    
    <div class="songDetailsDiv">
        <div class="profileListDiv">
            <div class="profileListTitle">
                Published By
            </div>
            <div class="profileListDescr">
                &nbsp {{$user->name}}
            </div>
        </div>
        
        <div class="profileListDiv">
            <div class="gap2"></div>
            <div class="profileListTitle">
                Published On
            </div>
            <div class="profileListDescr">
                &nbsp {{$audio->created_at}}
            </div>
        </div>
        
        <div class="profileListDiv">
            <div class="gap2"></div>
            <div class="profileListTitle">
                Genre
            </div>
            <div class="profileListDescr">
                &nbsp Classical, Rabindra
            </div>
        </div>
    </div>


    <div class="rateDiv">
        <h1>Rate This</h1>
        <div class="ratingStars">
            <form id="ratingsForm">
                <div class="stars">
                    <input type="radio" name="star" class="star-1" id="star-1" />
                    <label class="star-1" for="star-1">1</label>
                    <input type="radio" name="star" class="star-2" id="star-2" />
                    <label class="star-2" for="star-2">2</label>
                    <input type="radio" name="star" class="star-3" id="star-3" />
                    <label class="star-3" for="star-3">3</label>
                    <input type="radio" name="star" class="star-4" id="star-4" />
                    <label class="star-4" for="star-4">4</label>
                    <input type="radio" name="star" class="star-5" id="star-5" />
                    <label class="star-5" for="star-5">5</label>
                    <input type="radio" name="star" class="star-6" id="star-6" />
                    <label class="star-6" for="star-6">6</label>
                    <input type="radio" name="star" class="star-7" id="star-7" />
                    <label class="star-7" for="star-7">7</label>
                    <input type="radio" name="star" class="star-8" id="star-8" />
                    <label class="star-8" for="star-8">8</label>
                    <input type="radio" name="star" class="star-9" id="star-9" />
                    <label class="star-9" for="star-9">9</label>
                    <input type="radio" name="star" class="star-10" id="star-10" />
                    <label class="star-10" for="star-10">10</label>
                    <span></span>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="mediumGap"></div>


    <div class="audioProfileCommentDiv">
        <h1>Leave a comment</h1>
        <form>
            <textarea class="commentTextArea" id="comArea" name="comArea"></textarea>
            <div class="clearfix"></div>
            <input type="submit" class="commentSubmit" name="comSubmit" id="comSubmit"></input>
        </form>
        <h1>Comments...</h1>
        <div class="hr1"><hr></div>
        @for($i=0; $i<5; $i++)
        <div class="singleComment">
            <div class="commentProPic">
                <img src="images/c3.jpg">
            </div>
            <div class="commenter">
                <a href="">Arnab Sen Sharma</a>
                <h1>December 18, 2017 at 9:15pm</h1>
            </div>

            <div class="voteDiv">
                <div class="panel2 panel2-default">
                    <div class="panel2-footer">
                        
                        <i id="like1" class="glyphicon glyphicon-thumbs-up"></i> <div id="like1-bs3"></div>
                        <i id="dislike1" class="glyphicon glyphicon-thumbs-down"></i> <div id="dislike1-bs3"></div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="hr2"><hr></div>

            <div class="commentText">
                Galaxy Science Fiction was an American digest-size science fiction magazine, published from 1950 to 1980. It was founded by World Editions and sold two years later to Robert Guinn, the magazine's printer. Its first editor, H. L. Gold, rapidly made
            </div>
            <div class="mediumGap"></div>
        </div>
        @endfor
    </div>
</div>
<div class="danPash">
    <div class="mediumGap"></div>
    <div class="recommendationDiv">
        <div class="suggestions">
            <li>Suggestions</li>
        </div>
        @for($i=0; $i<10; $i++)
        <div class="recommendSongDiv">
            <img src="images/poster1.jpg">
            <a href="">Ami Jamini Tumi Shoshi He</a>
            <div class="clearfix"></div>
            <li>Sreekanta Acharya</li>
            <div class="clearfix"></div>
            <li>
                <img src="images/starIcon.png" class="ratingStar2">
            </li>
            <li>
                <h3>7.2</h3>
            </li>
        </div>
        <div class="recommendGap"></div>
        @endfor
    </div>
</div>

<script type="text/javascript">
        
var b = document.documentElement;
b.setAttribute('data-useragent', navigator.userAgent);
b.setAttribute('data-platform', navigator.platform);

jQuery(function ($) {
    var supportsAudio = !!document.createElement('audio').canPlayType;
    var title = {!! json_encode($title) !!}
    var file_path = {!! json_encode($path) !!}

    var add = {
        "track": 1,
        "name": title,
        "file": "/"+file_path
    };
    console.log(add);
    var playlist = [add];

    if (supportsAudio) {
        var index = 0,
            playing = false,
            mediaPath = '',
            extension = '',
            tracks = playlist,
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
        extension = '';
        loadTrack(index);
    }
});

</script>


<script type="text/javascript">
        
$(document).ready(function() {              
    $('i.glyphicon-thumbs-up, i.glyphicon-thumbs-down').click(function(){    
        var $this = $(this),
        c = $this.data('count');    
        if (!c) c = 0;
        c++;
        $this.data('count',c);
        $('#'+this.id+'-bs3').html(c);
    });      
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });                                        
}); 

</script>


<!-- favourite button -->

<script type="text/javascript">
$('.click').click(function() {
    if ($('span').hasClass("fa-star")) {
            $('.click').removeClass('active')
        setTimeout(function() {
            $('.click').removeClass('active-2')
        }, 30)
            $('.click').removeClass('active-3')
        setTimeout(function() {
            $('span').removeClass('fa-star')
            $('span').addClass('fa-star-o')
        }, 15)
    } else {
        $('.click').addClass('active')
        $('.click').addClass('active-2')
        setTimeout(function() {
            $('span').addClass('fa-star')
            $('span').removeClass('fa-star-o')
        }, 150)
        setTimeout(function() {
            $('.click').addClass('active-3')
        }, 150)
        $('.info').addClass('info-tog')
        setTimeout(function(){
            $('.info').removeClass('info-tog')
        },1000)
    }
});
</script>

@endsection