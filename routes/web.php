<?php
use App\Demo;
use App\User;
use App\Audio;
use App\Tag;
use App\Comment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/insert' , function(){
//    echo "called";
//    $demo = new Demo();
//    $demo->name = "arnab";
//    $demo->profile = "he is joss";
//    $demo->save();
//});

Route::get('/query' , function(){
    echo "testing testing 123".'<br>';
//    $users = User::orderBy('name')->get();
//    foreach($users as $usr) echo $usr->name." ".$usr->email.'<br>';
//
//    $query = User::whereIn('name', ['arnab' , 'mridul'])->get();
//    foreach($query as $data) {
////    $data->name = "arnab";
////    $data->save();
//        echo " >>>>> " . $data->name.'<br>';
//    }
//    $query = User::where('name' , '=' , 'test')->get();
//    foreach($query as $data) {
//        echo " --> " . $data->name.'<br>';
//    }
//    //echo User::count();
//    $usr = User::find("5a0a790f28168120e000608e");
////    $usr->favList = [10,12,14,15];
////    $usr->save();
//    $usr->favList = array_prepend($usr->favList , 15);
//    $usr->favList = array_prepend($usr->favList , "api");
//    foreach($usr->favList as $fav) echo $fav." ";
//    echo '<br>';
//    $usr->favList = array_diff($usr->favList , array(15 , 'api'));
//    foreach($usr->favList as $fav) echo $fav." ";
//    echo '<br>';
//    $usr->favList = array_slice($usr->favList , 0 , -1); // pop the last element
//    $usr->favList = array_slice($usr->favList , 1); // pop the first element
//    foreach($usr->favList as $fav) echo $fav." ";
//    $name = "Arnab,    Sen   ,   Sharma    ";
//    $arr = explode( ',' , $name);
//    foreach($arr as $nm) echo $nm."--".'<br>';
//    for($i = 0 ; $i < sizeof($arr) ; $i++){
//        $arr[$i] = trim($arr[$i]);
//    }
//    foreach($arr as $nm) echo " ===> ".$nm."--".'<br>';
//    $allSong = Audio::groupBy('title')->get(['title']);
//    echo(sizeof($allSong)).'<br>';
//    foreach($allSong as $song) echo $song.'<br>';
//    $allSong = Audio::orderBy('title')->get();
//    $sz = sizeof($allSong);
//    $title_arr = array_fill(0 , $sz , null);
//    $id_arr = array_fill(0 , $sz , null);
//
//    for($i = 0 ; $i < $sz ; $i++){
//        $title_arr[$i] = $allSong[$i]->title;
//        $id_arr[$i] = $allSong[$i]->_id;
//
//        echo $i." ".$id_arr[$i]." ".$title_arr[$i].'<br>';
//    }
//    $txt = "la";
//    $exp = '/.*'.$txt.'.*/i';
//    echo $exp.'<br>';
//    $allSong = Audio::where('title' , 'regexp' , $exp)->get();
//    $song = Audio::where('title' , 'regexp' , $exp)->first();
//    if($song != null) echo "========> " . $song->title . " " . strlen($song->title).'<br>';
//    else echo "Nothing Found".'<br>';
//
//    echo sizeof($allSong).'<br>';
//
//    foreach($allSong as $song) {
//        echo "====> " . $song->title . " " . strlen($song->title).'<br>';
//    }
//    echo "Finished";

//    $txt ="   Arnab   "; echo $txt." ".strlen($txt).'<br>';
//    $txt =trim($txt); echo $txt." ".strlen($txt).'<br>';



//    $user_id = "5a356260281681052000215a";
//    $id = "5a1ad5a928168117a000631a";
//    $user = User::find($user_id);
//    $arr = $user->listen_list;
//    if (($key = array_search($id, $arr)) !== false) {
//        echo "HI";
//        unset($arr[$key]);
//    }
//    $user->listen_list = array_prepend($arr , $id);
//    $user->save();
////
//    $arr = [1,2,3,4,5];
//    foreach($arr as $a) echo $a." ";
    //$arr = array_reverse($arr);
    //foreach($arr as $a) echo $a." ";
//    echo '<br>';
//    $fnd = 3;
//    if (($key = array_search($fnd,$arr)) !== false) {
//        unset($arr[$key]);
//    }
//    $arr = array_prepend($arr , $fnd);
//    foreach($arr as $a) echo $a." ";

//    $audio = Audio::all();
//    for($i = 0 ; $i < sizeof($audio) ; $i++){
//        $audio[$i]->rating = 0.0;
//        $audio[$i]->save();
//    }
    $comments = Comment::all();
    for($i = 0 ; $i < sizeof($comments) ; $i++) {
        $comments[$i]->up = 0;
        $comments[$i]->down = 0;
        $comments[$i]->upDownUsers = [];
        $comments[$i]->save();
    }
});

//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('audio' , 'AudioController');
Route::resource('search' , 'SearchController');
Route::resource('user' , 'UserController');
Route::post('/upload' , 'AudioController@store');

Route::get('/master', function () {
    return view('MasterLayout');
});

