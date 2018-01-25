<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\User;
use App\Audio;
use Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //echo "called".'<br>';
        $album = new Album();
        $album->title = $request->albumTitle;
        $album->audio_list = $request->audio_list;
        //foreach($album->audio_arr as $id) echo $id.'<br>';
        $user = Auth::user();
        $album->addedBy = $user->id;

        if($request->albumBack != null){
            $img = $request->albumBack;
            $name = $img->getClientOriginalName();
            $img->move('uploadedAlbumBack/' . $user->id , $name);
            $album->poster = 'uploadedAlbumBack/' . $user->id . "/" . $name;
        }
        else{
            $album->poster = 'images/albumDefault.jpg';
        }

        $album->save();
        return redirect('/');
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
        $album = Album::find($id);
        $uploaded_list = $album->audio_list;
        $audio_arr = [];
        $id_arr = [];
        $title_arr = [];
        $path_arr = [];
        for($i = 0 ; $i < sizeof($uploaded_list) ; $i++) {
            //echo $id_arr[$i].'<br>';
            $audio = Audio::find($uploaded_list[$i]);
            if($audio == null) continue;
            //echo $uploaded_list[$i]." ".$audio.'<br>';
            $id_arr = array_prepend($id_arr , $uploaded_list[$i]);
            $audio_arr = array_prepend($audio_arr , $audio);
            $title_arr = array_prepend($title_arr , $audio->title);
            $path_arr = array_prepend($path_arr , $audio->file_path);

        }

        $id_arr = array_reverse($id_arr);
        $title_arr = array_reverse($title_arr);
        $path_arr = array_reverse($path_arr);
//
        $playlist_title = "Songs of the Album:: ".$album->title;

//        echo $playlist_title.'<br>';
//        for($i = 0 ; $i < sizeof($audio_arr) ; $i++){
//            echo $id_arr[$i]." ".$title_arr[$i]." ".$path_arr[$i].'<br>';
//        }

        return view('MusicPlayer' , compact('id_arr' , 'title_arr' , 'path_arr' , 'playlist_title'));
    }

    public function showAll(){
        $albums = Album::orderBy('created_at' , 'desc')->paginate(15);
        $addedBy = [];
        foreach ($albums as $album){
            $user = User::find($album->addedBy);
            if($user == null) $user = 'N/A';
            else $user = $user->name;
            $addedBy = array_prepend($addedBy , $user);
        }
        $addedBy = array_reverse($addedBy);
        return view('AlbumList' , compact('albums' , 'addedBy'));
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
