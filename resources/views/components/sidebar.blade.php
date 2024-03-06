<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">POS RESTO</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">RESTO</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users') ? 'active' : '' }}"><i class="fas fa-users"></i><span>Users</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link {{ Request::is('product') ? 'active' : '' }}"><i class="fas fa-gift"></i><span>Products</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('categories') ? 'active' : '' }}"><i class="fas fa-list"></i><span>Categories</span></a>
            </li>

    </aside>
</div>
