@extends('backend.master')

@section('content')
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>View Category</h1>
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
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Category</th>
                      <th>Slug</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($cats as $key => $cat)
                          <tr>
                              <td>{{$cats->firstItem() + $key}}</td>
                              <td>{{ $cat->category_name}}</td>
                              <td>{{ $cat->slug}}</td>
                              <td>{{ $cat->created_at->format('d-M-Y h:i:s a')}} ({{$cat->created_at->diffForHumans()}})</td>
                              <td><a href="{{ url('edit-category').'/'.$cat->id }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('delete-category').'/'.$cat->id }}" class="btn btn-danger">Trashed</a></td>
                          </tr>
                      @endforeach
                    <tr>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              {{ $cats->links() }}
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection