<style>
    .small-icon {
    font-size: 8px; /* Perkecil ukuran ikon */
}
</style>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('template/assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item {{ Request::is('index') ? 'active' : '' }}" >
                    <a class="sidebar-link" href="dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if(auth()->check() && auth()->user()->role_id === 1)
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Blog</span>
                </li>
                <li class="sidebar-item {{ request()->routeIs('blog.posts.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('blog.posts.*') ? 'active' : '' }}" href="{{ route('blog.posts.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-box-multiple"></i>
                        </span>
                        <span class="hide-menu">Posts</span>
                    </a>
                </li>


                <li class="sidebar-item {{ Request::is('blog.categories*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('blog.categories.*') ? 'active' : '' }}" href="{{ route('blog.categories.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Categories</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('blog.authors*') ? 'active' : '' }}" >
                    <a class="sidebar-link {{ request()->routeIs('blog.authors.*') ? 'active' : '' }} " href="{{ route('blog.authors.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-circle"></i>
                        </span>
                        <span class="hide-menu">authors</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('blog.tags.index') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('blog.tags.*') ? 'active' : '' }}" href="{{ route('blog.tags.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>  <!-- Icon for Tag -->
                        </span>
                        <span class="hide-menu">Tags</span>
                    </a>
                </li>

                @endif
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
