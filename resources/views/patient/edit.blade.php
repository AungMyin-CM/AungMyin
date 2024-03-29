@extends("layouts.app")

@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <form method="post" action="{{ route('patient.update', $patient->id) }}">
                @csrf
                @method('PATCH')

                <section class="content-header">
                    {{-- <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Patient Form</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Patient</a></li>
                                        <li class="breadcrumb-item active">Edit</li>
                                    </ol>
                                </div>
                            </div>
                            
                        </div><!-- /.container-fluid --> --}}
                </section>
                <section class="content">
                    <div class="container-fluid">

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: {{config('app.color')}}">
                                        <h3 class="card-title">Edit Patient</h3>
                                    </div>

                                    <div class="card-body">
                                        {{-- <p class="badge badge-secondary fs-3">{{ $code }}
                                        </p><br /> --}}

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="patient_name" name="name" placeholder="Name" value="{{ $patient->name }}" autocomplete="off">
                                                    @error('name') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_name">Father name</label>
                                                    <input type="text" class="form-control" id="f-name" name="father_name" placeholder="Father name" value="{{ $patient->father_name }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="age">Age</label>
                                                    <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" min="1" max="100" placeholder="Age" value="{{ $patient->age }}" autocomplete="off">
                                                    @error('age') <span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber">Phone Number</label>
                                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="09xxxxxxxxx" value="{{ $patient->phoneNumber }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address" autocomplete="off">{{ $patient->address }}</textarea>
                                            @error('address') <span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="form-group">

                                            <label for="gender">Gender</label>
                                            @if($patient->gender == 1)
                                            <?php
                                            $m_checked = 'checked';
                                            $f_checked = '';
                                            ?>
                                            @else
                                            <?php
                                            $m_checked = '';
                                            $f_checked = 'checked';
                                            ?>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="male" type="radio" value="1" name="gender" <?php echo $m_checked; ?>>
                                                        <label class="form-check-label" for="male">
                                                            Male
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="female" type="radio" value="0" name="gender" <?php echo $f_checked; ?>>
                                                        <label class="form-check-label" for="female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('gender') <span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Drug Allergy</label>
                                                    <textarea class="form-control" placeholder="Drug Allergy" rows="4" name="drug_allergy" autocomplete="off">{{ $patient->drug_allergy }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Summary</label>
                                                    <textarea class="form-control" placeholder="Summary" rows="4" name="summary" autocomplete="off">{{ $patient->summary }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn text-white" style="background-color: {{config('app.color')}}">Submit</button>
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
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection
{{-- @include('layouts.js') --}}