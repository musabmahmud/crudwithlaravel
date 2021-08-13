@extends('backend.master')
@section('content')
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>View Coupons</h1>
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
                <form action="{{ url('') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th style="width: 10px">No</th>
                      <th>Coupon Name</th>
                      <th>Amount</th>
                      <th>Validity</th>
                      <th>Limit</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($coupons as $key => $coupon)
                          <tr>
                              <td><input type="checkbox" class="checkbox" name="delete[]" value="{{$coupon->id}}"></td>
                              <td>{{$coupons->firstItem() + $key}}</td>
                              <td>{{ $coupon->coupon_name}}</td>
                              <td>{{ $coupon->coupon_amount}}</td>
                              <td>{{ $coupon->coupon_validity}}</td>
                              <td>{{ $coupon->coupon_limit}}</td>
                              <td>{{ $coupon->created_at->format('d-M-Y h:i:s a')}} ({{$coupon->created_at->diffForHumans()}})</td>
                              <td><a href="" class="btn btn-primary">Edit</a>
                                <a href="" class="btn btn-danger">Trashed</a></td>
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
              {{ $coupons->links() }}
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