@extends('MasterLayout')
@section('content')
<div class="container">
    <div class="registerArea">
        <div class="uploadAlbumDiv">
        <div class="songDeleteButton"><img src="{{asset('images/delete.png')}}" title="Remove This Album"></div>
            <div class="uploadTitle">
                Update Album
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
                        
                        <label class="col-md-4 control-label">Album Title</label>
                        <div class="col-md-6">
                            <input id="songTitle" type="text" class="songUploadDiv" name="songTitle" required autofocus value="Previuos Title">
                            <div class="gap"></div>
                        </div>
                        <div class="clearfix"></div>

                        
                          
      
    <div class="makeAlbumAudioChoose">
    <label class="col-md-4 control-label">Select Audio</label>
      <select class="select2-selection--multiple" multiple="multiple" id="selectBox">
        <option value="architecture"  >Architecture</option>
        <option value="forest" >Forest</option>
        <option value="green">Green</option>
        <option value="heritage">Heritage</option>
        <option value="hills">Hills</option>
        <option value="lake">Lake</option>
        <option value="river">River</option>
        <option value="riverside">Riverside</option>
        <option value="sea">Sea</option>
      </select>
    </div>

                         <div class="mediumGap"></div>

                         <label class="col-md-4 control-label">Poster</label>
                         <div class="col-md-6">
                             <input id="songBack" class="chooseAudio" type="file" name="songBack" required autofocus>
                             <div class="ajaira">(Just leave it if you don't want to change)</div>
                             <div class="mediumGap"></div>
                         </div>
                        
                        <div class="col-md-6">
                            <div class="songUploadButton">
                                <button type="submit" class="btn btn-primary">Update</button>
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

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#selectBox').val(['architecture', 'forest', 'green']);
    $('#selectBox').trigger('change');
});

</script>