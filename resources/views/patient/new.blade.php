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
                <form action="{{ route('patient.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <section class="content">
                        <div class="container-fluid">
                            <span style="font-size: 100% !important;margin:5px 0px 5px 0px;"  class="badge badge-secondary">Code - {{ $data['code'] }}</span>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header"  style="  background-color:{{config('app.color')}}">
                                            <h3 class="card-title">New Patient</h3>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br />
                                        @endif
                                        <div class="card-body">
                                            {{-- <p class="badge badge-secondary fs-3">{{ $code }}
                                            </p><br /> --}}

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        @if($data['name'] != '')
                                                            <input type="text" class="form-control" id="patient_name"
                                                            name="name" placeholder="Name" value=" {{ $data['name'] }}">
                                                        @else
                                                            <input type="text" class="form-control" id="patient_name"
                                                            name="name" placeholder="Name" value="{{ old('name') }}">
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="father_name">Father name</label>
                                                        <input type="text" class="form-control" id="f-name"
                                                            name="father_name" placeholder="Father name"
                                                            value="{{ old('father_name') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="age">Age</label>
                                                        <input type="number" class="form-control" id="age" name="age"
                                                            min="1" max="100" placeholder="Age" value="{{ old('age') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phoneNumber">Phone Number</label>
                                                        <input type="text" class="form-control" id="phoneNumber"
                                                            name="phoneNumber" placeholder="09xxxxxxxxx"
                                                            value={{ old('phoneNumber') }}>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" placeholder="Address" name="address">{{ old('address') }}</textarea>
                                            </div>

                                            <div class="form-group">

                                                <label for="gender">Gender</label>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="male" type="radio" value="1"
                                                                name="gender">
                                                            <label class="form-check-label" for="male">
                                                                Male
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="female" type="radio"
                                                                value="0" name="gender">
                                                            <label class="form-check-label" for="female">
                                                                Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Drug Allergy</label>
                                                        <textarea class="form-control" placeholder="Drug Allergy" rows="4"
                                                            name="drug_allergy">{{ old('drug_allergy') }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Summary</label>
                                                        <textarea class="form-control" placeholder="Summary" rows="4" name="summary">{{ old('summary') }}</textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group float-right">
                                                <input type="submit" value="submit" class="btn btn-primary" style=" background-color:{{config('app.color')}}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @if($role_type == 1 || $role_type == 5)
                                    <div class="col-md-6">
                                        <div class="card card-primary">
                                            <div class="card-header"  style=" background-color: {{config('app.color')}}">
                                                <h3 class="card-title">....</h3>
                                            </div>
                                            <div class="card-body">

                                                <div class="form-group">
                                                    <label for="address">Prescription</label>
                                                    <textarea class="form-control" id="dictionary" rows="10" placeholder="Start Typing here..."
                                                        name="prescription">{{ old('prescription') }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="address">Diagnosis</label>
                                                    <textarea class="form-control" id="diagnosis_dictionary" rows="6" placeholder="Start Typing here..."
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
                                                            <textarea class="form-control" rows="5" placeholder="Start Typing here..."
                                                                name="investigation">{{ old('investigation') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address">Procedure</label>
                                                            <textarea class="form-control" rows="5" placeholder="Start Typing here..."
                                                                name="procedure">{{ old('procedure') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="number" pattern="{0-9}" class="form-control" name="fees" placeholder="Fees" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8">

                                                        <div class="d-flex justify-content-center" id="followUp">
                                                            <div class="form-check" style="padding:6px !important;">
                                                                
                                                                <div class="icheck-primary d-inline mt-2">
                                                                    <input type="checkbox" id="isFollowup" type="checkbox" name="is_followup">
                                                                    <label for="isFollowup">Follow up</label>
                                                                </div>
                                                            </div>
                                
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                            </div>
                                            
                                            <!-- Bootstrap Switch -->
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col (right) -->
                                    </div>
                                @endif
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
        
    </script>
@endsection
{{-- @include('layouts.js') --}}
