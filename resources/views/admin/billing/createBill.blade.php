<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <script src="{{ asset('assets/js/jquery-4.0.0.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/createBill.js') }}" --}}
    <title>Dashboard</title>
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
        <form action="{{ url('admin/billing/submitBill') }}" method="POST" class="customerForm">
            @csrf
            <div class="mb-3">
                <label for="customerName" class="form-label">Customer Name</label>
                <input class="form-control" name="customer_name" type="text" id="customerName">
            </div>
            <div class="mb-3">
                <label for="mobileNumber" class="form-label">Mobile Number</label>
                <input class="form-control" name="mobile_number" type="number" id="mobileNumber">
            </div>
            <div class="mb-3">
                <label for="customAdd" class="form-label">Address</label>
                <textarea class="form-control" name="address" id="customAdd" cols="50" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="selectProduct">Select Product</label>
                <select class="form-control" id="selectProduct" name="products[]" multiple>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-qty="{{ $product->product_qty }}" data-name="{{ $product->product_name }}" data-price="{{ $product->product_price }}">
                            {{ $product->product_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div id="selectedProducts"></div>
            <script src="{{ asset('assets/js/createBill.js') }}"></script>
            <div class="mb-3">
                <label for="subTotal" class="form-label">Subtotal</label>
                <input type="number" class="form-control" id="subTotal" name="sub_total" readonly>
            </div>
            <div>
                <label for="discount" class="form-label">Discount</label>
                <input class="form-control" name="discount" type="number" id="discount">
            </div>
            <div>
                <label for="productGst" class="form-label">GST</label>
                <input class="form-control" name="product_gst" min=1 type="number" id="productGst">
            </div>
            <div>
                <label for="totalPrice" class="form-label">Total Price</label>
                <input class="form-control" readonly name="total_price" type="number" id="totalPrice">
            </div>
            <div class="btn-container" style="display: flex; flex-direction: row; justify-content: space-between">
                <button class="btn btn-success" id="formSubmit">SUBMIT</button>
                <input class="btn btn-danger" type="reset" value="CLEAR">
            </div>
        </form>
    </div>

</body>
</html>