<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Audio;

class UserController extends Controller
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
        $user = User::find($id);
        $allSong = Audio::all();
        $uploaded_song = [];
//        $uploaded_song = Audio::where('added_by' , 'id')->get();
        for($i = 0 ; $i < sizeof($allSong) ; $i++){
            $song = $allSong[$i];
            if($song->added_by == $id) {
                $uploaded_song = array_prepend($uploaded_song , $song);
                //echo $song->title.'<br>';
            }
        }
//        echo " ====> ".$user->id.'<br>';
//        foreach($uploaded_song as $song){
//            echo $song->title.'<br>';
//        }
        $recentList = [];
        $artistArr = [];
        $limit = 40;
        for($i = 0 ; $i<10 && $i<sizeof($user->listen_list) ; $i++) {
            $song = Audio::find($user->listen_list[$i]);
            $recentList = array_prepend($recentList , $song);
            $art = "";
            for($j = 0 ; $j < sizeof($song->artist_arr) ; $j++){
                if(strlen($art) + strlen($song->artist_arr[$j]) > $limit){
                    for($k = 0 ; $k < strlen($song->artist_arr[$j]) ; $k++){
                        $art = $art.$song->artist_arr[$j][$k];
                        if(strlen($art) == $limit){
                            $art = $art." ....";
                            break;
                        }
                    }
                }
                else{
                    if($j > 0) $art = $art." ";
                    $art = $art.$song->artist_arr[$j];
                    if($j < sizeof($song->artist_arr) - 1) $art = $art.",";
                }
            }
            $artistArr = array_prepend($artistArr , $art);
            //for($j = 0 ; $j < sizeof($song->artist_arr) ; $j++) echo $song->artist_arr[$j].", ";
            //echo " :::==>".$song->title." ".$art."<br>";
        }
        $recentList = array_reverse($recentList);
        $artistArr = array_reverse($artistArr);
        return view('UserProfile' , compact('user' , 'uploaded_song' , 'recentList' , 'artistArr'));
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
    public function viewUpdateUserPage($id){
        $user = User::find($id);
        return view('UpdateUserProfile' , compact('user'));
    }

    public function saveEdited(Request $request){
        $id = $request->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->about_me = $request->aboutMe;

        //echo $id." ".$name;
        if($request->proPic != null){
            $img = $request->proPic;
            $name = $img->getClientOriginalName();
            $img->move('profilePic/' . $user->_id, $name);
            $user->profilePic = 'profilePic/' . $user->_id . "/" . $name;
        }
        $user->save();
        return redirect('/user/'.$request->id);
    }

    public function addToFav(Request $request)
    {
        $user_id = $request->user_id;
        $target_id = $request->target_id;
        $user = User::find($user_id);
        $arr = $user->fav_list;
        if (($key = array_search($target_id, $arr)) !== false) {
            unset($arr[$key]);
        }
        else $arr = array_prepend($arr ,  $target_id);
        $user->fav_list = $arr;
        $user->save();
        return response()->json(['success'=>'fav_list updated']);
    }

    public function update(Request $request , $id)
    {
        //
        echo "called ".$id;
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
