@extends('backend.master')
@section('nav_open')
menu-is-opening menu-open
@endsection
@section('cat_active');
    active
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>View Sub Category</h1>
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
                    <div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                  <div class="alert alert-warning alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('error') }}
                  </div>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('all-subcategory-delete') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th style="width: 10px">No</th>
                      <th>Sub Category</th>
                      <th>Slug</th>
                      <th>Category</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($subcats as $key => $scat)
                          <tr>
                              <td><input type="checkbox" class="checkbox" name="delete[]" value="{{$scat->id}}"></td>
                              <td>{{$subcats->firstItem() + $key}}</td>
                              <td>{{ $scat->subcategory_name}}</td>
                              <td>{{ $scat->slug}}</td>
                              <td>{{ $scat->category->category_name}}</td>
                              <td>{{ $scat->created_at->format('d-M-Y h:i:s a')}} ({{$scat->created_at->diffForHumans()}})</td>
                              <td><a href="{{ url('edit-subcategory').'/'.$scat->id }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('deletesubcategory',$scat->id) }}" class="btn btn-danger">Trashed</a></td>
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
              {{ $subcats->links() }}
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