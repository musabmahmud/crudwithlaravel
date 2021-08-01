@extends('backend.master')
@section('')
menu-is-opening menu-open
@endsection
@section('');
    active
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>View Color</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table </h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('all-sizes') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th style="width: 10px">No</th>
                      <th>Sub Category</th>
                      <th>Slug</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($sizes as $key => $size)
                          <tr>
                              <td><input type="checkbox" class="checkbox" name="delete[]" value="{{$size->id}}"></td>
                              <td>{{$sizes->firstItem() + $key}}</td>
                              <td>{{ $size->size_name}}</td>
                              <td>{{ $size->slug}}</td>
                              <td>{{ $size->created_at->format('d-M-Y h:i:s a')}} ({{$size->created_at->diffForHumans()}})</td>
                              <td><a href="{{ url('').'/'.$size->id }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('').'/'.$size->id }}" class="btn btn-danger">Trashed</a></td>
                          </tr>
                      @endforeach
                    <tr>
                    </tr>
                  </tbody>
                </table>
                <div class="text-center">
                  <input type="submit" name="alldelete" value="DELETE Items" class="btn btn-danger btn-lg">
                </div>
              </div>
              <!-- /.card-body -->
              {{ $sizes->links() }}
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('footer_js')
<script>
$("#checkAll").click(function(){
  $('input:checkbox').not(this).prop('checked', this.checked);
});   
</script> 
@endsection