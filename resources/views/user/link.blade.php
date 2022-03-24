@extends("user.user_home_template")

@section("content")
    <div class="row mt-4 col-12 px-4 px-lg-5 mx-0" style="overflow-anchor: none;">

        <div class="p-1 mb-5 col-lg-6 col-md-12 col-sm-12 col-12">
           <div class="px-3">
                <button class="btn btn-dark col-12" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa-solid fa-plus"></i>ADD
                </button>
                <div class="collapse" id="collapseExample">
                    @foreach($list_content_types as $content_type)
                        <button onclick="addContent({{$content_type->id}})" class="my-1 btn btn-dark col-12" id="{{$content_type->id}}"><i class="fa-solid fa-plus"></i>ADD {{$content_type->type}}</button>
                    @endforeach
                </div>
           </div>

            <div class="card-body">

                <section>
                    <ul id="container-list" class="list-group list-group-sortable-handles" >

                        @foreach($list_contents as $content)
                            @if($content->content_type_id == 1)
                                <!-- LINK -->
                                <li id="list-item-{{$content->id}}" data-real_id="{{$content->id}}"  class="border-top list-group-item pl-1 pr-0 my-2" style="background-color: #ffffff; border-radius: 20px;">
                                    <div class="row col-12 pr-0 mr-0">
                                        <div class="col-2 col-sm-2 col-md-1 col-lg-1 pr-1 d-flex align-items-center">
                                            <i style="cursor: pointer;" class="fa-solid fa-grip-vertical"></i>
                                        </div>
                                        <div class="col-10 col-sm-10 col-md-11 col-lg-11 px-0">
                                            <div class="row col-12 mx-0 px-0 mb-2 mt-3">
                                                <select onchange="linkTypeChange({{$content->id}})" id="item-link_type-{{$content->id}}" name="link_types[]" class="custom-select col-6">
                                                    @foreach($list_link_types as $link_type)
                                                        <option data-placeholder="{{$link_type->placeholder}}" data-prefix="{{$link_type->prefix}}" data-icon="{{$link_type->icon}}" {{$content->link_type_id == $link_type->id ? 'selected' : ''}} value="{{$link_type->id}}">{{$link_type->type}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="col-6 pr-0 pl-1">
                                                    <input id="item-button-name-{{$content->id}}" onchange="onChangeButtonName({{$content->id}})" type="text" name="button_texts[]" value="{{$content->text}}" class="form-control" style="width:100%" placeholder="Button Name">
                                                </div>
                                            </div>
                                            <div class="col-12 px-0">
                                                <!-- <input type="text" class="form-control" style="width:100%" value="https://"> -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text pr-1" id="item-prefix-{{$content->id}}" style="background-color:#ffffff; border-right:0">{{$content->linkType->prefix}}</span>
                                                    </div>
                                                    <input placeholder="{{$content->linkType->placeholder}}" style="border-left:0" type="text" onchange="onLinkChange({{$content->id}})" id="item-link-{{$content->id}}" name="links[]" value="{{$content->link}}" class="form-control pl-0" aria-describedby="basic-addon3">
                                                </div>
                                            </div>

                                            <div class="row col-12 mt-2 m-0 px-0">
                                                <div class="form-group col-12 col-sm-12 col-lg-11 px-0 row">
                                                    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                                        <p class="mb-0">Text Color</p>
                                                        <button onClick="changeButtonTextColor({{$content->id}}, 'black')" class="btn btn-dark"  style="border-radius: 20px; height:25px"></button>
                                                        <button onClick="changeButtonTextColor({{$content->id}}, 'white')" class="btn btn-outline-light border"  style="backgroun-color:#ffffff; border-radius: 20px; height:25px"></button>
                                                    </div>
                                                    <div class="col-6 col-sm-6 col-md-9 col-lg-9">
                                                        <p class="mb-0">Button Color</p>
                                                        <a href="#" onclick="openColorPicker({{$content->id}})"><img height="20px" src="{{asset('images/paint.png')}}" alt=""></a>
                                                        <input type="text" data-coloris onChange="changeButtonColor({{$content->id}})" name="button_colors[]" value="{{$content->button_color}}" style="visibility:hidden"  id="item-button-color-{{$content->id}}" title="Change Font Color" colorpick-eyedropper-active="true" />
                                                    </div>
                                                </div>

                                                <div class="px-0 ml-auto mr-0 col-12 col-sm-12 col-lg-1">
                                                    <p class=" d-flex justify-content-end mb-0">Icon</p>
                                                    <div class=" d-flex justify-content-end custom-control custom-switch" style="margin-right:-5px">
                                                        <input type="checkbox" onChange="onIconChange({{$content->id}})" id="item-checkbox-icon-{{$content->id}}" {{$content->is_icon_displayed ? 'checked' : ''}} class="custom-control-input" style="transform: scale(2);">
                                                        <label style="cursor: pointer;" class="custom-control-label" for="item-checkbox-icon-{{$content->id}}"></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="mt-0">

                                            <div class="row col-12 mt-2 m-0 px-0" style="height:auto !important;">
                                                <div class="form-group col-6 col-sm-7 col-md-8 col-lg-8 px-0 row">
                                                    <div class="col-12">
                                                        <i style="cursor: pointer;" onclick="deleteItem({{$content->id}})" class="fa-solid fa-trash mr-2"></i>
                                                        <button  onClick="setDefaultLink({{$content->id}})" class="btn btn-sm btn-dark">Default</button>
                                                    </div>
                                                </div>
                                                <div class="row px-0 ml-auto mr-0 col-6 col-sm-5 col-md-4 col-lg-4 d-flex justify-content-end">
                                                    <span>{{$content->total_clicked}} Klik <i class="fa-solid fa-chart-line"></i></span>
                                                    <div style="height:30px; width:1px; background-color:#DFDFDF; margin-left:10px; margin-right:5px"></div>
                                                    <div class="custom-control custom-switch" style="margin-right:-5px">
                                                        <input onChange="onDisplayChange({{$content->id}})" id="item-checkbox-display-{{$content->id}}" {{$content->is_content_displayed ? 'checked' : ''}} type="checkbox" class="custom-control-input">
                                                        <label style="cursor: pointer;" class="custom-control-label" for="item-checkbox-display-{{$content->id}}"></label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            @elseif($content->content_type_id == 2)
                                <!-- DIVIDER -->
                                <li id="list-item-{{$content->id}}" data-real_id="{{$content->id}}" class="border-top list-group-item pl-1 pr-0 my-2" style="background-color: #ffffff; border-radius: 20px;">
                                    <div class="row col-12 pr-0 mr-0">
                                        <div class="col-1 pr-1 d-flex align-items-center">
                                            <i style="cursor: pointer;" class="fa-solid fa-grip-vertical"></i>
                                        </div>
                                        <div class="col-11 px-0">
                                            <div class="col-12">
                                                <i style="cursor: pointer;" onclick="deleteItem({{$content->id}})" class="fa-solid fa-trash"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <!-- TEXT -->
                                <li id="list-item-{{$content->id}}" data-real_id="{{$content->id}}" class="border-top list-group-item pl-1 pr-0 my-2" style="background-color: #ffffff; border-radius: 20px;">
                                    <div class="row col-12 pr-0 mr-0">
                                        <div class="col-2 col-sm-2 col-md-1 col-lg-1 pr-1 d-flex align-items-center">
                                            <i style="cursor: pointer;" class="fa-solid fa-grip-vertical"></i>
                                        </div>
                                        <div class="col-10 col-sm-10 col-md-11 col-lg-11 px-0">
                                            <div class="col-12 px-0">
                                                <input onchange="onChangeInputText({{$content->id}})" value="{{$content->text}}" id="item-input-text-{{$content->id}}" name="text[]" type="text" class="form-control" style="width:100%" placeholder="Text">
                                            </div>

                                            <div class="row col-12 mt-2 m-0 px-0">
                                                <div class="form-group col-12 px-0 row">
                                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                                        <p class="mb-0">Text Color</p>
                                                        <button onclick="changeTextColor({{$content->id}}, 'black')" class="btn btn-dark"  style="border-radius: 20px; height:25px"></button>
                                                        <button onclick="changeTextColor({{$content->id}}, 'white')" class="btn btn-outline-light border"  style="backgroun-color:#ffffff; border-radius: 20px; height:25px"></button>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-9 col-lg-9">
                                                        <p class="mb-0 ml-2">Align Text</p>
                                                        <i style="cursor: pointer;" onclick="changeTextAlign({{$content->id}}, 'left')" class="fa-solid fa-align-left fa-lg ml-2"></i>
                                                        <i style="cursor: pointer;" onclick="changeTextAlign({{$content->id}}, 'center')" class="fa-solid fa-align-center fa-lg ml-2"></i>
                                                        <i style="cursor: pointer;" onclick="changeTextAlign({{$content->id}}, 'right')" class="fa-solid fa-align-right fa-lg ml-2"></i>
                                                        <i style="cursor: pointer;" onclick="changeTextAlign({{$content->id}}, 'justify')" class="fa-solid fa-align-justify fa-lg ml-2"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="mt-0">

                                            <div class="row col-12 mt-2 m-0 px-0">
                                                <div class="form-group col-9 px-0 row">
                                                    <div class="col-12">
                                                        <i style="cursor: pointer;" onclick="deleteItem({{$content->id}})" class="fa-solid fa-trash mr-2"></i>
                                                        <button onclick="setDefaultText({{$content->id}})" class="btn btn-sm btn-dark">Default</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </section>


            </div>

            <div style="visibility: {{ count($list_contents) < 1 ? 'hidden' : 'visible' }} " id="container-add-bottom" class="px-3">
                <button class="btn btn-dark col-12" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa-solid fa-plus"></i>ADD
                </button>
                <div class="collapse" id="collapseExample2">
                    @foreach($list_content_types as $content_type)
                        <button onclick="addContent({{$content_type->id}})" class="my-1 btn btn-dark col-12" id="{{$content_type->id}}"><i class="fa-solid fa-plus"></i>ADD {{$content_type->type}}</button>
                    @endforeach
                </div>
           </div>
        </div>

        <!-- Preview -->
        <div class="p-1 mb-5 col-lg-6 col-md-12 col-sm-12 col-12" style="min-height: 600px;">
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

                    <div class="w-100 d-flex justify-content-center mt-3" >
                        <div id="background-canvas" class="col-12 px-0 py-0 mb-3" height="30px" style="height:570px; overflow: hidden; background-color: {{ $data->background_color ?? '#ffffff' }}; border-radius: 40px;">

                            <div id="check" class="px-3 py-4" style="height:570px; overflow:auto">
                                <!-- CONTENT -->
                                <div class="row col-12 mr-0 pr-0">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 px-0">
                                        <img id="preview-image" style="border:solid {{ $data->frame_color ?? '#ffffff' }} 2px ; object-fit: cover;" width="95px" height="95PX" src="{{$data->photo ? env('APP_URL').$data->photo : asset('assets/default_image.png') }}" class="rounded-circle" alt="Cinque Terre">
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 pt-4 text-right">
                                        <a href="{{url('page/download_vcard_preview')}}" id="preview-save-contact" style="background-color: {{ $data->save_color ?? '#343A40' }};" class="mt-2 btn btn-sm btn-dark border-0">SAVE CONTACT</a>
                                    </div>
                                </div>
                                <br>
                                <p class="mb-0"><b id="preview-name">{{$data->name}}</b></p>
                                <p id="full-preview-username" style="display: {{$data->is_username_displayed ? '' : 'none'}}"  style="font-size:12px">@<span id="preview-username">{{$data->username}}</span></p>
                                <p id="preview-bio">{{$data->bio}}</p>
                                <p id="full-preview-address" style="display: {{$data->is_address_displayed ? '' : 'none'}}"><i class="fa-solid fa-location-dot"></i><span id="preview-address" class="pl-2">{{$data->address}}</span></p>

                                <div id="container-list-preview">
                                    @foreach($list_contents as $content)
                                        @if($content->content_type_id == 1)
                                            <div id="div-preview-item-{{$content->id}}" data-real_id="{{$content->id}}" style="display: {{$content->is_content_displayed ? '' : 'none'}}">
                                                <a href="{{$content->linkType->prefix.$content->link}}" target="_blank" id="preview-item-button-name-{{$content->id}}" data-text-color="{{$content->text_color}}" data-button-color="{{$content->button_color}}" class="btn-preview btn btn-dark col-12 mb-3 border-0" style="background-color: {{$content->button_color}}">
                                                    <i id="preview-icon-{{$content->id}}" class="my-1 {{$content->text != null ? 'float-left' : ''}} {{$content->linkType->icon}}" style="display: {{$content->is_icon_displayed ? '' : 'none'}}"></i>
                                                    <div id="preview-text-button-name-{{$content->id}}" style=" white-space: normal; color: {{$content->text_color}}">{{$content->text}}</div>
                                                </a>
                                            </div>
                                        @elseif($content->content_type_id == 2)
                                            <div id="div-preview-item-{{$content->id}}" data-real_id="{{$content->id}}">
                                                <br>
                                            </div>
                                        @else
                                            <div id="div-preview-item-{{$content->id}}" data-real_id="{{$content->id}}" data-text-align="{{$content->text_align}}" style="text-align: {{$content->text_align}}">
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
    </div>

    <script src="{{asset('js/jquery.sortable.js')}}"></script>
    <script>

        initSortList();
        let current_item_length = 0;

        function openColorPicker(id) {
            document.getElementById("item-button-color-"+id).click();
            event.preventDefault();
        }

        function initSortList(){
            $('.list-group-sortable-handles').sortable({
                placeholderClass: 'list-group-item',
                handle: 'i'
            }).bind('sortupdate', function(e, ui) {
                updatePreviewUI();
                getNewOrder();
            });
        }

        function updatePreviewUI(){
            let lists = $("#container-list").children();
            let preview_lists = $("#container-list-preview").children();
            $("#container-list-preview").empty();

            let el_preview = $("#container-list-preview");

            for(i = 0; i < lists.length; i++){
                for(j = 0; j < preview_lists.length; j++){
                    if($(lists[i]).attr("data-real_id") == $(preview_lists[j]).attr("data-real_id")){
                        $("#container-list-preview").append(preview_lists[j]);
                        break;
                    }
                }
            }

        }

        function getNewOrder(){
            let lists = $("#container-list").children();
            let new_index = [];

            lists.each(function(key, value){
                new_index.push($(value).attr("data-real_id"))
            });

            let form_url = "/page/update_order";
            $.ajax({
                url:form_url,
                type:'POST',
                data:{
                    lists: JSON.stringify(new_index),
                    _token: "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function(result){
                    console.log(result);
                },
                error: function(ts) {
                    console.log(ts.responseText)
                }
            });
        }

        function addContent(id){
            if(id == 1){
                addLink();
            }else if(id == 2){
                addDivider();
            }else{
                addText();
            }

            initSortList();
        }

        function addLink(){
                let index = ++current_item_length;
            let link = `<li id="list-item-`+index+`" class="border-top list-group-item pl-1 pr-0 my-2" style="background-color: #ffffff; border-radius: 20px;">
                                    <div class="row col-12 pr-0 mr-0">
                                        <div class="col-2 col-sm-2 col-md-1 col-lg-1 pr-1 d-flex align-items-center">
                                            <i style="cursor: pointer;" class="fa-solid fa-grip-vertical"></i>
                                        </div>
                                        <div class="col-10 col-sm-10 col-md-11 col-lg-11 px-0">
                                            <div class="row col-12 mx-0 px-0 mb-2">
                                                <select onchange="linkTypeChange(`+index+`)" id="item-link_type-`+index+`" name="link_types[]" class="custom-select col-6">
                                                    @foreach($list_link_types as $link_type)
                                                        <option data-placeholder="{{$link_type->placeholder}}" data-prefix="{{$link_type->prefix}}" data-icon="{{$link_type->icon}}" value="{{$link_type->id}}">{{$link_type->type}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="col-6 pr-0 pl-1">
                                                    <input type="text" onchange="onChangeButtonName(`+index+`)" id="item-button-name-`+index+`" name="button_texts[]" class="form-control" style="width:100%" placeholder="Button Name">
                                                </div>
                                            </div>
                                            <div class="col-12 px-0">
                                                <!-- <input type="text" class="form-control" style="width:100%" value="https://"> -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text pr-1" id="item-prefix-`+index+`" style="background-color:#ffffff; border-right:0">https://instagram.com/</span>
                                                    </div>
                                                    <input placeholder="username" style="border-left:0" onChange="onLinkChange(`+index+`)" id="item-link-`+index+`" type="text" name="links[]" class="form-control pl-0" aria-describedby="basic-addon3">
                                                </div>
                                            </div>

                                            <div class="row col-12 mt-2 m-0 px-0">
                                                <div class="form-group col-12 col-sm-12 col-lg-11 px-0 row">
                                                    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                                        <p class="mb-0">Text Color</p>
                                                        <button onClick="changeButtonTextColor(`+index+`, 'black')" class="btn btn-dark"  style="border-radius: 20px; height:25px"></button>
                                                        <button onClick="changeButtonTextColor(`+index+`, 'white')" class="btn btn-outline-light border"  style="backgroun-color:#ffffff; border-radius: 20px; height:25px"></button>
                                                    </div>
                                                    <div class="col-6 col-sm-6 col-md-9 col-lg-9">
                                                        <p class="mb-0">Button Color</p>
                                                        <a href="#" onclick="openColorPicker(`+index+`)"><img height="20px" src="{{asset('images/paint.png')}}" alt=""></a>
                                                        <input type="text" data-coloris id="item-button-color-`+index+`" onChange="changeButtonColor(`+index+`)" name="button_colors[]" style="visibility:hidden" title="Change Font Color" colorpick-eyedropper-active="true" />
                                                    </div>
                                                </div>

                                                <div class="px-0 ml-auto mr-0 col-12 col-sm-12 col-lg-1">
                                                    <p class=" d-flex justify-content-end mb-0">Icon</p>
                                                    <div class=" d-flex justify-content-end custom-control custom-switch" style="margin-right:-5px">
                                                        <input checked onChange="onIconChange(`+index+`)" id="item-checkbox-icon-`+index+`" type="checkbox" class="custom-control-input" style="transform: scale(2);">
                                                        <label style="cursor: pointer;" class="custom-control-label" for="item-checkbox-icon-`+index+`"></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="mt-0">

                                            <div class="row col-12 mt-2 m-0 px-0">
                                                <div class="form-group col-6 col-sm-7 col-md-8 col-lg-8 px-0 row">
                                                    <div class="col-12">
                                                        <i style="cursor: pointer;" onclick="deleteItem(`+index+`)" class="fa-solid fa-trash mr-2"></i>
                                                        <button onClick="setDefaultLink(`+index+`)" class="btn btn-sm btn-dark">Default</button>
                                                    </div>
                                                </div>
                                                <div class="row px-0 ml-auto mr-0 col-6 col-sm-5 col-md-4 col-lg-4 d-flex justify-content-end">
                                                    <span>0 Klik <i class="fa-solid fa-chart-line"></i></span>
                                                    <div style="height:30px; width:1px; background-color:#DFDFDF; margin-left:10px; margin-right:5px"></div>
                                                    <div class="custom-control custom-switch" style="margin-right:-5px">
                                                        <input checked onChange="onDisplayChange(`+index+`)" type="checkbox" class="custom-control-input" id="item-checkbox-display-`+index+`">
                                                        <label style="cursor: pointer;" class="custom-control-label" for="item-checkbox-display-`+index+`"></label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>`;

                $("#container-list").append(link);
                let preview_button = `<div id="div-preview-item-`+index+`"><a href="https://instagram.com" target="_blank" id="preview-item-button-name-`+index+`"  class="btn-preview btn btn-dark col-12 mb-3 border-0"><i id="preview-icon-`+index+`" class="my-1 fa-brands fa-instagram" ></i> <span id="preview-text-button-name-`+index+`"></span> </a></div>`;
                $("#container-list-preview").append(preview_button);

                $.get("add_link", function(data, status){
                    $("#list-item-"+index).attr("data-real_id", data.data);
                    $("#div-preview-item-"+index).attr("data-real_id", data.data);
                });
                checkListCount()
        }

        function addDivider(){
                let index = ++current_item_length;
                let divider = `<li id="list-item-`+index+`" class="border-top list-group-item pl-1 pr-0 my-2" style="background-color: #ffffff; border-radius: 20px;">
                                    <div class="row col-12 pr-0 mr-0">
                                        <div class="col-1 pr-1 d-flex align-items-center">
                                            <i style="cursor: pointer;" class="fa-solid fa-grip-vertical"></i>
                                        </div>
                                        <div class="col-11 px-0">
                                            <div class="col-12">
                                                <i style="cursor: pointer;" onclick="deleteItem(`+index+`)" class="fa-solid fa-trash"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>`;

                $("#container-list").append(divider);
                let preview_divider = `<div id="div-preview-item-`+index+`"><br></div>`;
                $("#container-list-preview").append(preview_divider);


                $.get("add_divider", function(data, status){
                    $("#list-item-"+index).attr("data-real_id", data.data);
                    $("#div-preview-item-"+index).attr("data-real_id", data.data);
                });
                checkListCount()

        }

        function addText(){
                let index = ++current_item_length;
                let text = `<li id="list-item-`+index+`" class="border-top list-group-item pl-1 pr-0 my-2" style="background-color: #ffffff; border-radius: 20px;">
                                    <div class="row col-12 pr-0 mr-0">
                                        <div class="col-2 col-sm-2 col-md-1 col-lg-1 pr-1 d-flex align-items-center">
                                            <i style="cursor: pointer;" class="fa-solid fa-grip-vertical"></i>
                                        </div>
                                        <div class="col-10 col-sm-10 col-md-11 col-lg-11 px-0">
                                            <div class="col-12 px-0">
                                                <input onchange="onChangeInputText(`+index+`)" id="item-input-text-`+index+`" name="text[]" type="text" class="form-control" style="width:100%" placeholder="Text">
                                            </div>

                                            <div class="row col-12 mt-2 m-0 px-0">
                                                <div class="form-group col-12 px-0 row">
                                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                                        <p class="mb-0">Text Color</p>
                                                        <button onclick="changeTextColor(`+index+`, 'black')" class="btn btn-dark"  style="border-radius: 20px; height:25px"></button>
                                                        <button onclick="changeTextColor(`+index+`, 'white')" class="btn btn-outline-light border"  style="backgroun-color:#ffffff; border-radius: 20px; height:25px"></button>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-9 col-lg-9">
                                                        <p class="mb-0 ml-2">Align Text</p>
                                                        <i style="cursor: pointer;" onclick="changeTextAlign(`+index+`, 'left')" class="fa-solid fa-align-left fa-lg ml-2"></i>
                                                        <i style="cursor: pointer;" onclick="changeTextAlign(`+index+`, 'center')" class="fa-solid fa-align-center fa-lg ml-2"></i>
                                                        <i style="cursor: pointer;" onclick="changeTextAlign(`+index+`, 'right')" class="fa-solid fa-align-right fa-lg ml-2"></i>
                                                        <i style="cursor: pointer;" onclick="changeTextAlign(`+index+`, 'justify')" class="fa-solid fa-align-justify fa-lg ml-2"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="mt-0">

                                            <div class="row col-12 mt-2 m-0 px-0">
                                                <div class="form-group col-9 px-0 row">
                                                    <div class="col-12">
                                                        <i style="cursor: pointer;" onclick="deleteItem(`+index+`)" class="fa-solid fa-trash mr-2"></i>
                                                        <button onclick="setDefaultText(`+index+`)" class="btn btn-sm btn-dark">Default</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>`;

                $("#container-list").append(text);
                let preview_text = `<div id="div-preview-item-`+index+`" data-text-align="left"><p id="list-preview-item-`+index+`" data-text-color="black"></p></div>`;
                $("#container-list-preview").append(preview_text);

                $.get("add_text", function(data, status){
                    $("#list-item-"+index).attr("data-real_id", data.data);
                    $("#div-preview-item-"+index).attr("data-real_id", data.data);
                });
                checkListCount()
        }

        function deleteItem(id){

            let real_id = $("#list-item-"+id).data("real_id");
            $("#list-item-"+id).remove();
            $("#div-preview-item-"+id).remove();
            $.get("delete_item/"+real_id, function(data, status){});
            checkListCount()

        }


        // ################################################################
        // BUTTON TEXT
        // ################################################################
        function onChangeInputText(id){
            let value = $("#item-input-text-"+id).val();

            $("#list-preview-item-"+id).text(value);
            update_text(id);
        }

        function changeTextAlign(id, align){
            $("#div-preview-item-"+id).css("text-align", align);
            $("#div-preview-item-"+id).attr("data-text-align", align);
            update_text(id);
        }

        function changeTextColor(id, color){
            $("#list-preview-item-"+id).css("color", color);
            $("#list-preview-item-"+id).attr("data-text-color", color);
            update_text(id);
        }

        function setDefaultText(id){
            changeTextAlign(id, 'left');
            changeTextColor(id, 'black');
        }

        function update_text(id){
            let real_id = $("#list-item-"+id).data("real_id");
            let form_url = "/page/update_text/"+real_id;

            $.ajax({
                url:form_url,
                type:'POST',
                data:{
                    text: $("#item-input-text-"+id).val(),
                    text_align: $("#div-preview-item-"+id).attr("data-text-align"),
                    text_color: $("#list-preview-item-"+id).attr("data-text-color"),
                    _token: "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function(result){
                    console.log(result);
                },
                error: function(ts) {
                    console.log(ts.responseText)
                }
            });
        }


        // ################################################################
        // BUTTON LINK
        // ################################################################
        function onChangeButtonName(id){
            let value = $("#item-button-name-"+id).val();
            $("#preview-text-button-name-"+id).text(value);

            iconAlign(value, id);
            update_link(id);
        }

        function changeButtonTextColor(id, color){
            $("#preview-text-button-name-"+id).css("color", color);
            $("#preview-text-button-name-"+id).attr("data-text-color", color);
            update_link(id);
        }

        function changeButtonColor(id){
            let color = $("#item-button-color-"+id).val();
            $("#preview-item-button-name-"+id).css("background-color", color);
            $("#preview-item-button-name-"+id).attr("data-button-color", color);
            update_link(id);
        }

        function onIconChange(id){
            if($("#item-checkbox-icon-"+id).is(":checked")){
                $("#preview-icon-"+id).css("display", "");
            }else{
                $("#preview-icon-"+id).css("display", "none");
            }
            update_link(id);
        }

        function onDisplayChange(id){
            console.log(id);
            if($("#item-checkbox-display-"+id).is(":checked")){
                $("#div-preview-item-"+id).css("display", "");
            }else{
                $("#div-preview-item-"+id).css("display", "none");
            }
            update_link(id);
        }

        function iconAlign(value, id){
            if(value != null && value != ''){
                $("#preview-icon-"+id).addClass("my-1");
                $("#preview-icon-"+id).addClass("float-left");
            }else{
                console.log("masok");
                $("#preview-icon-"+id).removeClass("float-left");
            }
        }

        function linkTypeChange(id){
            let selected_option = $("#item-link_type-"+id).find(":selected");
            let prefix = $(selected_option).attr("data-prefix");
            let icon = $(selected_option).attr("data-icon");
            let text = $(selected_option).text();
            let value = $("#item-link-"+id).val();
            let placeholder = $(selected_option).attr("data-placeholder");
            let button_name = $("#item-button-name-"+id).val();

            $("#preview-icon-"+id).attr("class", icon);
            $("#item-prefix-"+id).html(prefix);
            $("#item-link-"+id).attr("placeholder", placeholder);
            $("#preview-item-button-name-"+id).attr("href", prefix+value);
            iconAlign(button_name, id);
            update_link(id);
        }

        function setDefaultLink(id){
            $("#preview-text-button-name-"+id).css("color", 'white');
            $("#item-button-color-"+id).val("#343A40");
            changeButtonColor(id)

            $("#item-checkbox-icon-"+id).prop('checked', true);
            onIconChange(id);
            $("#item-checkbox-display-"+id).prop('checked', true);
            onDisplayChange(id);
        }

        function update_link(id){
            let real_id = $("#list-item-"+id).data("real_id");
            let form_url = "/page/update_link/"+real_id;

            $.ajax({
                url:form_url,
                type:'POST',
                data:{
                    link_type_id: $("#item-link_type-"+id).val(),
                    text: $("#item-button-name-"+id).val(),
                    link: $("#item-link-"+id).val(),
                    text_color: $("#preview-text-button-name-"+id).attr("data-text-color"),
                    button_color: $("#preview-item-button-name-"+id).attr("data-button-color"),
                    is_icon_displayed: $("#item-checkbox-icon-"+id).is(":checked"),
                    is_content_displayed: $("#item-checkbox-display-"+id).is(":checked"),
                    _token: "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function(result){
                    console.log(result);
                },
                error: function(ts) {
                    console.log(ts.responseText)
                }
            });
        }

        function onLinkChange(id){
            let prefix = $("#item-link_type-"+id).find(':selected').data('prefix')
            let value = $("#item-link-"+id).val();
            $("#preview-item-button-name-"+id).attr("href", prefix+value);
            update_link(id);
        }

        function checkListCount(){

            let lists = $("#container-list").children();
            let panjang_list = lists.length;

            if(panjang_list < 1){
                $("#container-add-bottom").css("visibility", "hidden");
            }else{
                $("#container-add-bottom").css("visibility", "visible");
            }
        }

    </script>
@endsection
