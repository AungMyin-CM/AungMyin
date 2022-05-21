@extends("layouts.app")

@section('content')

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

                <form action="{{ route('create.treatment', $data['patient']['id']) }}" method="POST" enctype="multipart/form-data">
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
                                                <div class="card" style="background:#a19090;">
                                                    <div class="card-header border-0">
                                                    <h3 class="card-title">{{ $row['updated_at'] }}</h3>
                                                        <div class="card-tools">
                                                            <a href="#" class="btn btn-sm btn-tool">
                                                                <i class="fas fa-edit" style="color:black;"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-tool">
                                                                <i class="fas fa-trash" style="color:black;"></i>
                                                            </a>
                                                        </div><br/>

                                                        <ul>
                                                            @if($row['prescription'] != '')
                                                                <li><?php echo Str::limit($row['prescription'], $limit = 100, $end = '...') ;?></li>
                                                            @endif

                                                            @if($row['diag'] != '')
                                                                <li>{{ Str::limit($row['diag'], $limit = 100, $end = '...') }}</li>
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
                                                <textarea class="form-control" id="dictionary" rows="10" placeholder="Start Typing here..."
                                                    name="prescription">{{ old('prescription') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Diagnosis</label>
                                                <textarea class="form-control" id="diagnosis_dictionary" rows="6" placeholder="Start Typing here..."
                                                    name="diag">{{ old('diag') }}</textarea>

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
                                                        <textarea class="form-control" id="dictionary" rows="5" placeholder="Start Typing here..."
                                                            name="investigation">{{ old('investigation') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Procedure</label>
                                                        <textarea class="form-control" id="dictionary" rows="5" placeholder="Start Typing here..."
                                                            name="procedure">{{ old('procedure') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" pattern="{0-9}" class="form-control" name="fees" placeholder="Fees" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

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
        
    </script>
@endsection
{{-- @include('layouts.js') --}}
