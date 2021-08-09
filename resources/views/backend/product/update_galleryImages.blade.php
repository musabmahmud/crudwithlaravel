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
                                <h3 class="card-title">Update Gallery</h3>
                            </div>
                            <!-- /.card-header -->
                            {{-- {{ url('update-galleryimage') }} --}}
                            <!-- form start -->
                            <form action="{{url('post-updategallery')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" value="{{$productId}}" name="product_id">
                                <div class="card-body">
                                    <div class="form-group">
                                        @forelse ($galleries as $key => $item)
                                            <div id="dynamic-field-{{ ++$key }}" class="form-group dynamic-field">
                                                <input type="hidden" value="{{$item->id}}" name="image_id[]">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="image_name">Gallery <sub>(can choose multiple image)</sub></label>
                                                            <input type="file" class="form-control @error('image_name') is invalid @enderror"
                                                                id="image_name" value="{{ old('image_name') }}" name="image_name[]" onchange="document.getElementById('menu + i').src= window.URL.createObjectURL(this.files[0])">
                                                            @error('image_name')
                                                                <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <img class="menuHeader" src="{{ asset('gallery/' . $item->image_name) }}"
                                                                alt="{{ $item->image_name}}" height="200" id="'menu'+ i">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div id="dynamic-field-1" class="form-group dynamic-field">
                                                <input type="hidden" name="attribute_id[]">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="image_name">Gallery</label>
                                                            <input type="file" class="form-control @error('image_name') is invalid @enderror"
                                                                id="image_name" value="{{ old('image_name') }}" name="image_name[]" onchange="document.getElementById('value_id').src= window.URL.createObjectURL(this.files[0])">
                                                            @error('image_name')
                                                                <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <img class="menuHeader" height="200" id="value_id">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" id="add-button"
                                                    class="btn btn-secondary float-left text-uppercase shadow-sm"><i
                                                        class="fas fa-plus fa-fw"></i> Add</button>
                                                <button type="button" id="remove-button"
                                                    class="btn btn-secondary float-left text-uppercase ml-1"><i
                                                        class="fas fa-minus fa-fw"></i> Remove</button>
                                            </div>
                                        </div>
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

        $(document).ready(function() {
            var buttonAdd = $("#add-button");
            var buttonRemove = $("#remove-button");
            var className = ".dynamic-field";
            var className = ".dynamic-field";
            var count = 0;
            var field = "";
            var maxFields = 50;

            function totalFields() {
                return $(className).length;
            }

            function addNewField() {
                count = totalFields() + 1;
                field = $("#dynamic-field-1").clone();
                field.attr("id", "dynamic-field-" + count);
                field.find("input").val("");
                $(className + ":last").after($(field));
            }

            function removeLastField() {
                if (totalFields() > 1) {
                    $(className + ":last").remove();
                }
            }

            function enableButtonRemove() {
                if (totalFields() === 2) {
                    buttonRemove.removeAttr("disabled");
                    buttonRemove.addClass("shadow-sm");
                }
            }

            function disableButtonRemove() {
                if (totalFields() === 1) {
                    buttonRemove.attr("disabled", "disabled");
                    buttonRemove.removeClass("shadow-sm");
                }
            }

            function disableButtonAdd() {
                if (totalFields() === maxFields) {
                    buttonAdd.attr("disabled", "disabled");
                    buttonAdd.removeClass("shadow-sm");
                }
            }

            function enableButtonAdd() {
                if (totalFields() === (maxFields - 1)) {
                    buttonAdd.removeAttr("disabled");
                    buttonAdd.addClass("shadow-sm");
                }
            }

            buttonAdd.click(function() {
                addNewField();
                enableButtonRemove();
                disableButtonAdd();
            });

            buttonRemove.click(function() {
                removeLastField();
                disableButtonRemove();
                enableButtonAdd();
            });
        });

    </script>
@endsection
