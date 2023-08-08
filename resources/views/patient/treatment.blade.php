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

    .pagination .active {
        z-index: 0;
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

    .tooltip-card {
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.8s;
        position: fixed;
        padding-top: 90px;
        margin-left: 12px;
    }

    .tooltip-card .tooltip-content {
        position: relative;
        width: 200px;
        background-color: #003049;
        color: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .tooltip-content .arrow {
        position: absolute;
        top: 50%;
        left: -10px;
        margin-top: -10px;
        width: 0;
        height: 0;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-right: 10px solid #003049;
    }

    .quantity {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .quantity__minus,
    .quantity__plus {
        display: block;
        width: 22px;
        height: 23px;
        margin: 0;
        background: #003049;
        text-decoration: none;
        text-align: center;
        line-height: 23px;
    }

    .quantity__minus:hover,
    .quantity__plus:hover {
        background: #575b71;
        color: #fff;
    }

    .quantity__minus {
        border-radius: 3px 0 0 3px;
    }

    .quantity__plus {
        border-radius: 0 3px 3px 0;
    }

    .quantity__input {
        width: 32px;
        height: 19px;
        margin: 0;
        padding: 0;
        text-align: center;
        border-top: 2px solid #dee0ee;
        border-bottom: 2px solid #dee0ee;
        border-left: 1px solid #dee0ee;
        border-right: 2px solid #dee0ee;
        background: #fff;
        color: #8184a1;
    }

    .quantity__minus:link,
    .quantity__plus:link {
        color: #8184a1;
    }

    .quantity__minus:visited,
    .quantity__plus:visited {
        color: #fff;
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
                                <div class="col-sm-2 mb-2">
                                    <span id="name">{{ $patient->name }}</span>
                                    <span id="gender" class="text-danger" style="font-weight: bold;">{{ $patient->gender == 1 ? 'M' : 'F' }}</span>
                                    <span id="age">{{ $patient->age }} years</span>
                                </div>
                                <div class="col-sm-4">
                                    <h6 id="drug_allergy"><b>Drug Allergy :</b> {{ $patient->drug_allergy ? $patient->drug_allergy : 'None'  }} </h6>
                                </div>
                                <div class="col-sm-4">
                                    <h6 id="father_name"><b>Father :</b> {{ $patient->father_name }}</h6>
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

            <form action="{{ route('create.treatment', $patient->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <section class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div id="visit-lists" class="col-md-4">
                                @include('partials._visit-modal')
                            </div>

                            <!-- Shorthand Data -->
                            <div id="dictionaryData" class="tooltip-card">
                                <div class="tooltip-content">
                                    <div class="arrow"></div>
                                    <div class="content">
                                        @foreach($dictionaries as $dictionary)
                                        <ul class="list-unstyled">
                                            <li>{{ $dictionary->code }}</li>
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Pharmacy Data -->
                            <div id="medicineData" class="tooltip-card">
                                <div class="tooltip-content">
                                    <div class="arrow"></div>
                                    <div class="content">
                                        @foreach($medicines as $medicine)
                                        <ul class="list-unstyled">
                                            <li>{{ $medicine->code }}</li>
                                        </ul>
                                        @endforeach
                                    </div>                                    
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: {{config('app.color')}}">
                                        <h3 class="card-title">New Record</h3>
                                        <input type="submit" id="btnSubmit" value="Submit" class="btn float-right" style="color: {{config('app.color')}}; background-color: white; padding: 2px 10px;">
                                    </div>

                                    <div class="card-body" style="max-height: 600px; overflow-y: scroll;">

                                        <div class="form-group mb-3">
                                            <div class="row">
                                                <div class="col-md-2 col-sm-4 mb-1">
                                                    <input type="text" class="form-control" name="sys_bp" placeholder="Sys">
                                                </div>
                                                <div class="col-md-2 col-sm-4 mb-1">
                                                    <input type="text" class="form-control" name="dia_bp" placeholder="Dia">
                                                </div>
                                                <div class="col-md-2 col-sm-4 mb-1">
                                                    <input type="text" class="form-control" name="pr" placeholder="P.R">
                                                </div>
                                                <div class="col-md-2 col-sm-4 mb-1">
                                                    <input type="text" class="form-control" name="temp" placeholder="Temp">
                                                </div>
                                                <div class="col-md-2 col-sm-4 mb-1">
                                                    <input type="text" class="form-control" name="spo2" placeholder="Spo2">
                                                </div>
                                                <div class="col-md-2 col-sm-4 mb-1">
                                                    <input type="text" class="form-control" name="rbs" placeholder="Rbs">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <textarea class="form-control c-field" id="dictionary" rows="3" placeholder="History & Examination" name="prescription">{{ old('prescription') }}</textarea>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepand">
                                                        <span class="input-group-text">Diagnosis</span>
                                                    </div>
                                                    <textarea class="form-control c-field" id="diagnosis_dictionary" rows="1" name="diag">{{ old('diag') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepand">
                                                        <span class="input-group-text">Diseases</span>
                                                    </div>
                                                    <input type="text" name="disease" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <fieldset class="scheduler-border mb-3"> --}}
                                        {{-- <legend class="scheduler-border">
                                                <input type="text" class="form-control" id="medicine_dictionary" placeholder="Search medicine" name="medicines">
                                            </legend> --}}

                                        <div class="form-group" id="medtable">
                                            <section class="content">
                                                <div class="container-fluid">
                                                    <table class="table table-bordered" id="product_info_table">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:45%;">Medicine</th>
                                                                <th style="width:25%">Dosage</th>
                                                                <th style="width:20%">Days</th>
                                                                <th><button type="button" id="add_tret_med_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id="row_1">
                                                                <td>
                                                                    <input type="text" name="med_name[]" id="product_search_1" med-data-id="1" onkeypress="return searchMed(event)" class="form-control" placeholder="Medicine">
                                                                    <input type="hidden" name="med_id[]" id="med_id_1">
                                                                    <div id="medList_1" style="display:none;width:35%;">
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <input type="text" name="quantity[]" id="qty_1" class="form-control" placeholder="Dosage">
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="days[]" id="days_1" class="form-control" placeholder="Days">
                                                                </td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </section>
                                        </div>
                                        {{-- </fieldset> --}}

                                        <div class="row mb-3">
                                            <div class="col-md-6 m-3">
                                                <a href="#" class="nav-link app-text-color lable lable-secondary text-white" id="procedure_lab_action">Procedures & Investigation <label for="" class="badge badge-secondary" id="c_p_i"></label>
                                                </a>
                                            </div>
                                            @if(Helper::checkPermission('p_update', $permissions))
                                            @include('partials._procedure-lab-modal')
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="file" multiple="multiple" onchange="loadFile(event)" name="images[]" id="upload" hidden />
                                                <label class="file_upload" for="upload" style="background: #E9ECEF;
                                                padding: 8px 15px;
                                                border: 1px solid #CED4DA; 
                                                border-radius: 5px;
                                                cursor: pointer;">Upload Images</label>
                                            </div>

                                            <input type="hidden" pattern="{0-9}" class="form-control d-none" name="fees" placeholder="Fees" value="{{Auth::user()->fees}}" />

                                            <div class="col-md-3">
                                                <div class="form-check" style="padding:6px !important;">
                                                    <div class="icheck-primary d-inline mt-2">
                                                        <input type="checkbox" id="foc" name="is_foc" value="1">
                                                        <label for="foc">FOC</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="d-flex" id="followUp">
                                                    <div class="form-check" style="padding:6px !important;">
                                                        <div class="icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="isFollowup" name="is_followup" value="1">
                                                            <label for="isFollowup">Follow up</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-5">
                                                <div class="d-flex justify-content-center" id="followUp">
                                                    <div class="form-check" style="padding:6px !important;">
                                                        <div class="icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="isFollowup" name="is_followup" value="1">
                                                            <label for="isFollowup">Follow up</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                    </div>

                                    {{-- <div class="col-md-5">
                                                <div class="d-flex justify-content-center" id="followUp">
                                                    <div class="form-check" style="padding:6px !important;">
                                                        <div class="icheck-primary d-inline mt-2">
                                                            <input type="checkbox" id="isFollowup" name="is_followup" value="1">
                                                            <label for="isFollowup">Follow up</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div> --}}
                                </div>

                                <div id="imgModal" class="modal">
                                    <span id="imgClose" class="close">&times;</span>
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
    let procedure_lab_modal = document.getElementById("procedure_modal");

    // Get the button that opens the modal
    let viewBtn = document.getElementById("viewBtn");
    let editBtn = document.getElementById("editBtn");
    let procedureBtn = document.getElementById("procedure_lab_action");
    var clinic_id = {{ session() -> get('cc_id') }};


    // When the user clicks the button, open the modal
    viewBtn.onclick = function() {
        viewModal.style.display = "block";
    }

    editBtn.onclick = function() {
        editModal.style.display = "block";
    }

    $("#save_pro_btn").click(function(e){
        e.preventDefault();

        var patient_id={{ $patient->id }};

        var task = [];
        var qty = [];
        var price = [];

        $("#lab_pro_list > tbody > tr").each(function () {
            task.push($(this).find('td').eq(0).text());
            qty.push($(this).find('td').find('input').val());
            price.push($(this).find('td').eq(2).text());
        });

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //  Invoke click event of target so that non-form submit behaviors will work

        $.ajax({
            url: '/clinic-system/patient/'+patient_id+'/lab',
            type: 'POST',
            data: {
                    name: task,
                    quantity: qty,
                    price: price,
                    patient_id: patient_id,
                },

            beforeSend: function() {
                $('.lds-ring').removeClass('d-none');
            },
            success: function(response) {
                if(response == 'true')
                {

                    var count_table_tbody_tr = $("#lab_pro_list tbody tr").length;

                    procedure_lab_modal.style.display = "none";

                    if (count_table_tbody_tr > 0) {
                        $("#c_p_i").text(count_table_tbody_tr);
                    }

                }
            }

        })
        
        
    })

    procedureBtn.onclick = function() {

        console.log($("#c_p_i").text());

        if($("#c_p_i").text() == ''){

            procedure_lab_modal.style.display = "block";


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //  Invoke click event of target so that non-form submit behaviors will work

            $.ajax({
                url: '/clinic-system/fetchData',
                type: 'GET',
                beforeSend: function() {
                    $('.lds-ring').removeClass('d-none');
                },
                success: function(response) {

                    var html = '';

                    $.each(response, function(index, value) {

                    
                        html += '<li id="procedure-lab-list"><input type="checkbox" id="checkbox_'+(value.id)+'"  procedure-data='+value.name+' value="'+value.code+'" attr="'+value.id+'"><label for="checkbox_'+(value.id)+'">'+value.code+'</label></li> ';
                        
                    });

                    $("#ps-list").append(html);
                    $('.lds-ring').addClass('d-none');
                    $('.lds-ring').detach().appendTo('#lab_pro_list');

                    

                    $.each($("[procedure-data]"),function(index,value){

                        var id = $(this).attr('attr');//show expression (for debug)

                        $("#checkbox_"+id).on('change',function(){
                                if($(this).is(':checked')){
                                    var key = $(this).val();
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                        type: "POST",
                                        url: '/clinic-system/fetchProLab',
                                        data: {
                                            key: key,
                                            id: clinic_id,
                                        },

                                        beforeSend: function() {
                                            $('.lds-ring').removeClass('d-none');
                                        },
                                    
                                        success: function(response) {


                                        var result = JSON.parse(response);

                                        var name = result.name.split('^').filter(function(i){return i});

                                        var price = result.price.split('^').filter(function(i){return i});

                                        var value = result.id;

                                        var count_table_tbody_tr = $("#lab_pro_list tbody tr").length;

                                        var html = '';

                                        var j = 0;
                                        
                                        for(i = 0; i < name.length; i++)
                                        {   

                                            html += '<tr id="pro_lab_row_'+value+'" class="row_'+value+'">' +
                                                        '<td>' +
                                                            name[i]+
                                                        '</td>' +
                                                        '<td>'+
                                                            '<div class="quantity">'+
                                                                '<a href="#" class="quantity__minus" id="quantity__minus_'+name[i]+'" onclick="deQty(\''+name[i]+'\')" attr="minus"><span>-</span></a>'+
                                                                '<input name="quantity" type="text" class="quantity__input" id="quantity__input_'+name[i]+'" value="1" readonly>'+
                                                                '<a href="#" class="quantity__plus" id="quantity__plus_'+name[i]+'" onclick="inQty(\''+name[i]+'\')" attr="plus"><span>+</span></a>'+
                                                            '</div>'+
                                                        '</td>'+
                                                        '<td><small id="price_'+name[i]+'" attr-value-id='+price[i]+'>'+price[i]+'</small></td>' +

                                                        '<td><button type="button" class="btn btn-default" onclick="removeProLabRow(\''+value+'\')"><i class="fa fa-minus"></i></button></td>' +
                                                    '</tr>';

                                                    
                                        }

                                        if(count_table_tbody_tr == 0)
                                        {
                                            $(".pro-action").removeClass('d-none');

                                        }


                                        if (count_table_tbody_tr >= 1) {
                                            $("#lab_pro_list tbody tr:last").after(html);
                                        } else {
                                            $("#lab_pro_list tbody").html(html);
                                        }
                                            $('.lds-ring').addClass('d-none');

                                    },
                                });
                            }else{

                                $('[id=pro_lab_row_'+id+']').remove();
                                
                                var count_table_tbody_tr = $("#lab_pro_list tbody tr").length;

                                if (count_table_tbody_tr == 0)
                                {
                                    $(".pro-action").addClass('d-none');
                                }
                            }
                        });
                    });
                }

            });
        }else{
            procedure_lab_modal.style.display = "block";
            alert('value exists');
        }
}

    // Close the modal
    $("#viewClose").click(function(e) {
        viewModal.style.display = "none";
    })

    $("#editClose").click(function(e) {
        editModal.style.display = "none";
    })

    $("#procedureClose").click(function(e){
        $('[id=procedure-lab-list]').remove();
        $("#lab_pro_list tr").remove();
        $(".pro-action").addClass('d-none');
       
        procedure_lab_modal.style.display = "none";

        
    });

    $("#add_tret_med_row").on('click', function() {
        var table = $("#product_info_table");
        var count_table_tbody_tr = $("#product_info_table tbody tr").length;
        var row_id = count_table_tbody_tr + 1;
        var html = '<tr id="row_' + row_id + '">' +
            '<td>' +
            '<input type="search" name="med_name[]" id="product_search_' + row_id + '"  med-data-id = ' + row_id + ' onkeypress="return searchMed(event)" class="form-control" placeholder="Search Medicine">' +
            '<input type = "hidden" name = "med_id[]" id = "med_id_' + row_id + '">' +
            '<div id="medList_' + row_id + '" style="display:none;position:absolute;width:35%;"></div>' +
            '</td>' +
            '<td><input type="text" name="quantity[]" id="qty_' + row_id + '" class="form-control"></td>' +
            '<td><input type="number" name="days[]" id="days_' + row_id + '" class="form-control"></td>' +
            '<td><button type="button" class="btn btn-default" onclick="removeRow(\'' + row_id + '\')"><i class="fa fa-minus"></i></button></td>' +
            '</tr>';
        if (count_table_tbody_tr >= 1) {
            $("#product_info_table tbody tr:last").after(html);
        } else {
            $("#product_info_table tbody").html(html);
        }
    });
    $(document).ready(function() {
        $(window).on("keydown", function(event) {
            var id = event.target.id;

            // Check to see if ENTER was pressed and the submit button was active or not
            if (event.keyCode === 13 && event.target === document.getElementById("btnSubmit")) {
                // It was, so submit the form
                document.querySelector("form").submit();

            } else if (event.keyCode === 13 && event.target == document.getElementById("medicine_dictionary")) {
                medicine_dictionary(event);
                event.preventDefault();

                //  Invoke click event of target so that non-form submit behaviors will work
                event.target.click();
            } else if (event.keyCode === 13 && id.includes("product_search")) {

                searchMed(event);
                event.preventDefault();
            } else if (event.keyCode === 13) {
                event.preventDefault();
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //  Invoke click event of target so that non-form submit behaviors will work

    });

    $(document).ready(function() {
        let dictionaryTooltip = $('#dictionaryTooltip');
        let medicineTooltip = $('#medicineTooltip');
        let dictionaryData = $('#dictionaryData');
        let medicineData = $('#medicineData');

        dictionaryTooltip.hover(
            function() {
                dictionaryData.css('visibility', 'visible');
                dictionaryData.css('opacity', 1);
            },
            function() {
                dictionaryData.css('visibility', 'hidden');
                dictionaryData.css('opacity', 0);
            }
        );

        medicineTooltip.hover(
            function() {
                medicineData.css('visibility', 'visible');
                medicineData.css('opacity', 1);
            },
            function() {
                medicineData.css('visibility', 'hidden');
                medicineData.css('opacity', 0);
            }
        );
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
            url: action = "{{ route('patient.updatePatient', $patient->id) }}",
            type: 'PATCH',
            data: formData,
            success: function(response) {
                editModal.style.display = "none";
                $('.wrapper').css('opacity', '1');
                $('.middle').css('opacity', '0.1');

                let gender = response.gender == 1 ? 'M' : 'F';
                let drug_allergy = response.drug_allergy ?? 'None';

                $('#name').html("<span>" + response.name + "</span>");
                $('#gender').html("<span class='text-danger'>" + gender + "</span>");
                $('#age').html("<span>" + response.age + ' years' + "</span>");
                $('#drug_allergy').html("<b>Allergy :</b> " + drug_allergy);
                $('#father_name').html("<b>Father :</b> " + response.father_name);

                let modalGender = response.gender == 1 ? 'Male' : 'Female';

                $('#modalName').text(response.name);
                $('#modalAge').text(response.age);
                $('#modalGender').text(modalGender);
                $('#modalDrugAllergy').text(response.drug_allergy);
                $('#modalDisease').text(response.disease);
                $('#modalFatherName').text(response.father_name);
                $('#modalCode').text(response.code);
                $('#modalPhone').text(response.phoneNumber);
                $('#modalAddress').text(response.address);
            },
            error: function(xhr) {
                // Handle the error response
                $('.wrapper').css('opacity', '1');
                $('.middle').css('opacity', '0.1');

                let data = JSON.parse(xhr.responseText);

                let name = data.errors.name ? data.errors.name[0] : '';
                let age = data.errors.age ? data.errors.age[0] : '';
                let address = data.errors.address ? data.errors.address[0] : '';
                let disease = data.errors.disease ? data.errors.disease[0] : '';
                let gender = data.errors.gender ? data.errors.gender[0] : '';

                $('#nameError').html(name);
                $('#ageError').html(age);
                $('#addressError').html(address);
                $('#diseaseError').html(disease);
                $('#genderError').html(gender);
            }
        });
    });

    // Ajax Pagination
    $(document).ready(function() {

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });
    });

    function fetch_data(page) {
        $.ajax({
            url: "?page=" + page,
            success: function(data) {
                if (data === "updated") {
                    fetch_data(page);
                    bindModalHandlers();
                } else {
                    $('#visit-lists').html(data);
                    bindModalHandlers();
                }
            }
        });
    }

    function bindModalHandlers() {
        $(document).on('click', '#visitBtn', function() {
            $('#visitModal').css('display', 'block');
        });

        $(document).on('click', '#visitClose', function(e) {
            $('#visitModal').css('display', 'none');
        });
    }

    // Visit Records Modal
    let visitBtn = document.getElementById('visitBtn');
    let visitModal = document.getElementById('visitModal');

    visitBtn.onclick = function() {
        visitModal.style.display = "block";
    }

    $("#visitClose").click(function(e) {
        visitModal.style.display = "none";
    })


    var loadFile = function(event) {
        for (var i = 0; i < event.target.files.length; i++) {
            var src = URL.createObjectURL(event.target.files[i]);
            $("#image").append("<img id='myImg" + i + "' onclick='showImage(" + i + ")' src=" + src + " style='margin:4px;width:100px;border-radius:5px;cursor:pointer;' alt='img' />");

        }
    };

    let imgModal = document.getElementById("imgModal");
    let captionText = document.getElementById("caption");

    function showImage(id, i) {
        let origin_image = document.getElementById("myImg" + id + i);
        imgModal.style.display = "block";
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

    // Close image model
    $("#imgClose").click(function(e) {
        imgModal.style.display = "none";
    })

    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function(event) {
        if (event.target == imgModal) {
            imgModal.style.display = "none";
        }
    });

    var dictCode = '';

    function medicine_dictionary(event) {
        var id = event.target.id;
        var clinic_id = {{ session() -> get('cc_id') }};
        var name = document.getElementById(id).value;
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

                    data = res[0].split('^');
                    var current_rowid = event.target.getAttribute("med-data-id");
                    document.getElementById("product_search_" + current_rowid).value = data[1];
                    document.getElementById("qty_" + current_rowid).value = data[2];
                    document.getElementById("days_" + current_rowid).value = data[3];
                    for (i = 1; i < fil_res.length; i++) {
                        data = res[i].split('^');
                        html += '<tr id="row_' + row_id + '">' +
                            '<td>' +
                            '<input type="text" name="med_name[]" id="product_search_' + row_id + '" med-data-id = ' + row_id + ' onkeypress="return searchMed(event)" value="' + data[1] + '"  class="form-control" placeholder="Search Medicine">' +
                            '<input type = "hidden" name = "med_id[]" id = "med_id_' + row_id + '" value="' + data[0] + '" >' +
                            '<div id="medList_' + row_id + '" style="position:absolute;top:10px;display:none;width:35%;"></div>' +
                            '</td>' +
                            '<td><input type="text" name="quantity[]" id="qty_' + row_id + '" class="form-control" placeholder="Dosage" value="' + data[2] + '" ></td>' +
                            '<td><input type="number" name="days[]" id="days_' + row_id + '" class="form-control" placeholder="Days" value="' + data[3] + '"></td>' +
                            '<td><button type="button" class="btn btn-default" onclick="removeRow(\'' + row_id + '\')"><i class="fa fa-minus"></i></button></td>' +
                            '</tr>';
                        row_id++;
                    }
                    $("#product_info_table tbody").append(html)
                               
                }
            });
        }
    }

    function searchMed(event) {
        if (event.keyCode == 13) {
            medicine_dictionary(event)
        } else {
            var rowid = event.target.getAttribute("med-data-id");
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
        }
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

    function removeProLabRow(id){
        $("#pro_lab_row_"+id).remove();
        var count_table_tbody_tr = $("#lab_pro_list tbody tr").length;
        if (count_table_tbody_tr == 0)
        {
            $(".pro-action").addClass('d-none');

        }

        $('#checkbox_'+id).prop('checked', this.value == 0); // Unchecks it
    }

    function inQty(id) {
        const plus = $('#quantity__plus_' + id);
        const input = $('#quantity__input_' + id);
        const price = $('#price_' + id);
        const or_price = $('#price_' + id).attr('attr-value-id');


        if (value > 1) {

            value--;
        }
        var value = input.val();
        value++;
        input.val(value);
        price.text(parseInt(input.val()) * parseInt(or_price));

    }

    function deQty(id) {
        const minus = $('#quantity__minus_' + id);
        const input = $('#quantity__input_' + id);
        const price = $('#price_' + id);
        const or_price = $('#price_' + id).attr('attr-value-id');


        var value = input.val();
        if (value > 1) {

            value--;
        }
        input.val(value);

        price.text(parseInt(input.val()) * parseInt(or_price));

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

            if (response === "updated") {
                let currentPage = $('.pagination .active').text();

                if (currentPage > 1) {
                    fetch_data(currentPage - 1);
                } else {
                    fetch_data(currentPage);
                }
            }
        });
    }
</script>
@endsection
{{-- @include('layouts.js') --}}