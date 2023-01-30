@extends('layouts.app')
@section('content')
<style>

   .card.mb-3:hover{
        opacity: 0.3;
    }

</style>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color: {{config('app.bg_color')}}">
    <div class="wrapper" id="mydiv" >
        <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
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
                                                <h5 class="card-title m-1 text-black"  style="color: {{config('app.color')}}"><span class="fas fa-clinic-medical"></span>  New Clinic</h5>
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
                                    $string_data = new DateTime($data->created_at);
                                    $create_at = $string_data->format('d-m-Y');

                                    $to = \Carbon\Carbon::createFromFormat('Y-m-d', $data->expire[0]->expire_at);
                                    $from = \Carbon\Carbon::createFromFormat('Y-m-d', $data->created_at);

                                    $diff_in_days = $to->diffInDays($from);

                                    print_r($diff_in_days); // Output: 1

                                    

                                ?>

                                    <div class="col-md-4">
                                        <div class=" ">
                                            <a href="{{route('user.clinic',Crypt::encrypt($data->id))}}">
                                                <div class="card mb-3" style="cursor:pointer;hover">
                                                    <div class="row no-gutters">
                                                    <div class="col-md-4">
                                                        <img src="{{asset('images/web-photos/clinic.jpg')}}" class="card-img image-styling" style="width:100%;height:100%" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                        <h5 class="card-title m-1"  style="color: {{config('app.color')}}">{{$data->clinic[0]['name']}}</h5>
                                                            
                                                            <p class="card-text"><small class="text-muted">Register on <b>{{$create_at}}</b></small></p>
                                                            <p class="card-text"><small class="text-muted">Expire on <b>{{$data->expire[0]->expire_at}}</b></small></p>

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
                                                    <h5 class="card-title m-1 text-black" style="color: {{config('app.color')}}"><span class="fas fa-clinic-medical"></span>  New Clinic</h5>
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