<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <title>Edit Product {{ $product->product_name }}</title>
</head>
<body>

    @include('admin.navbar');
    
    @if($errors->any())
        <h4 class="errorMsg">{{$errors->first()}}</h4>
    @endif

    @if (\Session::has('success'))
        <h4 class="successMsg">{!! \Session::get('success') !!}</h4>
    @endif

    <div class="form-container">
        <form action="{{ url('admin/product/updateProduct') }}" method="POST" class="customerForm">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="productID" value="{{ $product->id }}">
                <label for="productName" class="form-label">Product Name</label>
                <input class="form-control" value="{{ $product->product_name }}" name="product_name" type="text" id="productName">
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Product Price</label>
                <input class="form-control" value="{{ $product->product_price }}" name="product_price" type="number" id="productPrice">
            </div>
            <div class="mb-3">
                <label for="productQty" class="form-label">Product Qty</label>
                <input class="form-control" value="{{ $product->product_qty }}" name="product_qty" type="number" id="productQty">
            </div>
            <div>
                <label for="productDesc" class="form-label">Product Description</label>
                
                <textarea class="form-control" name="product_desc" id="productDesc" cols="50" rows="2">{{ $product->product_description }}</textarea>
            </div>
            <div class="btn-container">
                <button class="btn btn-success" id="formSubmit">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>