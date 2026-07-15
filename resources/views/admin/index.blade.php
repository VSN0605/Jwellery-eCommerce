<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
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

    <div class="card-cotainer">
         
        {{-- for customer detail card --}}
        <div class="card">
            <div class="top-section">
                <div class="border"></div>
                <div class="icons">
                <div class="logo">
                    
                </div>
                <div class="social-media">

                </div>
                </div>
            </div>
            <div class="bottom-section">
                <span class="title">UNIVERSE OF UI</span>
                <div class="row row1">
                <div class="item">
                    <span class="big-text">2626</span>
                    <span class="regular-text">UI elements</span>
                </div>
                <div class="item">
                    <span class="big-text">100%</span>
                    <span class="regular-text">Free for use</span>
                </div>
                <div class="item">
                    <span class="big-text">38,631</span>
                    <span class="regular-text">Contributers</span>
                </div>
                </div>
            </div>
        </div>

        {{-- for product detail card --}}
        <div class="card">
            <div class="top-section">
                <div class="border"></div>
                <div class="icons">
                <div class="logo">
                    
                </div>
                <div class="social-media">

                </div>
                </div>
            </div>
            <div class="bottom-section">
                <span class="title">Product Details</span>
                <div class="row row1">
                <div class="item">
                    <span class="big-text">{{ $productQty }}</span>
                    <span class="regular-text">Total Products In</span>
                </div>
                <div class="item">
                    <span class="big-text">100%</span>
                    <span class="regular-text">Total Product Sales</span>
                </div>
                <div class="item">
                    <span class="big-text">38,631</span>
                    <span class="regular-text">Contributers</span>
                </div>
                </div>
            </div>
        </div>

        {{-- for invoice detail card --}}
        <div class="card">
            <div class="top-section">
                <div class="border"></div>
                <div class="icons">
                <div class="logo">
                    
                </div>
                <div class="social-media">

                </div>
                </div>
            </div>
            <div class="bottom-section">
                <span class="title">Invoice Details</span>
                <div class="row row1">
                <div class="item">
                    <span class="big-text">{{ $billings }}</span>
                    <span class="regular-text">Total Invoices</span>
                </div>
                <div class="item">
                    <span class="big-text">{{ $totalSale }}</span>
                    <span class="regular-text">Total Sale</span>
                </div>
                <div class="item">
                    <span class="big-text">38,631</span>
                    <span class="regular-text">Total Profit</span>
                </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>