@extends("layouts.app")
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Dictionary</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dictionary</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        @if (Session::has('success'))
            <div class="col-md-6">
              <div class="alert alert-success" id="alert-message">
                <ul class="list-unstyled">
                      <li>
                        {{ Session::get('success')}}
                      </li> 
                </ul>
              </div>
        </div>
          @endif

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-header">
                    <a href="{{ route('dictionary.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add new</a>
                  </div>
                  <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Meaing</th>
                        <th colspan="2">Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $i = 1; ?>
                      @foreach ($data as $row)
                        
                      <tr>
                        <td>{{ $i++ }} </td>
                        <td>{{ $row->code }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($row->meaning, $limit = 100, $end = '...') }}
                        </td>
                        <td><a href="{{ route('dictionary.edit', $row->id) }}" class="btn btn-primary">Edit</a></td>
                        <td>
                          <form action="{{ route('dictionary.destroy', $row->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
  </div>
</body>
@endsection
