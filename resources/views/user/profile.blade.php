@extends("user.user_home_template")

@section("content")
    <style>
        .main {
            border-radius: 190px;
            height: 100px;
            width: 100px;
        }

        .btm {
            height: 51px;
            background-color: #80C5A0;
            border-radius: 50% / 100%;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            background: linear-gradient(to top, rgb(196,196,196) 65%, rgba(0, 0, 0, 0) 35%);
            z-index: 99999;
            position: relative;
            cursor: pointer;
        }
    </style>
    <div class="row mt-4 col-12 mx-0 px-3 px-lg-5">
        <div class="shadow mb-5 bg-white rounded col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card-body">
                <form action="{{url('page/update-profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <p>Foto</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <label for="image">
                            <input type="file" name="image" readonly id="image" onchange="onChangeImage(this)" style="display:none;"/>
                        </label>

                        <div id="container-image-profile" style="position: relative;">
                            <div class="main">
                                <div style="height: 50px;">
                                    <img id="input-profile-image" style="object-fit: cover;" class="rounded-circle" height="100" width="100" src="{{$data->photo ? env('APP_URL').$data->photo : asset('assets/default_image.png') }}" alt="">
                                </div>
                                <div data-toggle="modal" data-target="#exampleModal" class="btm text-center">
                                    <div style="height:10px; background-color:transparant"></div>
                                    <div style="padding-top:10px; font-size:14px">
                                        <p>Edit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" value="{{old('name', $data->name)}}" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control " name="bio" id="bio" cols="30" rows="3" placeholder="Bio">{{old('bio', $data->bio)}}</textarea>
                        </div>
                        <div class="row col-12 m-0 px-0">
                            <div class="form-group col-10 col-sm-10 col-md-11 col-lg-11 px-0">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" value="{{old('address', $data->address)}}" name="address" class="form-control" placeholder="Address">
                            </div>

                            <div class="custom-control custom-switch col-2 col-sm-2 col-md-1 col-lg-1 d-flex align-items-center justify-content-end pb-3 px-0">
                                <input type="checkbox" class="custom-control-input" name="is_address_displayed" id="is_address_displayed" style="transform: scale(2);" {{$data->is_address_displayed ? 'checked' : ''}}>
                                <label style="cursor: pointer;" class="custom-control-label" for="is_address_displayed"></label>
                            </div>
                        </div>
                        <div class="row col-12 m-0 px-0">
                            <div class="form-group col-10 col-sm-10 col-md-11 col-lg-11 px-0">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" value="{{old('username', $data->username)}}" name="username" class="form-control" placeholder="Username">
                            </div>

                            <div class="custom-control custom-switch col-2 col-sm-2 col-md-1 col-lg-1 d-flex align-items-center justify-content-end pb-3 px-0">
                                <input type="checkbox" class="custom-control-input" name="is_username_displayed" id="is_username_displayed" style="transform: scale(2);" {{$data->is_username_displayed ? 'checked' : ''}}>
                                <label style="cursor: pointer;" class="custom-control-label" for="is_username_displayed"></label>
                            </div>
                        </div>

                        <div class="row col-12 mb-2" >
                            <div class="pl-0 mb-2 col-lg-4 col-md-6 col-sm-6 col-12">
                                <p class="mb-0">Frame Color</p>
                                <a href="#" onclick="myFunction(1)"><img height="20px" src="{{asset('images/paint.png')}}" alt=""></a>
                                <input type="text" data-coloris style="width:10px;  style="visibility:hidden" name="frame_color" value="{{old('frame_color', $data->frame_color ?? '#ffffff')}}" id="fontColorButton1" title="Change Font Color" colorpick-eyedropper-active="true" />
                            </div>
                            <div class="pl-0 mb-2 col-lg-4 col-md-6 col-sm-6 col-12">
                                <p class="mb-0">Background Color</p>
                                <a href="#" onclick="myFunction(2)"><img height="20px" src="{{asset('images/paint.png')}}" alt=""></a>
                                <input type="text" data-coloris style="width:10px; visibility:hidden" name="background_color" value="{{old('background_color', $data->background_color ?? '#ffffff')}}" id="fontColorButton2" title="Change Font Color" colorpick-eyedropper-active="true" />
                            </div>
                            <div class="pl-0 mb-2 col-lg-4 col-md-12 col-sm-12 col-12">
                                <p class="mb-0">Save Button Color</p>
                                <a href="#" onclick="myFunction(3)"><img height="20px" src="{{asset('images/paint.png')}}" alt=""></a>
                                <input type="text" data-coloris style="width:10px;  style="visibility:hidden" name="save_color" id="fontColorButton3" title="Change Font Color" colorpick-eyedropper-active="true" />
                            </div>
                        </div>
                        <div class="w-100 mb-5">
                            <button id="default-btn" type="button" class="btn btn-dark btn-sm float-left">Default</button>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-dark btn-md px-5 float-right" style="margin-bottom:20px">SAVE</button>
                </form>



            </div>
        </div>

         <!-- Preview -->
         <div class="p-1 mb-5 col-lg-6 col-md-12 col-sm-12 col-12 px-0" style="min-height: 600px;">
            <div class="col-12 text-right pr-0">
                <a href="{{url('page/preview')}}" target="_blank" class="btn btn-md btn-dark">PREVIEW</a>
            </div>
            <br>
            <div  class="w-100 d-flex justify-content-center" >
                <div class="col-lg-10 col-md-6 col-sm -12 col-12 mt-3" style="background-color: #C4C4C4; border-radius: 40px; max-width:400px">
                    <div class="w-100 d-flex justify-content-center mt-3" style="height:15px">
                        <div class="col-5" height="30px" style="background-color: #696969; border-radius: 40px;">
                        </div>
                    </div>

                    <div class="w-100 d-flex justify-content-center mt-3">
                        <div id="background-canvas" class="col-12 px-0 py-0 mb-3" style="height:570px; overflow: hidden; background-color: {{ $data->background_color ?? '#ffffff' }}; border-radius: 40px;">
                            <div class="px-3 py-4" style="height:570px; overflow:auto">
                                <!-- CONTENT -->
                                <div class="row col-12 mx-0 px-0">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 px-0">
                                        <img id="preview-image" style="border:solid {{ $data->frame_color ?? '#ffffff' }} 2px ; object-fit: cover;" width="95px" height="95PX" src="{{$data->photo ? env('APP_URL').$data->photo : asset('assets/default_image.png') }}" class="rounded-circle" alt="Cinque Terre">
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 pt-4 px-0 text-right">
                                        <a href="{{url('page/download_vcard_preview')}}" id="preview-save-contact" style="background-color: {{ $data->save_color ?? '#262626' }};" class="mt-2 btn btn-sm btn-dark border-0">SAVE CONTACT</a>
                                    </div>
                                </div>
                                <br>
                                <p class="mb-0"><b id="preview-name">{{$data->name}}</b></p>
                                <p id="full-preview-username" style="display: {{$data->is_username_displayed ? '' : 'none'}}"  style="font-size:12px">@<span id="preview-username">{{$data->username}}</span></p>
                                <p id="preview-bio" style="white-space: pre-wrap; line-height: 1.1;">{{$data->bio}}</p>
                                <p class="mb-2" id="full-preview-address" style="display: {{$data->is_address_displayed ? '' : 'none'}}"><i class="fa-solid fa-map-pin"></i><span id="preview-address" class="pl-2">{{$data->address}}</span></p>
                                <br>
                                <div id="container-list-preview">
                                    @foreach($list_contents as $content)
                                        @if($content->content_type_id == 1)
                                            <div id="div-preview-item-{{$content->id}}" style="display: {{$content->is_content_displayed ? '' : 'none'}}">
                                                <a href="{{$content->linkType->prefix.$content->link}}" target="_blank" id="preview-item-button-name-{{$content->id}}" data-text-color="{{$content->text_color}}" data-button-color="{{$content->button_color}}" class="btn-preview btn btn-dark col-12 mb-3 border-0" style="min-height:37px; background-color: {{$content->button_color}}">
                                                    <div class="justify-content-center row mx-0">
                                                        <i id="preview-icon-{{$content->id}}" class="my-1 {{$content->linkType->icon}}" style="display: {{$content->is_icon_displayed ? '' : 'none'}}"></i>
                                                        <span class="px-1" id="preview-text-button-name-{{$content->id}}" style="max-width:90%; color: {{$content->text_color}}">{{$content->text}}</span>
                                                    </div>
                                                </a>
                                            </div>
                                        @elseif($content->content_type_id == 2)
                                            <br>
                                        @else
                                            <div id="div-preview-item-{{$content->id}}" data-real_id="{{$content->id}}" data-text-align="{{$content->text_align}}" style="text-align: {{$content->text_align}}">
                                                @if($content->is_underline)
                                                    <U>
                                                        <p class="{{$content->is_bold ? 'font-weight-bold' : ''}} {{$content->is_italic ? 'font-italic' : ''}} " id="list-preview-item-{{$content->id}}" data-text-color="{{$content->text_color}}" style="color: {{$content->text_color}}">{{$content->text}}</p>
                                                    </U>
                                                @else
                                                    <p class="{{$content->is_bold ? 'font-weight-bold' : ''}} {{$content->is_italic ? 'font-italic' : ''}} " id="list-preview-item-{{$content->id}}" data-text-color="{{$content->text_color}}" style="color: {{$content->text_color}}">{{$content->text}}</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Modal Upload Foto-->
    <div style="z-index: 999999" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Perbarui Foto Profil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="container-croppie" style="display:none">

            </div>
            <span class="col-12 btn btn-success btn-file">
                Browse <input id="input-image" type="file">
            </span>
        </div>
        <div class="modal-footer">
            <button type="button" id="close-btn" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="save-changes" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('plugins/croppie/croppie.css')}}" />
    <script src="{{asset('plugins/croppie/croppie.js')}}"></script>
    <script>


        var image_crop = $('#container-croppie').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#input-image').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                image_crop.croppie('bind', {
                    url: event.target.result,
                });
            }
            reader.readAsDataURL(this.files[0]);
            $("#container-croppie").css("display", "");
        });

        $("#save-changes").on("click", function(){
            if($("#input-image").val() != null){
                image_crop.croppie('result', {type: 'blob', format: 'png'}).then(function(blob) {
                    document.getElementById('input-profile-image').src = window.URL.createObjectURL(blob);
                    document.getElementById('preview-image').src = window.URL.createObjectURL(blob);
                    let file = new File([blob], "img.jpg",{type:"image/png", lastModified:new Date().getTime()});
                    let container = new DataTransfer();
                    container.items.add(file);
                    fileInputElement = document.getElementById("image");
                    fileInputElement.files = container.files;
                });
            }
            $('#close-btn').trigger("click");
        })


        function myFunction(id) {
            document.getElementById("fontColorButton"+id).click();
            event.preventDefault();
        }

        // On Frame color changed
        $("#fontColorButton1").change(function(){
            $("#preview-image").css("border", "solid "+$(this).val()+" 2px");
        })

        // On background color changed
        $("#fontColorButton2").change(function(){
            $("#background-canvas").css("background-color", $(this).val());
        })

        // On save contact color changed
        $("#fontColorButton3").change(function(){
            $("#preview-save-contact").css("background-color", $(this).val());
        })

        // IF username changed
        $("#is_username_displayed").change(function(){
            if($(this).is(":checked")){
                $("#full-preview-username").css("display", '');
                $("#preview-username").css("display", '');
            }else{
                $("#full-preview-username").css("display", 'none');
                $("#preview-username").css("display", 'none');
            }
        })

        // IF address changed
        $("#is_address_displayed").change(function(){
            if($(this).is(":checked")){
                $("#full-preview-address").css("display", '');
                $("#preview-address").css("display", '');
            }else{
                $("#full-preview-address").css("display", 'none');
                $("#preview-address").css("display", 'none');
            }
        })

        // On Name changed
        $("#name").change(function(){
            $("#preview-name").text($(this).val())
        })

        // On username changed
        $("#username").change(function(){
            $("#preview-username").text($(this).val())
        })

        // On address changed
        $("#address").change(function(){
            $("#preview-address").text($(this).val())
        })

        // On bio changed
        $("#bio").change(function(){
            console.log($(this).val());
            $("#preview-bio").text($( this ).val() )
        })

        // On default button change
        $("#default-btn").click(function(){
            $("#fontColorButton1").val("#ffffff");
            $("#fontColorButton2").val("#ffffff");
            $("#fontColorButton3").val("#262626");

            $("#preview-image").css("border", "solid #ffffff 2px");
            $("#background-canvas").css("background-color", "#ffffff");
            $("#preview-save-contact").css("background-color", "#262626");

        });

        function onChangeImage(e){
            document.getElementById('input-profile-image').src = window.URL.createObjectURL(e.files[0]);
            document.getElementById('preview-image').src = window.URL.createObjectURL(e.files[0]);
        }


    </script>
@endsection
