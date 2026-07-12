<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/printInvoice.css') }}">

</head>
<body>

<div class="invoice">

    <div class="row">

        <div class="col-md-6">
            <h2 class="company-name">Your Company Name</h2>
            <p>
                Nagpur, Maharashtra<br>
                Mobile : 9876543210<br>
                Email : info@company.com
            </p>
        </div>

        <div class="col-md-6 text-end">
            <h1 class="invoice-title">INVOICE</h1>

            <p>
                <strong>Invoice No :</strong> INV-YJ-00001 <br>
                <strong>Date :</strong> {{ date('d-m-Y') }}
            </p>
        </div>

    </div>

    <hr>

    <div class="row mb-4">

        <div class="col-md-6">

            <h5>Bill To</h5>

            <strong>{{ $invoiceData->customer_name }}</strong><br>

            {{ $invoiceData->contact_no }}<br>

            {{ $invoiceData->address }}

        </div>

    </div>


    <table class="table table-bordered">

        <thead>

        <tr>

            <th width="5%">#</th>

            <th>Product</th>

            <th width="15%">Qty</th>

            <th width="20%">Price</th>

            <th width="20%">Amount</th>

        </tr>

        </thead>

        <tbody>

        <tr>

            <td>1</td>

            <td>Laptop</td>

            <td>2</td>

            <td>₹50000</td>

            <td>₹100000</td>

        </tr>

        <tr>

            <td>2</td>

            <td>Mouse</td>

            <td>3</td>

            <td>₹500</td>

            <td>₹1500</td>

        </tr>

        </tbody>

    </table>


    <div class="total-box">

        <table class="table table-bordered">

            <tr>
                <th>Subtotal</th>
                <td>₹ {{ $invoiceData->subtotal }}</td>
            </tr>

            <tr>
                @php
                    $prices = unserialize($invoiceData->product_price);
                    $qtys = unserialize($invoiceData->product_qty);

                    $subtotal = 0;

                    foreach ($prices as $productId => $price) {
                        $subtotal += $price * ($qtys[$productId] ?? 0);
                    }

                    $discountAmount = ($subtotal * $invoiceData->discount) / 100;
                @endphp
                <th>Discount ({{ $invoiceData->discount }}%)</th>
                <td>- ₹ {{ $discountAmount }}</td>
            </tr>

            <tr>
                @php
                    $subtotal = $invoiceData->subtotal;

                    $amountAfterDiscount = $subtotal - $discountAmount;

                    $gstAmount = ($amountAfterDiscount * $invoiceData->gst) / 100;
                @endphp
                <th>GST ({{ $invoiceData->gst }}%)</th>
                <td>₹{{ $gstAmount }}</td>
            </tr>

            <tr class="table-primary">
                <th>Grand Total</th>
                <th>₹{{ $invoiceData->total_price }}</th>
            </tr>

        </table>

    </div>

    <div class="clearfix"></div>

    <br><br><br>

    <div class="row">

        <div class="col-md-6">
            <strong>Terms & Conditions</strong>

            <p>
                Goods once sold will not be taken back.
                Thank you for your purchase.
            </p>
        </div>

        <div class="col-md-6 text-end">

            <br><br><br>

            ___________________________

            <br>

            Authorized Signature

        </div>

    </div>

    <div class="text-center mt-5 no-print">

        <button onclick="window.print()" class="btn btn-primary">
            Print Invoice
        </button>

    </div>

</div>

</body>
</html>