<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/jquery-3.7.1.min.js') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <title>View All Billings</title>
</head>
<body>

    @include('admin.navbar');

    @if($errors->any())
        <h4 class="errorMsg">{{$errors->first()}}</h4>
    @endif

    @if (\Session::has('success'))
        <h4 class="successMsg">{!! \Session::get('success') !!}</h4>
    @endif

    <div style="display: flex; flex-direction: row; justify-content:end; padding-right: 10px;">
        <a class="btn btn-success" href="{{ url('admin/billing/createBill') }}">Create Invoice</a>
    </div>

    <div class="table-container">
        <table id="customerTable" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Products</th>
                    <th scope="col">Product Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">GST</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sr_no = 1;
                @endphp
                @foreach($billings as $billing)  
                    @php
                        $productQtyArray = DB::table('billing')->where('id', $billing->id)->first();
                        $productQty = unserialize($productQtyArray->product_qty);

                        $allProducts = unserialize($billing->purchase_product);

                        $productNames = [];
                        $productPrices = [];

                        foreach ($allProducts as $productId) {
                            $product = DB::table('products')
                                ->where('id', $productId)
                                ->first();

                            if ($product) {
                                $productNames[] = $product->product_name;
                                $productPrices[] = $product->product_price;
                            }
                        }

                    @endphp
                    <tr>
                        <th scope="row">{{ $sr_no++ }}</th>
                        <td>{{ $billing->customer_name }}</td>
                        <td>{{ $billing->contact_no }}</td>
                        <td>{{ $billing->address }}</td>
                        <td>{{ implode(', ', $productNames) }}</td></td>
                        <td>{{ implode(', ', $productQty) }}</td>
                        <td>{{ implode(', ', $productPrices) }}</td>
                        <td>{{ $billing->discount }}</td>
                        <td>{{ $billing->gst }}</td>
                        <td>{{ $billing->total_price }}</td>
                        <td style="display: flex; flex-direction: row; gap: 5px">
                            <form action="{{ route('admin.billing.deleteInvoice', $billing->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="confirm('Are you sure, you want to delete this entry?')">DELETE</button>
                            </form>
                            <a href="{{ url('admin/customer/editCustomer/' . $billing->id) }}">
                                <button class="btn btn-success">EDIT</button>
                            </a>
                            <a target="_blank" href="{{ url('admin/billing/printInvoice/' . $billing->id) }}">
                                <button class="btn btn-primary">VIEW INVOICE</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready( function () {
            $('#customerTable').DataTable();
        } );
    </script>
</body>
</html>