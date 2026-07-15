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
        <form action="{{ url('admin/product/updateProduct') }}" style="width: 80%" method="POST" class="customerForm">
            @csrf
            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <input type="hidden" name="productID" value="{{ $product->id }}">
                    <label for="productName" class="form-label">Product Name</label>
                    <input class="form-control" value="{{ $product->product_name }}" name="product_name" type="text" id="productName">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label class="form-label" for="selectProductType">Select Product Type</label>
                    <select class="form-control" id="selectProductType" name="productType">
                            <option {{ $product->item_type == '' ? 'selected' : '' }}>Select Product Type</option>
                            <option {{ $product->item_type == 'gold' ? 'selected' : '' }} value="gold">Gold</option>
                            <option {{ $product->item_type == 'silver' ? 'selected' : '' }} value="silver">Silver</option>
                    </select>
                </div>
            </div>

            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <label for="productNumber" class="form-label">Product Number</label>
                    <input class="form-control" value="{{ $product->product_number }}" name="product_number" type="number" id="productNumber">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label for="nshCode" class="form-label">NSH Code</label>
                    <input class="form-control" value="{{ $product->nsh_code }}" name="nshCode" type="number" id="nshCode">
                </div>
            </div>

            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <label for="productWeight" class="form-label">Product Weight</label>
                    <input class="form-control" value="{{ $product->product_weight }}" step="0.01" name="productWeight" type="number" id="productWeight">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label for="productPrice" class="form-label">Product Price</label>
                    <input class="form-control" value="{{ $product->product_price }}" name="product_price" type="number" id="productPrice">
                </div>
            </div>
            
            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <label for="makingCharges" class="form-label">Making Charges</label>
                    <input class="form-control" value="{{ $product->making_charge }}" name="makingCharges" type="number" id="makingCharges">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label for="holeMarkCharges" class="form-label">Hole Mark Charges</label>
                    <input class="form-control" value="{{ $product->hole_mark_charge }}" name="holeMarkCharges" type="number" id="holeMarkCharges">
                </div>
            </div>
            
            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <label for="productQty" class="form-label">Product Qty</label>
                    <input class="form-control" value="{{ $product->product_qty }}" name="product_qty" type="number" id="productQty">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label for="productPurity" class="form-label">Purity</label>
                    <input class="form-control" value="{{ $product->purity }}" step="0.01" name="purity" type="number" id="productPurity">
                </div>
            </div>
            
            <div class="btn-container">
                <button class="btn btn-success" id="formSubmit">UPDATE</button>
                <a class="btn btn-danger" href="{{ route('admin.product.products') }}">CANCEL</a>
            </div>
        </form>
    </div>
</body>
</html>