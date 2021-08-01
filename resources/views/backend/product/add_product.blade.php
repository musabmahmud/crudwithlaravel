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
                                            id="title" name="title" value="{{ old('title') }}"
                                            placeholder="Enter Your Product Title">
                                        @error('title')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pslug">Slug</label>
                                        <input type="text" class="form-control @error('slug') is invalid @enderror"
                                            id="pslug" name="slug" value="{{ old('slug') }}" placeholder="Auto Fill Slug">
                                        @error('slug')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control" id="category_id">
                                            <option value="" selected>Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
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
                                            id="thumbnail" value="{{ old('thumbnail') }}" name="thumbnail">
                                        @error('thumbnail')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div id="dynamic-field-1" class="form-group dynamic-field">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="color">Color</label>
                                                    <select type="text" id="color" class="form-control" name="color_id[]">
                                                        <option value="" selected>Choose Color</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}">{{ $color->color_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('color_id')
                                                        <div class=''>{{ $message }}<span class="text-danger">*</span>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="size">Size</label>
                                                    <select type="text" id="size" class="form-control" name="size_id[]">
                                                        <option value="" selected>Choose Size</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->id }}">{{ $size->size_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('size_id')
                                                        <div class=''>{{ $message }}<span class="text-danger">*</span>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" min="0" id="quantity" class="form-control"
                                                        name="quantity[]" />
                                                    @error('quantity')
                                                        <div class=''>{{ $message }}<span class="text-danger">*</span>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="price">Regular Price</label>
                                                    <input type="number" min="0" id="price" name="regular_price[]" class="form-control"/>
                                                    @error('regular_price')
                                                        <div class=''>{{ $message }}<span class="text-danger">*</span>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="saleprice">Sale Price</label>
                                                    <input type="number" min="0" id="saleprice" class="form-control" name="sale_price[]" />
                                                    @error('sale_price')
                                                        <div class=''>{{ $message }}<span class="text-danger">*</span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" id="add-button"
                                                    class="btn btn-secondary float-left text-uppercase shadow-sm"><i
                                                        class="fas fa-plus fa-fw"></i> Add</button>
                                                <button type="button" id="remove-button"
                                                    class="btn btn-secondary float-left text-uppercase ml-1"
                                                    disabled="disabled"><i class="fas fa-minus fa-fw"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="summary">Summary</label>
                                        <textarea type="text" class="form-control @error('summary') is invalid @enderror"
                                            id="summary" name="summary"
                                            placeholder="Enter Your Summary">{{ old('summary') }}</textarea>
                                        @error('summary')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text"
                                            class="form-control @error('description') is invalid @enderror" id="description"
                                            name="description"
                                            placeholder="Enter Your Description">{{ old('slug') }}</textarea>
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
                            $('#subcategory_id').append(
                                '<option selected>Choose Sub Category</option>');
                            $.each(res, function(key, value) {
                                $('#subcategory_id').append('<option value="' + value.id +
                                    '">' + value.subcategory_name + '</option>')
                            });
                        } else {
                            $("#subcategory_id").empty();
                        }
                    }
                })
            }
        });

        $(document).ready(function() {
            var buttonAdd = $("#add-button");
            var buttonRemove = $("#remove-button");
            var className = ".dynamic-field";
            var count = 0;
            var field = "";
            var maxFields = 5;

            function totalFields() {
                return $(className).length;
            }

            function addNewField() {
                count = totalFields() + 1;
                field = $("#dynamic-field-1").clone();
                field.attr("id", "dynamic-field-" + count);
                field.children("label").text("Field " + count);
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
