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
                      @forelse ($categories as $key => $cat)
                          <tr>
                              <td>{{$categories->firstItem() + $key}}</td>
                              <td>{{ $cat->category_name}}</td>
                              <td>{{ $cat->slug}}</td>
                              <td>{{ $cat->created_at->format('d-M-Y h:i:s a')}} ({{$cat->created_at->diffForHumans()}})</td>
                              <td><a href="{{ url('restore-category').'/'.$cat->id }}" class="btn btn-success">Restore</a>
                                <a  data-toggle="modal" data-target="#DeleteModel" data-id="{{$cat->id}}" class="btn btn-danger DeleteCat">Permanent Delete</a></td>
                          </tr>
                          @empty
                          <tr><td colspan="5" class="text-center">No Data Available</td></tr>
                      @endforelse
                    <tr>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <div class="modal fade" id="DeleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content pd-20">
                        <div class="modal-header">
                            <h2 class="modal-title text-center text-uppercase" id="exampleModalCenterTitle">Delete Data!!</h2>
                            <a type="button" href="#" class="close" data-dismiss="modal"  aria-label="Close">
                                <span class="d-block fa-2x" aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <form action="{{url('post-category')}}" method="POST">
                            <div class="modal-body pd-20">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputPass">Give Password</label>
                                            <input type="password" class="form-control" id="exampleInputPass" name="category_name" placeholder="Enter Your Password">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer pd-t-20 text-white">
                                <a type="button" class="btn btn-secondary" href="#" data-dismiss="modal">Close</a>
                                <a type="submit" class="btn btn-primary cat_id" id="cat_id" href="">Check to Delete</a>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
              <!-- /.card-body -->
              {{ $categories->links() }}
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection