@extends('backend.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Products</li>
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
                                <h3 class="card-title">Add Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ url('post-products') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Product Name</label>
                                        <input type="text" class="form-control @error('title') is invalid @enderror"
                                            id="title" name="title" value="{{ $products->title }}"
                                            placeholder="Enter Your Product Title">
                                        @error('title')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pslug">Slug</label>
                                        <input type="text" class="form-control @error('slug') is invalid @enderror"
                                            id="pslug" name="slug" value="{{  $products->slug }}" placeholder="Auto Fill Slug">
                                        @error('slug')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control" id="category_id">
                                            <option value="{{ $products->category_id}}" selected>Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option @if ($products->category_id == $cat->id) 
                                                    selected
                                                @endif value="{{ $category->category_id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="subcategory_id">Sub Category</label>
                                        <select name="subcategory_id" class="form-control" id="subcategory_id">
                                        </select>
                                        @error('subcategory_id')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail</label>
                                        <input type="file" class="form-control @error('thumbnail') is invalid @enderror"
                                            id="thumbnail" value="{{ $products->thumbnail }}"name="thumbnail">
                                        @error('thumbnail')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="summary">Summary</label>
                                        <textarea type="text" class="form-control @error('summary') is invalid @enderror"
                                            id="summary" name="summary"
                                            placeholder="Enter Your Summary">{{ $products->summary }}</textarea>
                                        @error('summary')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text"
                                            class="form-control @error('description') is invalid @enderror" id="description"
                                            name="description"
                                            placeholder="Enter Your Description">{{ $products->slug }}</textarea>
                                        @error('description')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->
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
        $('#title').keyup(function() {
            $('#pslug').val($(this).val().toLowerCase().split(',').join('').replace(/\s+/g, '-'));
        });

        $('#category_id').change(function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/get-subcat-list') }}/" + category_id,
                    success: function(res) {
                        if (res) {
                            $("#subcategory_id").empty();
                            $('#subcategory_id').append('<option selected>Choose Sub Category</option>');
                            $.each(res, function(key, value){
                              $('#subcategory_id').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>')
                            });
                        }
                        else{
                            $("#subcategory_id").empty();
                        }
                    }
                })
            }
        });
    </script>
@endsection
