<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="{{ route('admin') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="">
            <a href="{{ route('admin.orders') }}"><i class="fa fa-fw fa-archive"></i> Orders</a>
        </li>
        <li>
            <a href="{{ route('admin.products') }}"><i class="fa fa-fw fa-bar-chart-o"></i> View Products</a>
        </li>
        <li>
            <a href="{{ route('admin.addProduct') }}"><i class="fa fa-fw fa-table"></i> Add Product</a>
        </li>
        
        <li>
            <a href="{{ route('admin.categories') }}"><i class="fa fa-fw fa-desktop"></i> Categories</a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}"><i class="fa fa-fw fa-wrench"></i> Users</a>
        </li>
    
    </ul>
</div>
<!-- /.navbar-collapse -->