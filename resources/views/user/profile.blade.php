@extends("user.user_home_template")

@section("content")
    <div class="row mt-4 col-12 px-5">
        <div class="shadow p-1 mb-5 bg-white rounded col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card-body">
                
            <form action="{{url('/update-profile')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-center">
                    <p>Foto</p>
                </div>
                <div class="d-flex justify-content-center">
                    <label for="image">
                        <input type="file" name="image" id="image" style="display:none;" onchange="onChangeImage(this)"/>
                        <img id="input-profile-image" height="100" src="{{$data->photo ? env('APP_URL').$data->photo : asset('assets/default_image.png') }}" alt="">
                    </label>
                </div>

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" value="{{old('name', $data->name)}}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="bio" class="form-label">Bio</label>
                        <input type="text" id="bio" value="{{old('bio', $data->bio)}}" name="bio" class="form-control" placeholder="Bio">
                    </div>
                    <div class="row col-12 m-0 px-0">
                        <div class="form-group col-11 px-0">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" value="{{old('address', $data->address)}}" name="address" class="form-control" placeholder="Address">
                        </div>
                        
                        <div class="custom-control custom-switch col-1 d-flex d-flex align-items-center pb-3 pl-5 float-right">
                            <input type="checkbox" class="custom-control-input" name="is_address_displayed" id="is_address_displayed" style="transform: scale(2);" {{$data->is_address_displayed ? 'checked' : ''}}>
                            <label class="custom-control-label" for="is_address_displayed"></label>
                        </div>
                    </div>
                    <div class="row col-12 m-0 px-0">
                        <div class="form-group col-11 px-0">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" value="{{old('username', $data->username)}}" name="username" class="form-control" placeholder="Username">
                        </div>
                        
                        <div class="custom-control custom-switch col-1 d-flex d-flex align-items-center pb-3 pl-5 float-right">
                            <input type="checkbox" class="custom-control-input" name="is_username_displayed" id="is_username_displayed" style="transform: scale(2);" {{$data->is_username_displayed ? 'checked' : ''}}>
                            <label class="custom-control-label" for="is_username_displayed"></label>
                        </div>
                    </div>

                    <div class="row col-12 mb-2" >
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <p class="mb-0">Frame Color</p>
                            <a href="#" onclick="myFunction(1)"><img height="20px" src="{{asset('images/paint.png')}}" alt=""></a>
                            <input type="color" style="visibility:hidden" name="frame_color" value="{{old('frame_color', $data->frame_color ?? '#ffffff')}}" id="fontColorButton1" title="Change Font Color" colorpick-eyedropper-active="true" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <p class="mb-0">Background Color</p>
                            <a href="#" onclick="myFunction(2)"><img height="20px" src="{{asset('images/paint.png')}}" alt=""></a>
                            <input type="color" style="visibility:hidden" name="background_color" value="{{old('background_color', $data->background_color ?? '#ffffff')}}" id="fontColorButton2" title="Change Font Color" colorpick-eyedropper-active="true" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <p class="mb-0">Button Save Color</p>
                            <a href="#" onclick="myFunction(3)"><img height="20px" src="{{asset('images/paint.png')}}" alt=""></a>
                            <input type="color" style="visibility:hidden" name="save_color" id="fontColorButton3" title="Change Font Color" colorpick-eyedropper-active="true" />
                        </div>
                    </div>
                    <div class="w-100 mb-5">
                        
                        <button id="default-btn" type="button" class="btn btn-dark btn-sm float-left">Default</button>
                    </div>


                    <button type="submit" class="btn btn-dark btn-md col-3 float-right mb-3">SAVE</button>
            </form>
                


            </div>
        </div>

        <!-- Preview -->
        <div class="p-1 mb-5 col-lg-6 col-md-12 col-sm-12 col-12" style="min-height: 600px;">
            <div class="col-12">
                <a href="{{url('preview')}}" target="_blank" class="btn btn-md btn-dark float-right">PREVIEW</a>
            </div>
            <br>
            <div  class="w-100 d-flex justify-content-center" >
                <div class="col-lg-10 col-md-6 col-sm -12 col-12 mt-3" style="background-color: #C4C4C4; border-radius: 40px; max-width:400px">
                    <div class="w-100 d-flex justify-content-center mt-3" style="height:15px">
                        <div class="col-5" height="30px" style="background-color: #696969; border-radius: 40px;">
                        </div>
                    </div>

                    <div class="w-100 d-flex justify-content-center mt-3" >
                        <div id="background-canvas" class="col-12 px-3 py-4 mb-3" height="30px" style="background-color: {{ $data->background_color ?? '#ffffff' }}; border-radius: 40px;">
                            <!-- CONTENT -->
                            <div class="row col-12 mr-0 pr-0">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                    <img id="preview-image" style="border:solid {{ $data->frame_color ?? '#ffffff' }} 2px ; object-fit: cover;" width="75px" height="75PX" src="{{$data->photo ? env('APP_URL').$data->photo : asset('assets/default_image.png') }}" class="rounded-circle" alt="Cinque Terre">
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-8 pt-3 text-right">
                                    <a href="{{url('download_vcard_preview')}}" id="preview-save-contact" style="background-color: {{ $data->save_color ?? '#343A40' }};" class="btn btn-sm btn-dark">SAVE CONTACT</a>
                                </div>
                            </div>

                            <p class="mb-0"><b id="preview-name">{{$data->name}}</b></p>
                            <p id="full-preview-username" style="display: {{$data->is_username_displayed ? '' : 'none'}}"  style="font-size:12px">@<span id="preview-username">{{$data->username}}</span></p>
                            <p id="preview-bio">{{$data->bio}}</p>
                            <p id="full-preview-address" style="display: {{$data->is_address_displayed ? '' : 'none'}}"><i class="fa-solid fa-location-dot"></i><span id="preview-address" class="pl-1">{{$data->address}}</span></p>
                           
                            <div id="container-list-preview">
                                @foreach($list_contents as $content)
                                    @if($content->content_type_id == 1)
                                        <div id="div-preview-item-{{$content->id}}" style="display: {{$content->is_content_displayed ? '' : 'none'}}">
                                            <a href="{{$content->linkType->prefix.$content->link}}" target="_blank" id="preview-item-button-name-{{$content->id}}" data-text-color="{{$content->text_color}}" data-button-color="{{$content->button_color}}" class="btn btn-dark col-12 mb-3" style="background-color: {{$content->button_color}}">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        function myFunction(id) {
            document.getElementById("fontColorButton"+id).click(); 
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
            $("#preview-bio").text($(this).val())
        })

        // On default button change
        $("#default-btn").click(function(){
            $("#fontColorButton1").val("#ffffff");
            $("#fontColorButton2").val("#ffffff");
            $("#fontColorButton3").val("#343A40");

            $("#fontColorButton1").trigger("change");
            $("#fontColorButton2").trigger("change");
            $("#fontColorButton3").trigger("change");
        });

        function onChangeImage(e){
            document.getElementById('input-profile-image').src = window.URL.createObjectURL(e.files[0]);
            document.getElementById('preview-image').src = window.URL.createObjectURL(e.files[0]);
        }


    </script>
@endsection