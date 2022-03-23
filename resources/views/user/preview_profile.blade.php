<!DOCTYPE html>
<html>
    <head>
        <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <title>Hexio</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <style>
            
            body 
            {
                font-family: 'Roboto';
            }
            img {
                image-rendering: pixelated;
                -ms-interpolation-mode: nearest-neighbor;
            }
        </style>
    </head>
    <body style="100%">
        <!-- Preview -->
        <div class="row col-12 mx-0">
            <div class="col-12 col-sm-1 col-md-2 col-lg-2 "></div>
            <div class="col-12 col-sm-10 col-md-8 col-lg-8 px-0">
                <div id="background-canvas" class="col-12 px-0 pb-4 pt-5 mb-0" style="min-height:90vh; background-color: {{ $data->background_color ?? '#ffffff' }};">
                    <!-- CONTENT -->
                    <div class="row col-12 mr-0 pr-0">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4 px-0">
                            <img id="preview-image" style="border:solid {{ $data->frame_color ?? '#ffffff' }} 2px ; object-fit: cover;" width="150px" height="150PX" src="{{$data->photo ? env('APP_URL').$data->photo : asset('assets/default_image.png') }}" class="rounded-circle" alt="Cinque Terre">
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-8 pt-5 px-0 text-right">
                            <a href="{{url('download_vcard_preview')}}" id="preview-save-contact" style="background-color: {{ $data->save_color ?? '#343A40' }};" class="btn btn-lg btn-dark border-0">SAVE CONTACT</a>
                        </div>
                    </div>
                    <br>
                    <p class="mb-0"><b id="preview-name">{{$data->name}}</b></p>
                    <p id="full-preview-username" style="display: {{$data->is_username_displayed ? '' : 'none'}}"  style="font-size:12px">@<span id="preview-username">{{$data->username}}</span></p>
                    <p id="preview-bio">{{$data->bio}}</p>
                    <p id="full-preview-address" style="display: {{$data->is_address_displayed ? '' : 'none'}}"><i class="fa-solid fa-location-dot"></i><span id="preview-address">{{$data->address}}</span></p>
                           
                    <div id="container-list-preview">
                        @foreach($list_contents as $content)
                            @if($content->content_type_id == 1)
                                <div id="div-preview-item-{{$content->id}}" style="display: {{$content->is_content_displayed ? '' : 'none'}}">
                                    <a href="{{$content->linkType->prefix.$content->link}}" target="_blank" id="preview-item-button-name-{{$content->id}}" data-text-color="{{$content->text_color}}" data-button-color="{{$content->button_color}}" class="btn btn-dark btn-lg col-12 mb-3 border-0" style="background-color: {{$content->button_color}}">
                                        <i id="preview-icon-{{$content->id}}" class="{{$content->linkType->icon}}" style="display: {{$content->is_icon_displayed ? '' : 'none'}}"></i> 
                                        <span id="preview-text-button-name-{{$content->id}}" style="color: {{$content->text_color}}">{{$content->text}}</span>  
                                    </a>
                                </div>
                            @elseif($content->content_type_id == 2)
                                <br>
                            @else
                                <div id="div-preview-item-{{$content->id}}" data-text-align="{{$content->text_align}}" style="text-align: {{$content->text_align}}">
                                    <p id="list-preview-item-{{$content->id}}" data-text-color="{{$content->text_color}}" style="color: {{$content->text_color}}">{{$content->text}}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                
                <div style="height:10vh; background-color: {{ $data->background_color ?? '#ffffff' }};" class="d-flex justify-content-center align-items-end pb-4">
                    <img src="{{asset('images/logo_black_v2.svg')}}" width="100" alt="">
                </div>
            </div>
            <div class="col-12 col-sm-1 col-md-2 col-lg-2"></div>
        </div>
    </body>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- <script src="{{asset('bootstrap/js/jquery-3.2.1.slim.min.js')}}"></script> -->
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
</html>



