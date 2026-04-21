<head>

</head>

<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="../index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('assets/img/logo PT Sarana Abadi Jaya Raya.png') }}" alt="SAJR Logo"
                class="brand-image opacity-75 bg-white" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">PT. SAJR</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item ">
                        <a href="{{ route('produk') }}"
                            class="nav-link {{ request()->routeIs('produk') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-palette"></i>
                            <p>Products</p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">Purchase Order</li>

                <li class="nav-item ">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-text-fill"></i>
                        <p>Purchase Order</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('setup.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>
                            Setup
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ps-3">
                        <li class="nav-item">
                            <a href="{{ route('setup.klien') }}"
                                class="nav-link {{ request()->routeIs('setup.klien') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>Klien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setup.karoseri') }}"
                                class="nav-link {{ request()->routeIs('setup.karoseri') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-truck"></i>
                                <p>Karoseri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setup.pekerjaan') }}"
                                class="nav-link {{ request()->routeIs('setup.pekerjaan') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-clipboard-check"></i>
                                <p>Pekerjaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setup.pic') }}"
                                class="nav-link {{ request()->routeIs('setup.pic') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-check"></i>
                                <p>PIC</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setup.subkontraktor') }}"
                                class="nav-link {{ request()->routeIs('setup.subkontraktor') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-diagram-3"></i>
                                <p>Subkontraktor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setup.supplier') }}"
                                class="nav-link {{ request()->routeIs('setup.supplier') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-box-seam"></i>
                                <p>Supplier</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="../generate/theme.html" class="nav-link">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Theme Generate</p>
                    </a>
                </li>


                <li class="nav-header">About</li>

                <li class="nav-item">
                    <a href="../docs/license.html" class="nav-link">
                        <i class="nav-icon bi bi-patch-check-fill"></i>
                        <p>Laravel 13</p>
                    </a>
                </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