Route::get('/testHome', function () {
//    $allSong = Audio::orderBy('title')->get();
    $allSong = Audio::orderBy('users_listened' , 'desc')->get();
    $sz = sizeof($allSong);
    $title_arr = array_fill(0 , $sz , null);
    $id_arr = array_fill(0 , $sz , null);
    $path_arr = array_fill(0 , $sz , null);

    for($i = 0 ; $i < $sz ; $i++){
        $title_arr[$i] = $allSong[$i]->title;
        $id_arr[$i] = $allSong[$i]->_id;
        $path_arr[$i] = $allSong[$i]->file_path;

        //echo $i." ".$id_arr[$i]." ".$title_arr[$i].'<br>';
    }


    return view('HomePageTest' , compact('title_arr' , 'id_arr', 'path_arr'));
});

Route::get('/audioProfile', function () {
    return view('SongProfile');
});

Route::get('/showAudio','AudioController@showAudio');

Route::get('/', function () {

    $allSong = Audio::orderBy('users_listened' , 'desc')->get();
//    $recommendedSong = $allSong;
    //$allSong = Audio::all();
    $limit = 15;
    $limit = min(sizeof($allSong) , $limit);
    if(Auth::check() == false){
        $recommendedSong = [];
        for($i = 0 ; $i < $limit ; $i++){
            $recommendedSong = array_prepend($recommendedSong , $allSong[$i]);
        }
        $recommendedSong = array_reverse($recommendedSong);
    }
    else{
//        $user = Auth::user();
//        $listenedSong = Audio::whereIn('_id' , $user->listen_list)->get();
//        $map = [];
//        $allTag = Tag::all();
//        foreach($allTag as $tag) $map[$tag->name] = 0;
//        for($i = 0 ; $i < $limit && $i < sizeof($listenedSong) ; $i++){
//            $song = $listenedSong[$i];
//            $tags = $song->tag_arr;
//            foreach($tags as $tg) {
//                echo $tg.", ";
//                try {
//                    $map[$tg]++;
//                }catch(\Exception $e){}
//            }
//            echo '<br>';
//        }
//        foreach($allTag as $tag) echo $tag->name." ".$map[$tag->name].'<br>';
        $recommendedSong = [];
        for($i = 0 ; $i < $limit ; $i++){
            $recommendedSong = array_prepend($recommendedSong , $allSong[$i]);
        }
        $recommendedSong = array_reverse($recommendedSong);
    }

    $sz = min(sizeof($recommendedSong) , $limit);
    //echo $sz;
    $artist_arr = [];

    $lim = 35;
    for($i = 0 ; $i < $sz; $i++){
        $art = "";
        $song = $recommendedSong[$i];
        for($j = 0 ; $j < sizeof($song->artist_arr) ; $j++){
            if(strlen($art) + strlen($song->artist_arr[$j]) > $lim){
                for($k = 0 ; $k < strlen($song->artist_arr[$j]) ; $k++){
                    $art = $art.$song->artist_arr[$j][$k];
                    if(strlen($art) == $lim){
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
        $artist_arr = array_prepend($artist_arr , $art);
//        echo $i." ".$song->title.' ==> '.$artist_arr[$i]." :: ";
//        foreach($song->artist_arr as $art) echo $art.", ";
//        echo '<br>';
    }

    //echo "found".'<br>';
    $artist_arr = array_reverse($artist_arr);
    //echo sizeof($artist_arr)."<br>";
    //for($i = 0 ; $i<$limit ; $i++) echo $i." ".$recommendedSong[$i]->title." :: ".$artist_arr[$i]."<br>";
    return view('HomePage' , compact('recommendedSong' , 'artist_arr'));
});

Route::get('/temp', function () {
    return view('temp');
});

Route::get('/laravelHome', function () {
    return view('home');
});

Route::get('/laravelWelcome', function () {
    return view('welcome');
});

Route::get('/upload', function () {
    return view('UploadSong');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/userProfile/{id}', 'UserController@show');
Route::get('/musicPlayer' , function(){
    $audio_arr = Audio::orderBy('users_listened' , 'desc')->get();
    $title_arr = [];
    $path_arr = [];
    $id_arr = [];
    foreach($audio_arr as $audio){
        $id_arr = array_prepend($id_arr , $audio->_id);
        $title_arr = array_prepend($title_arr , $audio->title);
        $path_arr = array_prepend($path_arr , $audio->file_path);
    }
    $title_arr = array_reverse($title_arr);
    $path_arr = array_reverse($path_arr);
    $id_arr = array_reverse($id_arr);

    $playlist_title = "My Playlist";
    $test = ['api','mri'];
    return view('MusicPlayer' , compact('id_arr' , 'title_arr' , 'path_arr' , 'playlist_title' , 'test'));
});

Route::get('/updateUserProfile/{id}', 'UserController@viewUpdateUserPage');
Route::post('addComment', 'CommentController@addComment');

Route::post('/searchResult', 'SearchController@showSearchResult');

Route::post('/saveEdited' , 'UserController@saveEdited');
Route::get('ajaxRequest', 'HomeController@ajaxRequest');
Route::post('ajaxRequest', 'HomeController@ajaxRequestPost');
Route::post('ajaxTestDelete/{id}', 'HomeController@ajaxTestDelete');