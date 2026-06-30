<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/jquery-3.7.1.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <title>View All Products</title>
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
        <a class="btn btn-success" href="{{ url('admin/product/createProduct') }}">Add Products</a>
    </div>

    <div class="table-container">
        <table id="productTable" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Qty</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sr_no = 1;
                @endphp
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $sr_no++ }}</th>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_price }}</td>
                        <td>{{ $product->product_qty }}</td>
                        <td>{{ $product->product_description }}</td>
                        <td style="display: flex; flex-direction: row; gap: 5px">
                            <form action="{{ route('admin.product.deleteProduct', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="confirm('Are you sure, you want to delete this entry?')">DELETE</button>
                            </form>
                            <a href="{{ url('admin/product/editProduct/' . $product->id) }}">
                                <button class="btn btn-success">EDIT</button>
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