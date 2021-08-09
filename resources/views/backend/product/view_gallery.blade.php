@extends('backend.master')
@section('nav_open')
@endsection
@section('cat_active');
@endsection
@section('content')
    <div class="content-wrapper" style="min-height: 1299.69px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>View Gallery</h1>
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
                                <h3 class="card-title float-right"><a href="{{route('updategalleryImages',$productId)}}" class="btn btn-primary">Add More Images</a></h3>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Gallery Image</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($galleries as $key => $gallery)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td><img src="{{ asset('gallery/'.$gallery->image_name)}}" alt="{{$gallery->image_name}}" height="200" width="200">
                                                </td>
                                                <td><a href="{{ url('delete-galleryimage').'/'.$gallery->id }}" class="btn btn-danger">Trashed</a></td>
                                            </tr>
                                            @empty
                                            <div class="alert alert-default-primary text-center fa-2x">Add New Images</div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            {{ $galleries->links() }}
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
