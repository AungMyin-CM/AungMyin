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
    .modal-content,
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

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <form action="{{ route('patient.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <section class="content">
                    <div class="container-fluid">
                        <span style="font-size: 100% !important;margin:5px 0px 5px 0px;" class="badge badge-secondary">Code - {{ $data['code'] }}</span>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header" style="  background-color:{{config('app.color')}}">
                                        <h3 class="card-title">New Patient</h3>
                                    </div>

                                    <div class="card-body">
                                        {{-- <p class="badge badge-secondary fs-3">{{ $code }}
                                        </p><br /> --}}

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    @if($data['name'] != '')
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="patient_name" name="name" placeholder="Name" value=" {{ $data['name'] }}" autocomplete="off">
                                                    @else
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="patient_name" name="name" placeholder="Name" value="{{ old('name') }}" autocomplete="off">
                                                    @endif

                                                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="father_name">Father name</label>
                                                    <input type="text" class="form-control" id="f-name" name="father_name" placeholder="Father name" value="{{ old('father_name') }}" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="age">Age</label>
                                                    <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" min="1" max="100" placeholder="Age" value="{{ old('age') }}" autocomplete="off">

                                                    @error('age') <span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="phoneNumber">Phone Number</label>
                                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="09xxxxxxxxx" value="{{ old('phoneNumber') }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address" autocomplete="off">{{ old('address') }}</textarea>
        
                                                    @error('address') <span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                           

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Drug Allergy</label>
                                                    <textarea class="form-control" placeholder="Drug Allergy" rows="4" name="drug_allergy" autocomplete="off">{{ old('drug_allergy') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Summary</label>
                                                    <textarea class="form-control" placeholder="Summary" rows="4" name="summary" autocomplete="off">{{ old('summary') }}</textarea>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        

                                        <div class="row">

                                            <div class="col-md-6">
                                           
                                                <div class="form-group">
        
                                                    <label for="gender">Gender</label>
        
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input @error('gender') is-invalid @enderror" id="male" type="radio" value="1" name="gender">
                                                                <label class="form-check-label" for="male">
                                                                    Male
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input @error('gender') is-invalid @enderror" id="female" type="radio" value="0" name="gender">
                                                                <label class="form-check-label" for="female">
                                                                    Female
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('gender') <span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group float-right">
                                                <input type="submit" value="Submit" class="btn text-white" style="background-color:{{config('app.color')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

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


@endsection
{{-- @include('layouts.js') --}}