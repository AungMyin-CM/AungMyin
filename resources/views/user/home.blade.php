@extends('layouts.app')
@section('content')
<style>

   .card.mb-3:hover{
        opacity: 0.3;
    }

</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="mydiv">
        <div class="content-wrapper">
            <section class="content">
                    <div class="container-fluid">
                        <div class="container py-5 row">
                            @if($data['clinic'] == 0)

                                <div class="col-md-4">
                                    <a href="{{route('package.selection')}}">

                                    <div class="card mb-3" style="cursor:pointer;" id="clinic-card">
                                        <div class="row no-gutters">
                                            <div class="col-md-4" style="background:url({{asset('images/web-photos/clinic.jpg')}})">
                                            
                                            </div>
                                            <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title m-1 text-black"><span class="fas fa-clinic-medical"></span>  New Clinic</h5>
                                                <p class="card-text"><small class="text-muted">Start using free.</small></p>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            @else
                                @foreach($data['user_clinic'] as $key => $data)
                                <?php
                                    $string_data = new DateTime($data[0]->created_at);
                                    $date = $string_data->format('d-m-Y');

                                ?>

                                    <div class="col-md-4">
                                        <div class="card-deck">
                                            <a href="{{route('user.clinic',Crypt::encrypt($data[0]->id))}}">

                                                <div class="card mb-3" style="cursor:pointer;hover">
                                                    <div class="row no-gutters">
                                                    <div class="col-md-4">
                                                        <img src="{{asset('images/web-photos/clinic.jpg')}}" class="card-img image-styling" style="width:100%;height:100%" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            
                                                        <h5 class="card-title m-1 ">{{$data[0]->name}}</h5>
                                                        <p class="card-text"><small class="text-muted">Register on <b>{{$date}}</b></small></p>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </a>
                                            
                                        </div>
                                    </div> 
                                @endforeach

                                    <div class="col-md-4">
                                        <a href="{{route('package.selection')}}">

                                        <div class="card mb-3" style="cursor:pointer;" id="clinic-card">
                                            <div class="row no-gutters">
                                                <div class="col-md-4" style="background:url({{asset('images/web-photos/clinic.jpg')}})">
                                                
                                                </div>
                                                <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title m-1 text-black"><span class="fas fa-clinic-medical"></span>  New Clinic</h5>
                                                    <p class="card-text"><small class="text-muted">Start using free.</small></p>

                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                
                            @endif
                        </div>
                    </div>
                    

            </section>
        </div>
    </div>
</body>
@endsection