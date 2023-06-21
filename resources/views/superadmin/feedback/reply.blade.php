@extends('layouts.super_layout')

@section('content')

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('superadmin.sendFeedbackEmail') }}" method="post">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-body p-4">
                            <input type="hidden" name="name" value="{{ $feedback->user->name }}">

                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ $feedback->email }}">
                                @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" placeholder="Enter your comment" name="comment" rows="6" cols="50"></textarea>
                                @error('comment')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-center p-3">
                            <button type="submit" class="btn text-white" style="background-color: {{config('app.color')}}">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

@endsection