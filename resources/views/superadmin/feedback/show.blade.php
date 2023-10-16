@extends('layouts.super_layout')

@section('content')
<style>
    .rating {
        /* set the color of the stars */
        color: #FFD700;
        font-size: 1.2rem;
        font-weight: 900;
    }

    .filled-star {
        /* set the color of the filled stars */
        color: #FFD700;
    }

    .empty-star {
        /* set the color of the empty stars */
        color: #DDD;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex gap-3 align-items-center">
                            @if($feedback->user->avatar)
                            <img src="{{asset('images/avatars/'.$feedback->user->avatar)}}" alt="Avatar" class="img-thumbnail rounded-circle" width="40" height="40">
                            @else
                            <img src="{{ asset('images/web-photos/no-image.jpg') }}" alt="Avatar" class="img-thumbnail rounded-circle" width="40" height="40">
                            @endif
                            <h5>{{ $feedback->user->name }}</h5>
                        </div>
                        <div class="mb-2">
                            <div class="rating d-inline me-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <=$feedback->rating)
                                    <span class="filled-star">&#9733;</span>
                                    @else
                                    <span class="empty-star">&#9733;</span>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-muted">{{ substr($feedback->created_at, 0, 10) }}</span>
                        </div>

                        <div>
                            <p>{{ $feedback->comment }}</p>
                        </div>

                        <div>
                            <a href="{{route('superadmin.replyFeedback', $feedback->id)}}" class="btn text-white" style="background-color: {{config('app.color')}};">Reply</a>
                            <a href="{{route('superadmin.feedback')}}" class="ms-2 text-decoration-none" style="color: {{config('app.color')}};">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection