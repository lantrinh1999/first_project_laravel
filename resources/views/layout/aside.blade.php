<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Admin</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::segment(2) == 'home' ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}"><i class="fa fa-link"></i><span>Dashboard</span></a></li>
                
            {{-- sản phẩm --}}
            <li class="treeview {{ Request::segment(2) == 'product' ? 'active' : '' }}">
                <a href="">
                <i class="fa fa-link"></i> <span>Sản phẩm</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class={{ (Request::segment(2) == 'product' && Request::segment(3) == 'list') ? 'active' : '' }}>
                        <a href="{{ route('admin.product.list') }}">Danh sách sản phẩm</a>
                    </li>
                    <li class={{ (Request::segment(2) == 'product' && Request::segment(3) == 'add') ? 'active' : '' }}>
                        <a href="{{ route('admin.product.add') }}">Thêm mới sản phẩm</a>
                    </li>

                </ul>
            </li>

            {{-- Danh mục --}}
            <li class="treeview {{ Request::segment(2) == 'category' ? 'active' : '' }}">
                <a href="">
                <i class="fa fa-link"></i> <span>Danh mục</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class={{ (Request::segment(2) == 'category' && Request::segment(3) == 'list') ? 'active' : '' }}>
                        <a href="{{ route('admin.category.list') }}">Danh sách Danh mục</a>
                    </li>
                    <li class={{ (Request::segment(2) == 'category' && Request::segment(3) == 'list') ? 'active' : '' }}>
                        <a href="{{ route('admin.category.list') }}">Thêm mới Danh mục</a>
                    </li>

                </ul>
            </li>
            {{-- Comment --}}
            <li class="treeview {{ Request::segment(2) == 'comment' ? 'active' : '' }}">
                <a href="">
                <i class="fa fa-link"></i> <span>Comments</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class={{ (Request::segment(2) == 'comment' && Request::segment(3) == 'list') ? 'active' : '' }}>
                        <a href="{{ route('admin.comment.list') }}">Danh sách Comments</a>
                    </li>
                </ul>
            </li>


        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
