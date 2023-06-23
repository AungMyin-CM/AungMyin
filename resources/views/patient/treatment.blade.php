@extends("layouts.app")

@section('content')

<style>
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content,
    .carousel-inner img {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    .carousel-inner img,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {

        .modal-content,
        .carousel-inner img {
            width: 100%;
        }
    }

    /* Scrollbar */
    /* Adjust the width of the scrollbar */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Set the background color */
    ::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    /* Thumb styles */
    ::-webkit-scrollbar-thumb {
        background-color: #a9a9a9;
    }

    /* Hover styles */
    ::-webkit-scrollbar-thumb:hover {
        background-color: #858383;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <h6 id="name">{{ $data['patient']['name'] }}
                                        <span class="text-danger" style="font-weight: bold;">{{ $data['patient']['gender'] == 1 ? 'M' : 'F' }}</span>
                                        <span>{{ $data['patient']['age'] }} years</span>
                                    </h6>
                                </div>
                                <div class="col-sm-4">
                                    <h6 id="drug_allergy"><b>Drug Allergy :</b> {{ $data['patient']['drug_allergy'] ? $data['patient']['drug_allergy'] : 'None'  }} </h6>
                                </div>
                                <div class="col-sm-4">
                                    <h6 id="diseases"><b>Diseases :</b> </h6>
                                </div>
                                <div class="col-sm-2">
                                    <nav aria-label="breadcrumb" class="float-right">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <button id="viewBtn" style="display: contents;">View</button>

                                                @include('partials._view-modal')
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                @if(Helper::checkPermission('p_update', $permissions))
                                                <button id="editBtn" style="display: contents;">Edit</button>

                                                @include('partials._edit-modal')
                                                @endif
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <form action="{{ route('create.treatment', $data['patient']['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <section class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-4">

                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: {{config('app.color')}}">
                                        <h3 class="card-title">Previous Records</h3>
                                        <span class="float-right">{{ $data['patient']->visits->count() }} visits</span>
                                    </div>

                                    <div class="card-body" style="height: 500px;overflow-y:scroll;">
                                        @if($data['visit']->isEmpty() != 1)
                                        @foreach ($data['visit'] as $row)
                                        <!-- style="background:#a19090;" -->
                                        <div class="card" id="treatment_data_{{$row['id']}}">
                                            <div class="card-header">
                                                <div class="row mb-3">
                                                    <div class="col-8">
                                                        <ul class="list-unstyled">
                                                            <li>Bp - {{ $row['sys_bp'] }}/{{ $row['dia_bp'] }} mmHg</li>
                                                            <li>PR - {{ $row['pr'] }} min</li>
                                                            <li>T - {{ $row['temp'] }}*F</li>
                                                            <li>SpO2 - {{ $row['spo2'] }} % on Air</li>
                                                            <li>RBS - {{ $row['rbs'] }}mg/dL</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <small title="{{$row['update_at']}}">{{ $row['updated_at']->format('d-M-Y g:iA') }}</small>
                                                    </div>
                                                </div>

                                                <ul class="list-unstyled">
                                                    @if($row['prescription'] != '')
                                                    <li>Prescription: {{ Str::limit($row['prescription'], $limit = 100, $end = '...') }}</li>
                                                    @endif

                                                    @if($row['diag'] != '')
                                                    <li>Diagnosis: {{ Str::limit($row['diag'], $limit = 100, $end = '...') }}</li>
                                                    @endif

                                                    @if($row['investigation'] != '')
                                                    <li>Investigation: {{ Str::limit($row['investigation'], $limit = 100, $end = '...') }}</li>
                                                    @endif

                                                    @if($row['procedure'] != '')
                                                    <li>Procedure: {{ Str::limit($row['procedure'], $limit = 100, $end = '...') }}</li>
                                                    @endif
                                                </ul>

                                                <div>
                                                    <span>Treatment:</span><br>
                                                    <span>{{ $row['assigned_medicines'] }}</span>
                                                </div>

                                                <p>Fees - {{ $row['fees'] }} Kyats</p>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-8">
                                                        @if($row['is_followup'] == '1')
                                                        <small>Follow-up: {{ date('d-m-Y', strtotime($row['followup_date'])) }}</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <a class="btn btn-sm btn-tool">
                                                            <i class="fas fa-copy" id="copy_{{$row['id']}}" style="color:black;" onclick="copyData({{$row['id']}})"></i>
                                                            <i class="fa fa-history" id="undo_{{$row['id']}}" style="color:black;display:none;" onclick="deleteData({{$row['id']}})"></i>

                                                        </a>
                                                        <a class="btn btn-sm btn-tool">
                                                            <i class="fas fa-trash" style="color:black;" onclick="removeData({{$row['id']}})"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <div class="row">
                                                    <?php
                                                    $images_r = substr($row['images'], 1, -1);

                                                    $images = explode(",", $images_r);

                                                    for ($i = 0; $i < count($images); $i++) {
                                                        if ($images[$i] != '') {
                                                            $id = $row['id'];

                                                            echo "<img id='myImg" . $id . $i . "' onclick='showImage($id, $i)' src=" . asset('images/treatment-images/' . substr($images[$i], 1, -1)) . " style='margin:4px;width:50px;border-radius:5px;cursor:pointer;' alt='img'>";
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <p class="text-center">No records yet.</p>
                                        @endif

                                        <div>
                                            {{ $data['visit']->links('pagination.bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: {{config('app.color')}}">
                                        <h3 class="card-title">....</h3>

                                    </div>
                                    <div class="card-body" style="max-height: 500px; overflow-y: auto;">

                                        <div class="form-group">
                                            <label for="general_prescription">General Prescription</label>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="sys_bp" placeholder="Sys">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="dia_bp" placeholder="Dia">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="pr" placeholder="P.R">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="temp" placeholder="Temp">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="spo2" placeholder="Spo2">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" name="rbs" placeholder="Rbs">
                                                </div>
                                            </div>
                                        </div>

                                        <fieldset class="scheduler-border">
                                            <legend class="scheduler-border">Investigation</legend>
                                            <div class="form-group">

                                                <textarea class="form-control c-field" id="dictionary" rows="3" placeholder="History" name="prescription">{{ old('prescription') }}</textarea><br>
                                                <textarea class="form-control c-field" id="diagnosis_dictionary" rows="3" placeholder="Diagnosis..." name="diag">{{ old('diag') }}</textarea>
                                            </div>


                                        </fieldset>


                                        <fieldset class="scheduler-border">
                                            <legend class="scheduler-border">Medicine</legend>

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="medicine_dictionary" placeholder="Search by Shorthand..." name="medicines">
                                            </div>

                                            <div class="form-group" id="medtable">
                                                <section class="content">
                                                    <div class="container-fluid">
                                                        <table class="table table-bordered" id="product_info_table">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:45%">Name</th>
                                                                    <th style="width:25%">Qty</th>
                                                                    <th style="width:20%">Days</th>
                                                                    <th><button type="button" id="add_dic_med_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr id="row_1">
                                                                    <td>
                                                                        {{-- <input type="text" class="form-control" id="medicine_dictionary" placeholder="Search..."
                                                                        name="medicines">            --}}
                                                                        <input type="text" name="med_name[]" id="product_search_1" onkeyup="searchMed('1')" class="form-control" placeholder="Search Medicine">
                                                                        <input type="hidden" name="med_id[]" id="med_id_1">
                                                                        <div id="medList_1" style="display:none;width:35%;">
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <input type="text" name="quantity[]" id="qty_1" class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="days[]" id="days_1" class="form-control">
                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                </section>
                                            </div>
                                        </fieldset>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="investigation">Investigation</label>
                                                    <textarea class="form-control c-field" id="investigation" rows="5" placeholder="Start Typing here..." name="investigation">{{ old('investigation') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="procedure">Procedure</label>
                                                    <textarea class="form-control c-field" id="procedure" rows="5" placeholder="Start Typing here..." name="procedure">{{ old('procedure') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="file" multiple="multiple" onchange="loadFile(event)" name="images[]" id="upload" hidden />
                                        <label class="file_upload" for="upload" style="background: gray;
                                            padding: 8px;
                                            border-radius: 5px;
                                            cursor: pointer;">Upload Images</label>

                                        <div id="imgModal" class="modal">
                                            <span id="close2" class="close">&times;</span>
                                            <div id="carousel" class="carousel slide">
                                                <div class="carousel-inner" id="carousel-inner"></div>
                                                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            <div id="caption"></div>
                                        </div>

                                        <div class="form-group" id="image">
                                            {{-- <img id="myImg" src="" style='margin:4px;width:100px;border-radius:5px;' alt="img" /> --}}
                                        </div>

                                        <div class="row mb-3">
                                            <input type="hidden" pattern="{0-9}" class="form-control d-none" name="fees" placeholder="Fees" value="{{Auth::user()->fees}}" />
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-center">
                                                    <div class="form-check" style="padding:6px !important;">

                                                        <div class="icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="foc" name="is_foc" value="1">
                                                            <label for="foc">FOC</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="d-flex justify-content-center" id="followUp">
                                                    <div class="form-check" style="padding:6px !important;">

                                                        <div class="icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="isFollowup" name="is_followup" value="1">
                                                            <label for="isFollowup">Follow up</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group float-right">
                                            <input type="submit" id="btnSubmit" value="Submit" class="btn btn-primary" style="background-color: {{config('app.color')}}">
                                        </div>
                                    </div>
                                    <!-- Bootstrap Switch -->
                                    <!-- /.card -->
                                </div>
                                <!-- /.col (right) -->
                            </div>
                        </div>
                </section>
            </form>

        </div>
    </div>
</body>
<script src="{{ asset('js/dictionary.js') }}"></script>
<script src="{{ asset('js/patient.js') }}"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
    // Get the modal
    let viewModal = document.getElementById("viewModal");
    let editModal = document.getElementById("editModal");

    // Get the button that opens the modal
    let viewBtn = document.getElementById("viewBtn");
    let editBtn = document.getElementById("editBtn");

    // When the user clicks the button, open the modal
    viewBtn.onclick = function() {
        viewModal.style.display = "block";
    }

    editBtn.onclick = function() {
        editModal.style.display = "block";
    }

    // Close the modal
    $("#viewClose").click(function(e) {
        viewModal.style.display = "none";
    })

    $("#editClose").click(function(e) {
        editModal.style.display = "none";
    })

    $(document).ready(function() {
        $(window).on("keydown", function(event) {

            // Check to see if ENTER was pressed and the submit button was active or not
            if (event.keyCode === 13 && event.target === document.getElementById("btnSubmit")) {
                // It was, so submit the form
                document.querySelector("form").submit();

            } else if (event.keyCode === 13 && event.target == document.getElementById("medicine_dictionary")) {
                medicine_dictionary(event);
                event.preventDefault();

                //  Invoke click event of target so that non-form submit behaviors will work
                event.target.click();
            } else if (event.keyCode === 13) {
                event.preventDefault();
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#updateForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            let formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                url: action = "{{ route('patient.updatePatient', $data['patient']['id']) }}",
                type: 'PATCH',
                data: formData,
                success: function(response) {
                    editModal.style.display = "none";
                    $('.wrapper').css('opacity', '1');
                    $('.middle').css('opacity', '0.1');

                    let gender = response.gender == 1 ? 'Male' : 'Female';
                    let father_name = response.father_name ?? '';
                    let phoneNumber = response.phoneNumber ?? '';
                    let drug_allergy = response.drug_allergy ?? '';
                    let summary = response.summary ?? '';

                    $('#name').html("<b>Name :</b> " + response.name);
                    $('#age').html("<b>Age :</b> " + response.age);
                    $('#father_name').html("<b>Father's Name :</b> " + father_name);
                    $('#gender').html("<b>Gender :</b> " + gender);
                    $('#phoneNumber').html("<b>Phone-Number :</b> " + phoneNumber);
                    $('#address').html("<b>Address :</b> " + response.address);
                    $('#drug_allergy').html("<b>Allergy :</b> " + drug_allergy);
                },
                error: function(xhr) {
                    // Handle the error response
                    $('.wrapper').css('opacity', '1');
                    $('.middle').css('opacity', '0.1');

                    let data = JSON.parse(xhr.responseText);

                    let name = data.errors.name ? data.errors.name[0] : '';
                    let age = data.errors.age ? data.errors.age[0] : '';
                    let address = data.errors.address ? data.errors.address[0] : '';
                    let gender = data.errors.gender ? data.errors.gender[0] : '';

                    $('#nameError').html(name);
                    $('#ageError').html(age);
                    $('#addressError').html(address);
                    $('#genderError').html(gender);
                }
            });
        });
    });
    var loadFile = function(event) {
        for (var i = 0; i < event.target.files.length; i++) {
            var src = URL.createObjectURL(event.target.files[i]);
            $("#image").append("<img id='myImg" + i + "' onclick='showImage(" + i + ")' src=" + src + " style='margin:4px;width:100px;border-radius:5px;cursor:pointer;' alt='img' />");

        }
    };

    let modal = document.getElementById("imgModal");
    let captionText = document.getElementById("caption");

    function showImage(id, i) {
        let origin_image = document.getElementById("myImg" + id + i);
        modal.style.display = "block";
        captionText.innerHTML = origin_image.alt;

        let carouselInner = document.getElementById("carousel-inner");
        // Clear the previous carousel items
        carouselInner.innerHTML = "";

        let carouselItem = document.createElement("div");
        carouselItem.classList.add("carousel-item");
        carouselItem.classList.add("active");

        let carouselImage = document.createElement("img");
        carouselImage.src = origin_image.src;
        carouselImage.alt = origin_image.alt;

        carouselItem.appendChild(carouselImage);
        carouselInner.appendChild(carouselItem);

        // Select all images with the same ID
        let images = document.querySelectorAll("[id^='myImg" + id + "']");
        console.log(images);

        for (let j = 0; j < images.length; j++) {
            if (images[j] !== origin_image) {
                carouselItem = document.createElement("div");
                carouselItem.classList.add("carousel-item");

                carouselImage = document.createElement("img");
                carouselImage.src = images[j].src;
                carouselImage.alt = images[j].alt;

                carouselItem.appendChild(carouselImage);
                carouselInner.appendChild(carouselItem);
            }
        }
    }

    // Get the <span> element that closes the modal
    let span = document.getElementById("close2");

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });

    var dictCode = '';

    // {{ session() -> get('cc_id') }};
    function medicine_dictionary(event) {

        var key = event.keyCode;
        var evtType = event.type;
        var clinic_id = {{ session() -> get('cc_id') }};
        var name = document.getElementById("medicine_dictionary").value;

        if (event.key != '') {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '/clinic-system/fetchIsmed',
                data: {
                    key: name,
                    clinic_id: clinic_id
                }
            }).done(function(response) {

                if (response != '') {
                    var obj = JSON.parse(response);
                    const res = obj.meaning.split("<br>");

                    var fil_res = res.filter(function(el) {
                        return el != "";
                    });

                    var table = $("#product_info_table");
                    var count_table_tbody_tr = $("#product_info_table tbody tr").length;
                    var $this = $("table#product_info_table tbody");
                    if (count_table_tbody_tr == 1 && $("#product_search_1").val() == '') {
                        var row_id = count_table_tbody_tr;
                    } else {
                        var row_id = count_table_tbody_tr + 1;
                    }
                    var html = "";
                    for (i = 0; i < fil_res.length; i++) {
                        data = res[i].split('^');
                        html += '<tr id="row_' + row_id + '">' +
                            '<td>' +
                            '<input type="text" name="med_name[]" id="product_search_' + row_id + '" onkeyup="searchMed(' + row_id + ')" value="' + data[1] + '"  class="form-control" placeholder="Search Medicine">' +
                            '<input type = "hidden" name = "med_id[]" id = "med_id_' + row_id + '" value="' + data[0] + '" >' +
                            '<div id="medList_' + row_id + '" style="position:absolute;top:10px;display:none;width:35%;"></div>' +
                            '</td>' +
                            '<td><input type="text" name="quantity[]" id="qty_' + row_id + '" class="form-control" value="' + data[2] + '" ></td>' +
                            '<td><input type="number" name="days[]" id="days_' + row_id + '" class="form-control"  value="' + data[3] + '"></td>' +
                            '<td><button type="button" class="btn btn-default" onclick="removeRow(\'' + row_id + '\')"><i class="fa fa-minus"></i></button></td>' +
                            '</tr>';
                        row_id++;
                    }

                    if (count_table_tbody_tr == 1 && $("#product_search_1").val() == '') {
                        $("#product_info_table tbody").html(html)
                    } else {
                        $("#product_info_table tr:last").after(html)
                    }


                }
            });
        }

    }

    function searchMed(rowid) {
        var query = $("#product_search_" + rowid).val();

        var clinic_id = {{ session() -> get('cc_id') }};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/clinic-system/searchMed',
            data: {
                key: query,
                clinic_id: clinic_id,
                rowid: rowid
            }
        }).done(function(response) {

            if (query != '') {
                $('#medList_' + rowid).css("display", "contents");
                $('#medList_' + rowid).css("position", "relative");
                $('#medList_' + rowid).css("top", '14rem');
                $('#medList_' + rowid).html(response);
            } else {
                $('#medList_' + rowid).css("display", "none");
                $('#medList_' + rowid).html("");
            }
        });
    };

    function s_option(rowid) {
        var med_id = rowid.getAttribute("data-id");
        var med_name = rowid.getAttribute("data-name");
        var row_id = rowid.getAttribute("row-id");
        $("#product_search_" + row_id).val(med_name);
        $("#med_id_" + row_id).val(med_id);
        $('#medList_' + row_id).css("display", "none");
        $('#medList_' + row_id).html("");

    }

    function removeRow(id) {
        $("#medtable table tr#row_" + id).remove();
    }

    function copyData(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: '/clinic-system/copy-data',
            data: {
                id: id
            },
            beforeSend: function() {
                $('.c-field').attr('style', 'opacity:0.1');
            },
            success: function(response) {
                $("#dictionary").text(response.prescription);
                $("#diagnosis_dictionary").text(response.diag);
                $("#investigation").text(response.investigation);
                $("#procedure").text(response.procedure);
            },
            complete: function(response) {
                $('.c-field').removeAttr('style', 'opacity:0.1');
                $('#copy_' + id).css('display', 'none');
                $('#undo_' + id).css('display', 'block');
            }
        });
    }

    function deleteData(id) {
        $("#dictionary").text('');
        $("#diagnosis_dictionary").text('');
        $("#investigation").text('');
        $("#procedure").text('');

        $('#copy_' + id).css('display', 'block');
        $('#undo_' + id).css('display', 'none');
    }

    function removeData(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: '/clinic-system/remove-data',
            data: {
                id: id
            }
        }).done(function(response) {
            $("#treatment_data_" + id).slideUp();
        });
    }
</script>
@endsection
{{-- @include('layouts.js') --}}