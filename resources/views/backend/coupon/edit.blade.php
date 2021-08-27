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
                                <h3 class="card-title">Edit Coupon</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('coupon.update',$coupon->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="coupon_name">Coupon Name</label>
                                        <input type="text" class="form-control @error('coupon_name') is invalid @enderror"
                                            id="coupon_name" name="coupon_name" value="{{ $coupon->coupon_name}}"
                                            placeholder="Enter Your Coupon Name">
                                        @error('coupon_name')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="slug" value="{{ $coupon->slug}}" id="slug">
                                    <div class="form-group">
                                        <label for="coupon_amount">Coupon Amount</label>
                                        <input type="number" max="100" min="0" class="form-control @error('coupon_amount') is invalid @enderror"
                                            id="coupon_amount" name="coupon_amount" value="{{$coupon->coupon_amount}}"
                                            placeholder="Enter Percentage">
                                        @error('coupon_amount')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="coupon_validity">Coupon Validity</label>
                                        <input type="date" class="form-control @error('coupon_validity') is invalid @enderror"
                                            id="coupon_validity" name="coupon_validity" value="{{$coupon->coupon_validity}}"
                                            placeholder="Enter Your Color Validity">
                                        @error('coupon_validity')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="coupon_limit">Coupon Limit</label>
                                        <input type="number" max="100" min="0" class="form-control @error('coupon_limit') is invalid @enderror"
                                            id="coupon_limit" name="coupon_limit" value="{{$coupon->coupon_limit}}"
                                            placeholder="Enter Your Coupon Usable Person number">
                                        @error('coupon_limit')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
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
    $('#coupon_name').keyup(function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s+/g, '-'));
    });
</script>
@endsection
