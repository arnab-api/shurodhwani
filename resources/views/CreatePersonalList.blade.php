@extends('MasterLayout')
@section('content')
<div class="container">
    <div class="registerArea">
        <div class="uploadAlbumDiv">
            <div class="uploadTitle">
                Create Playlist
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body" id="MakeAlbum">
                        {!! Form::open(
                        array(
                        'method'=>'POST',
                        'route' => 'audio.store',
                        'class' => 'form',
                        'novalidate' => 'novalidate',
                        'files' => true)) !!}
                        <div class="mediumGap"></div>
                        
                        <label class="col-md-4 control-label">Playlist Title</label>
                        <div class="col-md-6">
                            <input id="songTitle" type="text" class="songUploadDiv" name="songTitle" required autofocus>
                            <div class="gap"></div>
                        </div>
                        <div class="clearfix"></div>
                        
                        
                        
                        <div class="makeAlbumAudioChoose">
                            <label class="col-md-4 control-label">Select Audio</label>
                            <select class="select2-selection--multiple" multiple="multiple">
                                <option value="architecture">Architecture</option>
                                <option value="forest">Forest</option>
                                <option value="green">Green</option>
                                <option value="heritage">Heritage</option>
                                <option value="hills">Hills</option>
                                <option value="lake">Lake</option>
                                <option value="river">River</option>
                                <option value="riverside">Riverside</option>
                                <option value="sea">Sea</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="songUploadButton">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="footerGap"></div>
    </div>
</div>
</div>
@endsection