<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/admin/index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/customer/customers') }}">View Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/product/products') }}">View Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/billing/billing') }}">View Bills</a>
                    </li>
                </ul>

                {{-- <div class="actions">
                    <h3>Hello {{ session('name') }}</h3>
                </div> --}}
            </div>
            <form action="{{ url('logout') }}" method="get">
                <button class="btn btn-danger">LOG OUT</button>
            </form>
        </div>
    </nav>