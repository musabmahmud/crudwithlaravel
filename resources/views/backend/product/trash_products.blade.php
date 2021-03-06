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
            <h1>View Products</h1>
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
                <form action="{{ url('all-products-delete') }}" method="POST">
                @csrf
                <table class="table table-bordered table-responsive-sm">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th style="width: 10px">No</th>
                      <th>title</th>
                      <th>Slug</th>
                      <th>Category</th>
                      <th>Subcategory</th>
                      <th>Thumbnail</th>
                      <th>Summary</th>
                      <th>Description</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($products as $key => $pdt)
                          <tr>
                              <td><input type="checkbox" class="checkbox" name="delete[]" value="{{$pdt->id}}"></td>
                              <td>{{$products->firstItem() + $key}}</td>
                              <td>{{ $pdt->title}}</td>
                              <td>{{ $pdt->slug}}</td>
                              <td>{{ $pdt->category->category_name}}</td>
                              <td>{{ $pdt->subcategory->subcategory_name}}</td>
                              <td><img src="productImage/{{ $pdt->thumbnail}}" alt="{{ $pdt->title}}" height="100"></td>
                              <td>{{ $pdt->summary}}</td>
                              <td>{{ $pdt->description}}</td>
                              <td>{{ $pdt->created_at->format('d-M-Y h:i:s a')}} ({{$pdt->created_at->diffForHumans()}})</td>
                              <td><a href="{{ url('recover-product').'/'.$pdt->id }}" class="btn btn-warning">Recover</a>
                                <a href="" class="btn btn-danger">Delete Forever</a></td>
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
              {{ $products->links() }}
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