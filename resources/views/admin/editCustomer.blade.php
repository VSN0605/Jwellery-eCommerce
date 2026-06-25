<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <title>Edit Customer {{ $customer->first_name . ' ' . $customer->last_name }}</title>
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
        <form action="{{ url('admin/updateCustomer') }}" method="POST" class="customerForm">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="customerID" value="{{ $customer->id }}">
                <label for="firstName" class="form-label">First Name</label>
                <input class="form-control" value="{{ $customer->first_name }}" name="first_name" type="text" id="firstName">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input class="form-control" value="{{ $customer->last_name }}" name="last_name" type="text" id="lastName">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" value="{{ $customer->email }}" name="custom_email" type="email" id="email">
            </div>
            <div class="mb-3">
                <label for="contact_num" class="form-label">Contact Number</label>
                <input class="form-control" value="{{ $customer->contact_no }}" name="contact_num" id="contact_num" type="number">
            </div>
            <div>
                <label for="customAdd" class="form-label">Address</label>
                
                <textarea class="form-control" name="address" id="customAdd" cols="50" rows="2">{{ $customer->address }}</textarea>
            </div>
            <div class="btn-container">
                <button class="btn btn-success" id="formSubmit">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>