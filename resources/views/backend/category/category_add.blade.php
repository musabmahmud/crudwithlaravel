@extends('backend.master')

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>General Form</h1>
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
                <h3 class="card-title">Add Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('post-category')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control @error('category_name') is invalid @enderror" id="category_name" name="category_name" value="{{old('category_name')}}" placeholder="Enter Your Name">
                    @error('category_name')
                        <div class=''>{{$message}}<span class="text-danger">*</span></div>
                    @enderror
                  </div>       
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is invalid @enderror" id="slug" name="slug" value="{{old('slug')}}" placeholder="Enter Your Slug">
                    @error('slug')
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
  
  $('#category_name').keyup(function(){
    $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s+/g, '-'));
  });
  
  
  $(".DeleteCat").on('click', function() {
    var cat_id = $(this).attr("data-id");
  $('.cat_id').val(cat_id);
  });
</script>
@endsection