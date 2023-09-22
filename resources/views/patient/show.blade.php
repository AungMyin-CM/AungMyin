@extends("layouts.app")
@section('content')

<style>
    .calendar-card {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 0 auto;
    }

    .calendar-day {
        font-size: 32px;
        font-weight: bold;
    }
</style>

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
                    <div class="card mb-4">
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

                    <h5>Visit Records</h5>
                    <div class="row">
                        @foreach($visits as $visit)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="calendar-card w-75">
                                        <div class="calendar-day">
                                            {{ $visit->updated_at->format('d') }}
                                        </div>
                                        <div class="calendar-month-year">
                                            {{ $visit->updated_at->format('M Y') }}
                                        </div>
                                    </div>

                                    @php
                                    $medRows = explode('<br>', $visit->assigned_medicines);

                                    foreach ($medRows as $medRow) {
                                        $parts = explode('^', $medRow);

                                        foreach ($parts as $index => $part) {
                                            if (!empty($part)) {
                                                if ($index % 3 == 0) {
                                                    $badgeClass = 'badge badge-primary';
                                                } elseif ($index % 3 == 1) {
                                                    $badgeClass = 'badge badge-secondary';
                                                } else {
                                                    $badgeClass = 'badge badge-info';
                                                }

                                                echo '<span class="' . $badgeClass . ' mt-3">' . $part . '</span> ';
                                            }
                                        }
                                        if (!empty(array_filter($parts))) {
                                            echo '<br>';
                                        }
                                    }
                                    @endphp

                                    @if($visit->followup_date)
                                    <p class="mt-3">
                                        <i class="fas fa-calendar-alt"></i>&nbsp;
                                        {{ \Carbon\Carbon::parse($visit->followup_date)->diffForHumans() }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>
            </section>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script></script>
@endsection