<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">
        <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">APANA SHOP</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Create Cate
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sub-categories.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                 
                <li class="nav-item">
                    <a href="{{ route('brands.index') }}" class="nav-link">
                        <svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p>Brands</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.productRating') }}" class="nav-link">
                        <i class="nav-icon fas fa-star"></i>
                        <p>Ratings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('stock.create') }}" class="nav-link">
                        <i class="nav-icon fa-sol fa-warehouse"></i>
                        <p>Stocks</p>
                    </a>
                </li>
                 
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Invoice
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('invoice.create') }}"class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>BillCustoner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('return.product') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Return Customer</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('shipping.create') }}" class="nav-link">

                        <i class="fas fa-truck nav-icon"></i>
                        <p>Shipping</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('order.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="discount.html" class="nav-link">
                        <i class="nav-icon  fa fa-percent" aria-hidden="true"></i>
                        <p>Discount</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Our People
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.agents.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Agents</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Manage Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sections.index') }}"class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sections</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Topsections.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Section</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pages.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </nav>

    </div>

</aside>
