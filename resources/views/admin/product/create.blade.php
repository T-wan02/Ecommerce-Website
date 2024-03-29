@extends('admin.layout.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
    <div>
        <a href="{{ route('product.index') }}" class="btn btn-dark">All Product</a>
    </div>

    <hr>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-8">
                <div class="card p-4">
                    <small class="text-muted">Product info</small>
                    <div class="form-group">
                        <label for="">Enter Product</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Choose Product Images</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <textarea name="description" class="form-control" id="description"></textarea>
                    </div>
                </div>
                <br>
                <div class="card p-4">
                    <small class="text-muted">Product pricing</small>
                    <div class="form-group">
                        <label for="">Total Quantity</label>
                        <input type="number" name="total_quantity" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Buy Price</label>
                        <input type="number" name="buy_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Sale_price</label>
                        <input type="number" name="sale_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Discount Price</label>
                        <input type="number" name="discount_price" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-4 container">
                <div class="form-group">
                    <label for="">Choose Supplier</label>
                    <select name="supplier_slug" id="supplier">
                        @foreach ($supplier as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Choose Category</label>
                    <select name="category_slug" id="category">
                        @foreach ($category as $s)
                            <option value="{{ $s->slug }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Choose Brand</label>
                    <select name="brand_slug" id="brand">
                        @foreach ($brand as $s)
                            <option value="{{ $s->slug }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Choose Color</label>
                    <select name="color_slug[]" id="color" multiple>
                        @foreach ($color as $s)
                            <option value="{{ $s->slug }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="Create" class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            $('#supplier').select2();
            $('#category').select2();
            $('#brand').select2();
            $('#color').select2();

            $('#description').summernote({
                callbacks: {
                    onImageUpload: function(files) {
                        const frmdata = new FormData();
                        frmdata.append('image', files[0]);
                        frmdata.append('_token', '@php echo csrf_token(); @endphp')
                        $.ajax({
                            method: 'POST',
                            url: '/admin/product-upload',
                            contentType: false,
                            processData: false,
                            data: frmdata,
                            success: function(data) {
                                // console.log(data);
                                $('#description').summernote('insertImage', data, function(
                                    $image) {
                                    $image.css('width', $image.width() / 3);
                                    $image.attr('data-filename', 'retriever');
                                    $image.attr('href', data);
                                });
                            }
                        })
                    }
                }
            });
            // $('#description').summernote();
        })
    </script>
@endsection
