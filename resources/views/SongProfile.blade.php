@extends('MasterLayout')
@section('content')
<div class="bamPash">
    
    <div class="mediumGap"></div>
    <div class="songPosterDiv">
        <img src="{{asset('').$audio->poster}}">

        @if(Auth::check())
        <div  class="addToFavIcon">
            <div class="click">
                <span class="fa fa-heart-o"></span>
                <div class="ring"></div>
                <div class="ring2"></div>
                <p class="info">Added to favourites!</p>
            </div>
        </div>
        @endif

        <div class="songProfileHeader">
            <h3>{{$audio->title}}</h3>
            <a href="">Shreekanto Acharya</a>
            <a href="">S. D Burman</a>
            <a href="">Anjan Dutt</a>
            <div class="ratingDiv">
                <img src="{{asset('images/starIcon.png')}}">
                <h5 id="rating">{{$audio->rating}}</h5>
            </div>
            <h2>{{$audio->users_listened}} views</h2>
        </div>

        <div class="musicPlayerContainer">
            <div id="audiowrap">
                <div><audio preload id="audio1" controls="controls">Your browser does not support HTML5 Audio!</audio></div>
            </div>
        </div>
    </div>

    <div class="songDetailsDiv">

        <h3>
            Tags :
            <a href="">Classic</a>
            <a href="">Rabindra</a>
        </h3>

        <div class="commentProPic">
            <img src="{{asset('').$user->profilePic}}">
        </div>
        <div class="commenter">
            <a href="">{{$user->name}}</a>
            <h1>{{$user->created_at}}</h1>
        </div>
    </div>

    @if(Auth::check())
    <div class="rateDiv">
        <h1>Rate This</h1>
        <div class="ratingStars">
            <form id="ratingsForm">
                <div class="stars">
                    <input type="radio" name="star_1" class="star-1" id="star-1" />
                    <label class="star-1" for="star-1">1</label>
                    <input type="radio" name="star_2" class="star-2" id="star-2" />
                    <label class="star-2" for="star-2">2</label>
                    <input type="radio" name="star_3" class="star-3" id="star-3" />
                    <label class="star-3" for="star-3">3</label>
                    <input type="radio" name="star_4" class="star-4" id="star-4" />
                    <label class="star-4" for="star-4">4</label>
                    <input type="radio" name="star_5" class="star-5" id="star-5" />
                    <label class="star-5" for="star-5">5</label>
                    <input type="radio" name="star_6" class="star-6" id="star-6" />
                    <label class="star-6" for="star-6">6</label>
                    <input type="radio" name="star_7" class="star-7" id="star-7" />
                    <label class="star-7" for="star-7">7</label>
                    <input type="radio" name="star_8" class="star-8" id="star-8" />
                    <label class="star-8" for="star-8">8</label>
                    <input type="radio" name="star_9" class="star-9" id="star-9" />
                    <label class="star-9" for="star-9">9</label>
                    <input type="radio" name="star_10" class="star-10" id="star-10" />
                    <label class="star-10" for="star-10">10</label>
                    <span></span>
                </div>
            </form>
        </div>
    </div>
    @endif
    <div class="clearfix"></div>
    <div class="mediumGap"></div>


    <div class="audioProfileCommentDiv">
        @if(Auth::check())
        <h1>Leave a comment</h1>
            <textarea class="commentTextArea" id="comArea" name="comArea"></textarea>
            <div class="clearfix"></div>
            <div class="form-group">
                <button class="commentSubmit commentSubmit_Success" id="cmtSubmit">Submit</button>
            </div>
        @endif
        <h1>Comments...</h1>
        <div class="hr1"><hr></div>
            <div class="commets" id="allcomments">
        @for($i=0; $i<sizeof($comments); $i++)
            <div class="singleComment">
                <div class="commentProPic">
                    <img src={{asset('').$commenter[$i]->profilePic}}>
                </div>
                <div class="commenter">
                    <a href="">{{$commenter[$i]->name}}</a>
                    <h1>{{$comments[$i]->created_at}}</h1>
                </div>

                <div class="voteDiv">
                    <div class="panel2 panel2-default">
                        <div class="panel2-footer">

                            <i id="like1" class="glyphicon glyphicon-thumbs-up" title={{$i}}></i><div id="{{"like".$i."-bs3"}}" class="{{$comments[$i]->_id}}">{{$comments[$i]->up}}</div>
                            <i id="dislike1" class="glyphicon glyphicon-thumbs-down" title={{$i}}></i> <div id="dislike1-bs3" class="{{$comments[$i]->_id}}">{{$comments[$i]->down}}</div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="hr2"><hr></div>

                <div class="commentText">
                    {{$comments[$i]->content}}
                </div>
                <div class="mediumGap"></div>
            </div>
        @endfor
            </div>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#cmtSubmit").on('click' , function(e){
        console.log("Hit");
        e.preventDefault();
        var content = $('#comArea').val();
        var user_id = -1;
            @if (Auth::check())
        {
            user_id = "{{ Auth::user()->id }}";
        }
                @endif
        var target_id = {!! json_encode($id) !!};
        var data = {comment:content, user_id:user_id, target_id:target_id};
        var pre = {!! json_encode(url('/')) !!};
        var url = pre+'/api/addComment';
        console.log(url , data);
        $.ajax({
            type:'POST',
            url:url,
            data:data,
            success:function(data){
                console.log("SSuccess" , data);
                var add = '<div class="singleComment">';
                pic = "{"+"{"+"asset(\'"+data.proPic+"\')}}";
                //console.log(pic);
                add = add + '<div class="commentProPic">';
                add = add + '<img src=' + pic + '>';
                //console.log(add);
                add = add + '</div>';
                add = add + '<div class="commenter">';
                add = add + '<a href="">'+data.userName+'</a>';
                add = add + '<h1>' + data.tym.date + '</h1>';
                add = add + '</div>';
//
                add = add + '<div class="voteDiv"><div class="panel2 panel2-default"> <div class="panel2-footer"> <i id="like1" class="glyphicon glyphicon-thumbs-up"></i> <div id="like1-bs3"></div> <i id="dislike1" class="glyphicon glyphicon-thumbs-down"></i> <div id="dislike1-bs3"></div> </div> </div> </div> <div class="clearfix"></div> <div class="hr2"><hr></div> <div class="commentText">';
                add = add + content;
                add = add + '</div>';
                add = add + '<div class="mediumGap"></div>';
//
                $('#allcomments').prepend(add);
                $('#comArea').val("");


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
            },
            error: function (data) {
                console.log('EError:', data);
            }
        });
    });

    $(".addToFavIcon").on('click' , function(e){
        console.log("Hit Fav Icon");
        e.preventDefault();
        var user_id = -1;
            @if (Auth::check())
        {
            user_id = "{{ Auth::user()->id }}";
        }
                @endif
        var target_id = {!! json_encode($id) !!};
        var data = {user_id:user_id, target_id:target_id};
        var pre = {!! json_encode(url('/')) !!};
        var url = pre+'/api/addToFav';
        console.log(url , data);
        $.ajax({
            type:'POST',
            url:url,
            data:data,
            success:function(data){
                console.log("Success" , data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    function updateRating(val){
        console.log("Hit star " , val);
        var user_id = -1;
            @if (Auth::check())
        {
            user_id = "{{ Auth::user()->id }}";
        }
                @endif
        var target_id = {!! json_encode($id) !!};
        var data = {user_id:user_id, target_id:target_id , given_rating: val};
        var pre = {!! json_encode(url('/')) !!};
        var url = pre+'/api/updateRating';
        console.log(url , data);
        $.ajax({
            type:'POST',
            url:url,
            data:data,
            success:function(data){
                console.log("Success" , data);
                var add = '<h5 id="rating">' + data.new_rating + '</h5>';
                $('#rating').replaceWith(add);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    $("input[name='star_1']").on('click' , function(e){
        e.preventDefault();
        updateRating(3);
    });

    $("input[name='star_2']").on('click' , function(e){
        e.preventDefault();
        updateRating(2);
    });

    $("input[name='star_3']").on('click' , function(e){
        e.preventDefault();
        updateRating(3);
    });

    $("input[name='star_4']").on('click' , function(e){
        e.preventDefault();
        updateRating(4);
    });

    $("input[name='star_5']").on('click' , function(e){
        e.preventDefault();
        updateRating(5);
    });

    $("input[name='star_6']").on('click' , function(e){
        e.preventDefault();
        updateRating(6);
    });

    $("input[name='star_7']").on('click' , function(e){
        e.preventDefault();
        updateRating(7);
    });

    $("input[name='star_8']").on('click' , function(e){
        e.preventDefault();
        updateRating(8);
    });

    $("input[name='star_9']").on('click' , function(e){
        e.preventDefault();
        updateRating(9);
    });

    $("input[name='star_10']").on('click' , function(e){
        e.preventDefault();
        updateRating(10);
    });

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
                    playing = true,
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
            audio.play();
        }
    });

    $(document).ready(function() {
        $('i.glyphicon-thumbs-up').click(function(){
            console.log("liked comment");
            var user_id = -1;
                @if (Auth::check())
            {
                user_id = "{{ Auth::user()->id }}";
            }
                    @endif

            var it = $(this).attr('title');
            console.log(it,data);
            var comments = {!! json_encode($comments) !!};
            console.log(comments[it]._id);
            var target_id = comments[it]._id;
            var pre = {!! json_encode(url('/')) !!};
            var url = pre+'/api/upComment';
            var data = {user_id:user_id, target_id:target_id};
            console.log(url , data);
            $.ajax({
                type:'POST',
                url:url,
                data:data,
                success:function(data){
                    var $this = $(this),
                            c = $this.data('count');
                    if (!c) c = 0;
                    c = data.up;
                    $this.data('count',c);
                    var iid = "like"+it;
                    $('#'+iid+'-bs3').html(c);
                    console.log('#'+iid+'-bs3');
                    console.log("Success" , data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('i.glyphicon-thumbs-down').click(function(){
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

    @if($fav == 1)
    $('.click').addClass('active');
    $('.click').addClass('active-2');
    setTimeout(function() {
        $('.click span').addClass('fa-heart');
        $('.click span').removeClass('fa-heart-o')
    }, 150);
    setTimeout(function() {
        $('.click').addClass('active-3')
    }, 150);

    @endif

    $('.click').click(function() {
        if ($('.click span').hasClass("fa-heart")) {
            $('.click').removeClass('active');
            setTimeout(function() {
                $('.click').removeClass('active-2')
            }, 30);
            $('.click').removeClass('active-3');
            setTimeout(function() {
                $('.click span').removeClass('fa-heart');
                $('.click span').addClass('fa-heart-o')
            }, 15)
        } else {
            $('.click').addClass('active');
            $('.click').addClass('active-2');
            setTimeout(function() {
                $('.click span').addClass('fa-heart');
                $('.click span').removeClass('fa-heart-o')
            }, 150);
            setTimeout(function() {
                $('.click').addClass('active-3')
            }, 150);
            $('.info').addClass('info-tog');
            setTimeout(function(){
                $('.info').removeClass('info-tog')
            },1000)
        }
    });

</script>

@endsection