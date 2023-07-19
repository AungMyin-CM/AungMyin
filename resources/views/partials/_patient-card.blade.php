<div class="row">
    @foreach ($data as $row)
    <div class="col-md-4">
        <div class="card d-flex flex-row align-items-center justify-content-center" style="height: 250px; overflow: hidden;">
            <img src="https://placehold.co/150x250" style="flex: 2 1 0%; width: 150px; height: 250px" alt="" />

            <div class="card-body" style="flex: 3 1 0%">
                <section class="mb-1">
                    <h5 class="mb-3">{{ $row->name }}</h5>
                    <!-- <span class="text-muted small float-right">{{$row->updated_at->diffForHumans()}}</span> -->
                </section>

                <section class="mb-1">
                    <span class="text-muted">Father name: </span>{{ $row->father_name }}
                </section>
                <section class="mb-1">
                    <span class="text-muted">Age: </span>{{ $row->age }}
                </section>
                <section class="mb-3">
                    <span class="text-muted">Gender: </span>{{ $row->gender == 1 ? 'male' : 'female' }}
                </section>
                <section class="d-flex flex-row" style="gap: 10px;">
                    <div>
                        @if(Helper::checkPermission('p_update', $permissions))
                        <a href="{{ route('patient.edit' ,  Crypt::encrypt($row->id)) }}" color: {{config('app.color')}}" class="btn btn-default">
                            <i class="fas fa-edit fa-lg"></i></a>
                        @endif
                    </div>
                    <div>
                        @if(Helper::checkPermission('p_treatment', $permissions) && $role_type == 1 || $role_type == 5)
                        <a href="{{ route('patient.treatment', Crypt::encrypt($row->id)) }}" style="color: {{config('app.color')}}" class="btn btn-default"><i class="fas fa-stethoscope fa-lg"></i></a>
                        @endif
                    </div>
                    <div>
                        @if(Helper::checkPermission('p_delete', $permissions))
                        <form action="{{ route('patient.destroy', $row->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-default" type="submit"><i class="fas fa-trash" style="color:#E95A4A;"></i></button>
                        </form>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="float-right">
    {!! $data->links('pagination.bootstrap-4') !!}
</div>