<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Audio;
use App\User;
use App\Artist;
use App\Tag;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Comment;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "I'm the index ===> ";
        try {
            $user_id = Auth::user()->_id;
            $user = User::find($user_id);
            echo "logged in ".$user->name." ".$user_id;
        }catch(\Exception $e){
            echo "You are not logged in";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //echo "I'm the creator ===> ";
        return view('audio_upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        echo "called ===> ";
//        echo " ===> ".request()->audio.'<br>';
//        echo $request->audio->path().'<br>';
//        echo "called222 ===> ";
        $flag = true;
        try {
            $user_id = Auth::user()->_id;
        }catch(\Exception $e){
            echo "You are not logged in";
            $flag = false;
        }

        if($flag == true) {
            echo $request->audio->getClientOriginalName() . ' ===> <br>';
            if ($request->audio) {
                $audio = $request->audio;
                $ext = $audio->getClientOriginalExtension();
                if ($ext == 'mp3') {
                    //$name = $audio->getClientOriginalName();
                    $name = $request->songTitle.".".$ext;
                    echo $name . '<br>';
                    $audio->move('uploadedAudio/' . $user_id, $name);

                    $song = new Audio();
                    $song->title = $request->songTitle;
                    $song->save();

                    if ($request->description != null) $song->description = $request->description;
                    else $song->description = "No description added by uploader";

                    if ($request->songArtist != null){
                        $artist_arr = explode( ',' , $request->songArtist);
                        for($i = 0 ; $i < sizeof($artist_arr) ; $i++){
                            $artist_arr[$i] = trim($artist_arr[$i]);
                        }
                        $song->artist_arr = $artist_arr;

                        for($i = 0 ; $i < sizeof($artist_arr) ; $i++){
                            echo " ================> ".$artist_arr[$i]." ".strlen($artist_arr[$i]).'<br>';
                            $exp = '/.*'.$artist_arr[$i].'*/i';
                            $artist_match = Artist::where('name' , 'regexp' , $exp)->get();
                            $artist = null;
                            if(sizeof($artist_match) != 0){
                                foreach($artist_match as $art){
                                    echo " ------> ".$art->name." ".strlen($art->name).'<br>';
                                    if(strlen($art->name) == strlen($artist_arr[$i])){
                                        $artist = $art;
                                        break;
                                    }
                                }
                            }
                            if($artist == null){
                                $artist = new Artist();
                                $artist->name = $artist_arr[$i];
                                $artist->audio_list = [];
                                $artist->album_list = [];
                                $artist->description = "No description has been added";
//                                $artist->save();
                            }
                            $artist->audio_list = array_prepend($artist->audio_list , $song->_id);
                            $artist->save();
                        }
                    }
                    else $song->artist_arr = [];

                    if ($request->songGenre != null){
                        $tag_arr = explode( ',' , $request->songGenre);
                        for($i = 0 ; $i < sizeof($tag_arr) ; $i++){
                            $tag_arr[$i] = trim($tag_arr[$i]);
                        }
                        $song->tag_arr = $tag_arr;
                        if(sizeof($tag_arr) != 0) {
                            for ($i = 0; $i < sizeof($tag_arr); $i++) {
                                echo "===============> ".$tag_arr[$i]." ".strlen($tag_arr[$i]).'<br>';
                                $exp = '/.*' . $tag_arr[$i] . '*/i';
                                $tag_match = Tag::where('name', 'regexp', $exp)->get();
                                $tag = null;
                                if (sizeof($tag_match) != 0) {
                                    foreach ($tag_match as $tg) {
                                        echo "---> ".$tg->name." ".strlen($tg->name).'<br>';
                                        if (strlen($tg->name) == strlen($tag_arr[$i])) {
                                            $tag = $tg;
                                            break;
                                        }
                                    }
                                }
                                if ($tag == null) {
                                    $tag = new Tag();
                                    $tag->name = $tag_arr[$i];
                                    $tag->audio_list = [];
                                    $tag->album_list = [];
                                    $tag->description = "No description has been added";
//                                $artist->save();
                                }
                                $tag->audio_list = array_prepend($tag->audio_list, $song->_id);
                                $tag->save();
                            }
                        }
                    }
                    else $song->tag_arr = [];

                    $song->added_by = $user_id;

                    $song->users_given_rating = [];
                    $song->rating_arr = [];
                    $song->rating_sum = 0;
                    $song->rating = 0.0;

                    $song->users_listened = 0;
                    $song->file_path = 'uploadedAudio/' . $user_id . "/" . $name;

                    if($request->songBack != null){
                        $img = $request->songBack;
                        $name = $img->getClientOriginalName();
                        $img->move('uploadedAudioBack/' . $user_id, $name);
                        $song->poster = 'uploadedAudioBack/' . $user_id . "/" . $name;
                    }
                    $song->save();

                    $user = User::find($user_id);
                    $user->upload_list = array_prepend($user->upload_list , $song->id);
                    $user->save();
                    echo "successfully uploaded" . "<br>";
                } else {
                    echo "uploaded file is not mp3" . '<br>';
                }
                echo "Process terminated";
            } else {
                echo "No file has been uploaded";
            }
        }
    }

    public function updateRating(Request $request){
        $id = $request->target_id;
        $song = Audio::find($id);
        $user_id = $request->user_id;
        $len = sizeof($song->users_given_rating);
        $fl = false;
        for($i = 0 ; $i < $len ; $i++){
            if($song->users_given_rating[$i] == $user_id){
                $song->rating_sum -= $song->rating_arr[$i];
                $arr = $song->rating_arr;
                $arr[$i] = $request->given_rating;
                $song->rating_arr = $arr;
                $song->rating_sum += $song->rating_arr[$i];
                $fl = true;
                break;
            }
        }
        if($fl == false){
            $song->users_given_rating = array_prepend($song->users_given_rating , $user_id);
            $song->rating_arr = array_prepend($song->rating_arr , $request->given_rating);
            $song->rating_sum += $request->given_rating;
        }
        if(sizeof($song->rating_arr) > 0) $song->rating = $song->rating_sum/sizeof($song->rating_arr);
        else $song->rating = 0.0;
        $song->save();
        return response()->json(['success'=>'rating updated' , 'new_rating'=>$song->rating]);
    }
    public function updateHitNumber(Request $request){
        $id = $request->id;
        $audio = Audio::find($id);
        $audio->users_listened += 1;
        $audio->save();

        $user_id = $request->user_id;
        if($user_id != -1){
            $user = User::find($user_id);
            $arr = $user->listen_list;
            if (($key = array_search($id, $arr)) !== false) {
                unset($arr[$key]);
            }
            $user->listen_list = array_prepend($arr , $id);
            $user->save();
        }
        return response()->json(['success'=>'yesss hit number updated' , 'id'=>$audio->_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //echo "Hello ===> ".$id.'<br>';
        $audio = Audio::find($id);
        $user_id = $audio->added_by;
        $user = User::find($user_id);
        $allComments = Comment::where('target_id' , $id)->get();
        $comments = [];
        $commenter = [];
        foreach($allComments as $cmt){
            $comments = array_prepend($comments , $cmt);
            $user = User::find($cmt->user_id);
            $commenter = array_prepend($commenter , $user);
        }

        $title = $audio->title;
        $path = $audio->file_path;
//        foreach($comments as $cmt) {
//            echo $cmt->content.' ::'.$cmt->created_at."<br>";
//        }
        //$comments = array_reverse($comments);
        //echo $audio->rating;
        $fav = 0;
        try{
            $currentUser = Auth::user();
            if (($key = array_search($id, $currentUser->fav_list)) !== false) $fav = 1;
        }catch(\Exception $e){

        }
        //echo $id." ".$currentUser->_id." :: ".$fav;
        return view('SongProfile' , compact('audio' , 'user' , 'title' , 'path' , 'id' , 'comments' , 'commenter' , 'fav'));
    }

    public function showAudio(){
        $id = "5a366f7d2816813788003d75";
        $audio = Audio::find($id);
        $user_id = $audio->added_by;
        $user = User::find($user_id);
        //$comments = Comment::where('target_id' , '=' , $id);
        $title = $audio->title;
        $path = $audio->file_path;
        return view('SongProfile' , compact('audio' , 'user' , 'title' , 'path' , 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
