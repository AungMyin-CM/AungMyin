@extends("layouts.app")

@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Patient Form</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Patient</a></li>
                                    <li class="breadcrumb-item active">New</li>
                                </ol>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center" id="followUp">
                            <div class="form-check" style="padding:6px !important;">
                                {{-- <input class="form-check-input" id="isFollowup" type="checkbox" name="isFollowup">
                                <label class="form-check-label" for="Follow-up">
                                    Follow up
                                </label> --}}
                                <div class="icheck-primary d-inline mt-2">
                                    <input type="checkbox" id="isFollowup" type="checkbox" name="isFollowup">
                                    <label for="isFollowup">Follow up</label>
                                </div>
                            </div>

                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <form action="{{ route('patient.store') }}" method="POST">

                    @csrf

                    <section class="content">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="card card-primary">
                                        <div class="card-header">
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
                                                        <input type="text" class="form-control" id="patient_name"
                                                            name="name" placeholder="Name" value=" {{ old('name') }}">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="sel1">Father name</label>
                                                        <input type="f-name" class="form-control" id="f-name"
                                                            name="father_name" placeholder="Father name"
                                                            value="{{ old('father_name') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Age</label>
                                                        <input type="number" class="form-control" id="age" name="age"
                                                            min="1" max="100" placeholder="Age" value="{{ old('age') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phoneNumber">Phone Number</label>
                                                        <input type="tel" class="form-control" id="phoneNumber"
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
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">....</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="address">Investigation</label>
                                                <textarea class="form-control" id="dictionary" rows="10" placeholder="Start Typing here..."
                                                    name="dictionary">{{ old('dictionary') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
{{-- @include('layouts.js') --}}
