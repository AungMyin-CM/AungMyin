@extends("layouts.app")
@section('content')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @if (Session::has('success'))
                @include('partials._toast')
                @endif
            </section>

            <section class="content">
                <div class="container-fluid">                    
                    <h5>Patient Information</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <span id="name">{{ $patient->name }}</span>
                                    <span id="gender" class="text-danger" style="font-weight: bold;">{{ $patient->gender == 1 ? 'M' : 'F' }}</span>
                                    <span id="age">{{ $patient->age }} years</span>
                                </div>
                                <div class="col-sm-3">
                                    <h6 id="drug_allergy"><b>Drug Allergy :</b> {{ $patient->drug_allergy ? $patient->drug_allergy : 'None'  }} </h6>
                                </div>
                                @if(isset($patient->disease[0]))
                                    <div class="col-sm-3">
                                        <h6 id="p_di"><b>Disease :</b> <span id="p_disease">{{ $patient->disease[0]->disease }}</span></h6>
                                    </div>
                                @endif
                                <div class="col-sm-3">
                                    <h6 id="p_di"><b>Father Name :</b> <span id="p_disease">{{ $patient->father_name }}</span></h6>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    
                    @if($visits->isEmpty())
                        <h6 class="text-center text-red pt-5">No visits data found for this patient.</h6>
                    @else
                        <h5>Visits Record</h5>
                        <div class="card">
                            <div class="card-body">
                                @foreach($visits as $visit)
                                <div class="row mb-3 p-2 rounded" style="background-color: #FDFAF0;">
                                    <div class="col-sm-4">
                                        <p>
                                            <span class="text-bold">Visit Date: </span><br>
                                            {{ $visit->updated_at->format('d-M-Y g:iA') }}
                                        </p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            <span class="text-bold">Assigned Med: </span><br>
                                            {!! $visit->assigned_medicines !!}
                                        </p>
                                    </div>
                                    @if($visit->followup_date)
                                    <div class="col-sm-4">
                                        <p>
                                            <span class="text-bold">Followup: </span><br>
                                            {{ \Carbon\Carbon::parse($visit->followup_date)->diffForHumans() }}
                                        </p>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>                        
                    @endif
                    
                </div>
            </section>
        </div>
    </div>
</body>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

<script>
   
</script>
@endsection