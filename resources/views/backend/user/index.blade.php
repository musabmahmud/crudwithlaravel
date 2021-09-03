@extends('backend.master')
@section('content')
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>User Role View</h1>
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
                      <th style="width: 10px">No</th>
                      <th>User Name</th>
                      <th>User Role</th>
                      <th>Permissions</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $key => $user)
                          <tr>
                              <td>{{$users->firstItem() + $key}}</td>
                              <td>{{ $user->name}}</td>
                              @forelse ($user->roles as $role)
                                <td>{{ $role->name}}</td>
                                <td>
                                    @forelse ($role->permissions as $permission)
                                        <ul>
                                            <li>{{ $permission->name}}</li>
                                        </ul>
                                        @empty
                                        <span>No Permission assign</span>
                                    @endforelse
                                </td>
                                @empty
                                <td>----</td>
                                <td>----</td>
                              @endforelse
                              <td><a href="{{ route('user.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                                <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              {{ $users->links() }}
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
</script> 
@endsection