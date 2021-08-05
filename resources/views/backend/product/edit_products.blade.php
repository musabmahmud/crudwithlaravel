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
                                <h3 class="card-title">Edit Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ url('update-product') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Product Name</label>
                                        <input type="hidden" name="product_id" value="{{ $products->id }}">
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
                                            id="pslug" name="slug" value="{{ $products->slug }}"
                                            placeholder="Auto Fill Slug">
                                        @error('slug')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control" id="category_id">
                                            <option value="{{ $products->category_id }}" selected>Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option @if ($products->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                                    {{ $category->category_name }}
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
                                            @foreach ($scat as $scats)
                                                <option @if ($products->subcategory_id == $scats->id) selected @endif value="{{ $scats->id }}">
                                                    {{ $scats->subcategory_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                            <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="thumbnail">Thumbnail</label>
                                                <input type="file"
                                                    class="form-control @error('thumbnail') is invalid @enderror"
                                                    id="thumbnail" name="thumbnail"
                                                    onchange="document.getElementById('image_id').src= window.URL.createObjectURL(this.files[0])">
                                                @error('thumbnail')
                                                    <div class=''>{{ $message }}<span class="text-danger">*</span></div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <img src="{{ asset('productImage/' . $products->thumbnail) }}"
                                                    alt="{{ $products->title }}" height="200" id="image_id">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        @foreach ($attribute as $key => $item)
                                            <div id="dynamic-field-{{ $key + 1 }}" class="form-group dynamic-field">
                                                <input type="hidden" name="attribute_id[]" value="{{ $item->id }}">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="color">Color</label>
                                                        <select type="text" id="color" class="form-control"
                                                            name="color_id[]">
                                                            <option value="" selected>Choose Color</option>
                                                            @foreach ($colors as $color)
                                                                <option @if ($color->id == $item->color->id) selected @endif
                                                                    value="{{ $color->id }}">{{ $color->color_name }}
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
                                                                <option @if ($size->id == $item->size->id) selected @endif
                                                                    value="{{ $size->id }}">{{ $size->size_name }}
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
                                                        <input type="number" min="0" value="{{ $item->quantity }}"
                                                            id="quantity" class="form-control" name="quantity[]" />
                                                        @error('quantity')
                                                            <div class=''>{{ $message }}<span class="text-danger">*</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="price">Regular Price</label>
                                                        <input type="number" min="0" id="price"
                                                            value="{{ $item->regular_price }}" name="regular_price[]"
                                                            class="form-control" />
                                                        @error('regular_price')
                                                            <div class=''>{{ $message }}<span class="text-danger">*</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="saleprice">Sale Price</label>
                                                        <input type="number" min="0" value="{{ $item->sale_price }}"
                                                            id="saleprice" class="form-control" name="sale_price[]" />
                                                        @error('sale_price')
                                                            <div class=''>{{ $message }}<span class="text-danger">*</span>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
            var maxFields = 50;

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
