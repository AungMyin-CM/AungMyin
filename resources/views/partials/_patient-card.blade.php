<div class="row">
    @foreach ($data as $row)
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3" style="gap: 10px;">
                    <img src="{{ asset('images/web-photos/no-image.jpg') }}" alt="Avatar" class="rounded-circle img-thumbnail" width="40" height="40">
                    <h5>{{ $row->name }}</h5>
                </div>

                <ul class="list-unstyled">
                    <li><span class="text-muted">Father name: </span>{{ $row->father_name }}</li>
                    <li><span class="text-muted">Age: </span>{{ $row->age }}</li>
                    <li><span class="text-muted">Gender: </span>{{ $row->gender == 1 ? 'male' : 'female' }}</li>
                </ul>

                <section class="d-flex" style="gap: 10px;">
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
    {{ $data->links('pagination.bootstrap-4') }}
</div>