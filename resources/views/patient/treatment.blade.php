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
                                                                <li>{{ Str::limit($row['diag'], $limit = 20, $end = '...') }}</li>
                                                            @endif

                                                            @if($row['diag'] != '')
                                                                <li>{{ Str::limit($row['diag'], $limit = 20, $end = '...') }}</li>
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

                                                <input type="file" multiple="multiple" onchange="loadFile(event)" class="form-control float-right" name="images[]" />

                                            {{-- <div class="form-group">
                                                <label for="address">Image</label>
                                            </div> --}}

                                            <div calss="form-group">
                                                <img id="output" width="200" />
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
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
@endsection
{{-- @include('layouts.js') --}}
