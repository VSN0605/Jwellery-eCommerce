<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <title>Create Product</title>
</head>
<body>

    @include('admin.navbar');

    @if($errors->any())
        <h4 class="errorMsg">{{$errors->first()}}</h4>
    @endif

    @if (\Session::has('success'))
        <h4 class="successMsg">{!! \Session::get('success') !!}</h4>
    @endif

    <div class="form-container" style="padding: 30px">
        <form action="{{ url('admin/product/saveProduct') }}" style="width: 80%" method="POST" class="customerForm">
            @csrf
            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <label for="productName" class="form-label">Product Name</label>
                    <input class="form-control" name="product_name" type="text" id="productName">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label class="form-label" for="selectProductType">Select Product Type</label>
                    <select class="form-control" id="selectProductType" name="selectProductType">
                            <option value="gold">Gold</option>
                            <option value="silver">Silver</option>
                    </select>
                </div>
            </div>
            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <label for="productNumber" class="form-label">Product Number</label>
                    <input class="form-control" name="product_number" type="number" id="productNumber">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label for="nshCode" class="form-label">NSH Code</label>
                    <input class="form-control" name="nshCode" type="number" id="nshCode">
                </div>
            </div>
            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <label for="productWeight" class="form-label">Product Weight</label>
                    <input class="form-control" name="productWeight" type="number" id="productWeight">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label for="productPrice" class="form-label">Product Price</label>
                    <input class="form-control" name="product_price" type="number" id="productPrice">
                </div>
            </div>
            <div class="inputFieldContainer">
                <div class="mb-3" style="width: 100%">
                    <label for="makingCharges" class="form-label">Making Charges</label>
                    <input class="form-control" name="makingCharges" type="number" id="makingCharges">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label for="holeMarkCharges" class="form-label">Hole Mark Charges</label>
                    <input class="form-control" name="holeMarkCharges" type="number" id="holeMarkCharges">
                </div>
                <div class="mb-3" style="width: 100%">
                    <label for="productQty" class="form-label">Product Qty</label>
                    <input class="form-control" name="product_qty" type="number" id="productQty">
                </div>
            </div>
            {{-- <div class="inputFieldContainer"> --}}
                <div class="mb-3" style="width: 100%">
                    <label for="productDesc" class="form-label">Product Description</label>
                    <textarea class="form-control" name="product_description" id="productDesc" cols="50" rows="2"></textarea>
                </div>
            {{-- </div> --}}
            <div class="btn-container">
                <button class="btn btn-success" id="formSubmit">SUBMIT</button>
            </div>
        </form>
    </div>

</body>
</html>