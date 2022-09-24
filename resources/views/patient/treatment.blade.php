@extends("layouts.app")

@section('content')

<style>
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
  }
  
  #myImg:hover {opacity: 0.7;}
  
  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }
  
  /* Modal Content (image) */
  .modal-content {
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
  .modal-content, #caption {  
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
  }
  
  @-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
  }
  
  @keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
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
  
  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px){
    .modal-content {
      width: 100%;
    }
  }
  </style>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper">
                
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="card card-primary">
                            <div class="card-body" style="padding: 0.9rem !important;"> 
                                <div class="row mb-2">
                                    <div class="col-sm-2">
                                        <h6><b>Name :</b> {{ $data['patient']['name'] }} </h6>
                                    </div>
                                    <div class="col-sm-2">
                                        <h6><b>Age :</b> {{ $data['patient']['age'] }} </h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6><b>Father's Name :</b> {{ $data['patient']['father_name'] }} </h6>
                                    </div>
                                    <div class="col-sm-2">
                                        <h6><b>Gender :</b> {{ $data['patient']['gender'] == 1 ? 'Male' : 'Female' }} </h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6><b>Phone-Number :</b> {{ $data['patient']['phoneNumber'] }} </h6>
                                    </div>
                                    
                                </div>
                                <div class="row mb-2">
                                   
                                    <div class="col-sm-12">
                                        <h6><b>Address :</b> {{ $data['patient']['address'] }} </h6>
                                    </div>
                                    
                                   
                                </div>
                                <div class="row mb-2">
                                   
                                    <div class="col-sm-12">
                                        <h6><b>Allergy :</b> {{ $data['patient']['drug_allergy'] }} </h6>
                                    </div>
                                   
                                </div>

                            </div>

                        </div>

                    </div>
                </section>                

                <form action="{{ route('create.treatment', $data['patient']['id']) }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                
                    <section class="content">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-4">

                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Patient Treatment</h3>
                                        </div>
                                       
                                        <div class="card-body"> 
                                            @foreach ($data['visit'] as $row)
                                                <div class="card" style="background:#a19090;" id="treatment_data_{{$row['id']}}">
                                                    <div class="card-header border-0">
                                                        <h3 class="card-title" title="{{$row['update_at']}}">{{ $row['updated_at']->diffForHumans() }}</h3>
                                                        <div class="card-tools">
                                                            <a class="btn btn-sm btn-tool">
                                                                <i class="fas fa-copy" style="color:black;" onclick="copyData({{$row['id']}})"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-tool">
                                                                <i class="fas fa-trash" style="color:black;" onclick="removeData({{$row['id']}})"></i>
                                                            </a>
                                                        </div><br/>

                                                        <ul>
                                                            @if($row['prescription'] != '')
                                                                <li><?php echo Str::limit($row['prescription'], $limit = 100, $end = '...') ;?></li>
                                                            @endif

                                                            @if($row['diag'] != '')
                                                                <li>{{ Str::limit($row['diag'], $limit = 100, $end = '...') }}</li>
                                                            @endif

                                                            @if($row['investigation'] != '')
                                                                <li>{{ Str::limit($row['investigation'], $limit = 100, $end = '...') }}</li>
                                                            @endif

                                                            @if($row['procedure'] != '')
                                                                <li>{{ Str::limit($row['procedure'], $limit = 100, $end = '...') }}</li>
                                                            @endif

                                                
                                                        </ul>

                                                        <div class="float-left">
                                                            <small>Fees:</small>  {{ $row['fees'] }}
                                                            <input type="hidden" name="code" value="{{ $data['patient']['code'] }}" >
                                                        </div>
                                                        @if($row['is_followup'] == '1')
                                                            <div class="float-right">
                                                                <small>follow up: {{ date('d-m-Y', strtotime($row['followup_date'])) }}</small>  
                                                            </div>
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <?php
                                                                $images_r = substr($row['images'],1,-1);

                                                                $images = explode(",", $images_r);

                                                                for($i=0; $i < count($images); $i++){
                                                                    if($images[$i] != ''){
                                                                        // echo "<img id='myImg'".$row['id']."onclick='showImage($row['id'])' src="asset('images/'substr(json_encode($data['images'][$i]),1,-1))" style='margin:4px;width:50px;border-radius:5px;cursor:pointer;' alt='img' />";
                                                                        echo "<img id='myImg".$i."' onclick='showImage($i)' src=".asset('images/treatment-images/'.substr($images[$i],1,-1))." style='margin:4px;width:50px;border-radius:5px;cursor:pointer;' alt='img'>";
                                                                    }
                                                                }
                                                                
                                                            ?>
                                                          

                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">....</h3>
                                            
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="address">Prescription</label>
                                                <textarea class="form-control c-field" id="dictionary" rows="10" placeholder="Start Typing here..."
                                                    name="prescription">{{ old('prescription') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Diagnosis</label>
                                                <textarea class="form-control c-field" id="diagnosis_dictionary" rows="6" placeholder="Start Typing here..."
                                                    name="diag">{{ old('diag') }}</textarea>

                                            </div>

                                            <div class="form-group">
                                                <label for="address">Search Medicine</label>
                                                <textarea type="text" class="form-control" id="medicine_dictionary" placeholder="Start Typing here..."
                                                    name="medicines"></textarea>
                                            </div>

                                            <div class="form-group" id="medtable">
                                                
                                            </div>

                                            <input type="file" multiple="multiple" onchange="loadFile(event)" name= "images[]" id="upload" hidden/>
                                            <label class="file_upload" for="upload" 
                                            style="background: gray;
                                            padding: 8px;
                                            border-radius: 5px;
                                            cursor: pointer;">Upload Images</label>
                                        
                                            <div id="myModal" class="modal">
                                                <span class="close">&times;</span>
                                                <img class="modal-content" id="img01">
                                                <div id="caption"></div>
                                            </div>

                                            <div class="form-group" id="image">
                                                {{-- <img id="myImg" src="" style='margin:4px;width:100px;border-radius:5px;' alt="img" /> --}}
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Investigation</label>
                                                        <textarea class="form-control c-field" id="investigation" rows="5" placeholder="Start Typing here..."
                                                            name="investigation">{{ old('investigation') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Procedure</label>
                                                        <textarea class="form-control c-field" id="procedure" rows="5" placeholder="Start Typing here..."
                                                            name="procedure">{{ old('procedure') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                {{-- <div class="col-md-4">
                                                    <div class="form-group">
                                                       <label for="address" class="d-none">Fees</label>
                                                        <input type="number" pattern="{0-9}" class="form-control d-none" name="fees" placeholder="Fees" value={{Auth::user()->fees}} readonly />
                                                    </div>
                                                </div> --}}
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
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group float-right">
                                                <input type="submit" value="submit" class="btn btn-primary">
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
        var loadFile = function(event) {
            for(var i =0; i< event.target.files.length; i++){
                var src = URL.createObjectURL(event.target.files[i]);
                $("#image").append("<img id='myImg"+i+"' onclick='showImage("+i+")' src="+src+" style='margin:4px;width:100px;border-radius:5px;cursor:pointer;' alt='img' />");

            }
        };

        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        function showImage(id)
        {
            var origin_image = document.getElementById("myImg"+id);
            modal.style.display = "block";
            modalImg.src = origin_image.src;
            console.log(modalImg.src);
            captionText.innerHTML = origin_image.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
            modal.style.display = "none";
        }

        var dictCode = '';

        $("#medicine_dictionary").on('keypress keydown',function(event) {
        var key = event.keyCode;
        var evtType = event.type;

        if(evtType == 'keydown'){
            if(key ==8){
                dictCode = dictCode.slice(0,-1);
            }
        }
        if(evtType == 'keypress'){
        
                if(key == 13 || key == 32) 
                {   
                    if(dictCode != '') {

                        document.getElementById('medtable').innerHTML = '';

                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: '/clinic-system/fetchIsmed',
                        data: { key: dictCode}
                    }).done(function( response ) {
                        if(response != ''){
                            var obj = JSON.parse(response);
                            const res = obj.meaning.split("<br>");

                            var fil_res = res.filter(function (el) {
                                return el != "";
                            });

                            var table_str = '<table class="table table-bordered">';
                                for (i =0; i<fil_res.length ; i++){

                                    data = res[i].split('^');
                                
                                    table_str +=
                                    '<tr id="row_'+i+'">'+
                                        '<td><input type="hidden"  name="med_id[]"  class="form-control" value="'+data[0]+'" /> '+
                                        '<input type="text" name="med_name[]" class="form-control" value="'+data[1]+'" readonly /> </td>'+
                                        '<td><input type="text"  name="med_qty[]" class="form-control" value="'+data[2]+'" /></td>'+
                                        '<td><input type="text"   name="days[]"  class="form-control" value="'+data[3]+'"/></td>'+
                                        '</td>'+
                                    '</tr>';
                                }
                                table_str +=  '</table >';
                            
                            $('#medtable').append(table_str);
                        }
                    });
                    }
                    dictCode = '';
                }else{
                    dictCode += event.key;
                }        
        }
    });

    function removeRow(id)
    {
        $("#medtable table tr#row_"+id).remove();
    }

    function copyData(id)
    {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: '/clinic-system/copy-data',
            data: { id: id},
        beforeSend: function(){
            console.log("HEllo");
            $('.c-field').attr('style','opacity:0.1');
        },
        success: function( response ) {
            $("#dictionary").text(response.prescription);
            $("#diagnosis_dictionary").text(response.diag);
            $("#investigation").text(response.investigation);
            $("#procedure").text(response.procedure);
        },
        complete: function(response) {
            $('.c-field').removeAttr('style','opacity:0.1');
        }
        });
    }

    function removeData(id)
    {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: '/clinic-system/remove-data',
            data: { id: id}
        }).done(function( response ) {
            $("#treatment_data_"+id).slideUp();
        });
    }

    </script>
@endsection
{{-- @include('layouts.js') --}}
