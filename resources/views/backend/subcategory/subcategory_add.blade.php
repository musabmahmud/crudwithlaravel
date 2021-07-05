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
                <h3 class="card-title">Add Sub Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('post-subcategory')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">

                    <label for="subcategory_name">Sub Category Name</label>

                    <input type="text" class="form-control @error('subcategory_name') is invalid @enderror" id="subcategory_name" name="subcategory_name" value="{{old('subcategory_name')}}" placeholder="Enter Your Sub Category Name">

                    @error('subcategory_name')
                        <div class=''>{{$message}}<span class="text-danger">*</span></div>
                    @enderror
                  </div>       
                  <div class="form-group">
                    <label for="subslug">Slug</label>
                    <input type="text" class="form-control @error('slug') is invalid @enderror" id="subslug" name="slug" value="{{old('slug')}}" placeholder="Enter Your Slug">
                    @error('slug')
                        <div class=''>{{$message}}<span class="text-danger">*</span></div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="" selected>Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class=''>{{$message}}<span class="text-danger">*</span></div>
                @enderror
                  </div>
                <!-- /.card-body -->
              {{--                   
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Your Slug">
                </div>
              <!-- /.card-body --> --}}
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
  
  $('#subcategory_name').keyup(function(){
    $('#subslug').val($(this).val().toLowerCase().split(',').join('').replace(/\s+/g, '-'));
  });
  
  
  $(".DeleteCat").on('click', function() {
    var cat_id = $(this).attr("data-id");
  $('.cat_id').val(cat_id);
  });
</script>
@endsection