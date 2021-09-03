@extends('backend.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>General</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('user.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    {{-- <div class="form-group">
                                        <label>User Management</label>
                                        <select class="form-control select2" style="width: 100%;" name="user">
                                          <option selected="selected">Select User</option>
                                          @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} ({{$user->email}})</option>
                                          @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" class="form-control @error('name') is invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}"
                                            placeholder="Enter Your User Name">
                                        @error('name')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">User Email</label>
                                        <input type="email" class="form-control @error('email') is invalid @enderror" id="email" name="email" value="{{ old('email') }}"
                                            placeholder="Enter Your User Email">
                                        @error('email')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Give Role</label>
                                        <select class="form-control" style="width: 100%;" name="role_name">
                                          <option selected="selected">Select Role</option>
                                          @foreach ($roles as $role)
                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footer_js')
    <script>
    </script>
@endsection
