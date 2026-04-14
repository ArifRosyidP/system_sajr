<head>
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
</head>

<body>
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">

        <div class="p-3">
            <h4>MyApp</h4>
        </div>

        <!-- MENU (SCROLLABLE) -->
        <div class="sidebar-menu px-2">

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="/products"
                        class="nav-link {{ request()->is('product*') ? 'active' : '' }} text-white">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="/purchaseOrder"
                        class="nav-link {{ request()->is('purchase-order*') ? 'active' : '' }} text-white">Purchase
                        Order</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item">
                    <a class="nav-link text-white d-flex justify-content-between align-items-center {{ request()->is('setup/*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#menuProduk" role="button" aria-expanded="false"
                        aria-controls="menuProduk">

                        <span>Setup</span>
                        <span class="arrow">▼</span>
                    </a>
                    <div class="collapse {{ request()->is('setup/*') ? 'show' : '' }}" id="menuProduk">
                        <ul class="nav flex-column ps-3">
                            <li><a
                                    class="nav-link {{ request()->is('setup/client*') ? 'active' : '' }} text-white">Client</a>
                            </li>
                            <li><a
                                    class="nav-link {{ request()->is('setup/pekerjaan*') ? 'active' : '' }} text-white">Pekerjaan</a>
                            </li>
                            <li><a
                                    class="nav-link {{ request()->is('setup/subkontraktor*') ? 'active' : '' }} text-white">Subkontraktor</a>
                            </li>
                            <li><a class="nav-link {{ request()->is('setup/pic*') ? 'active' : '' }} text-white">PIC</a>
                            </li>
                            <li><a
                                    class="nav-link {{ request()->is('setup/supplier*') ? 'active' : '' }} text-white">Supplier</a>
                            </li>
                            <li><a
                                    class="nav-link {{ request()->is('setup/karoseri*') ? 'active' : '' }} text-white">Karoseri</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Simulasi menu banyak -->
                <li class="nav-item"><a class="nav-link text-white">Menu 1</a></li>
                <li class="nav-item"><a class="nav-link text-white">Menu 2</a></li>
                <li class="nav-item"><a class="nav-link text-white">Menu 3</a></li>
                <li class="nav-item"><a class="nav-link text-white">Menu 4</a></li>
                <li class="nav-item"><a class="nav-link text-white">Menu 5</a></li>
                <li class="nav-item"><a class="nav-link text-white">Menu 6</a></li>
                <li class="nav-item"><a class="nav-link text-white">Menu 7</a></li>
                <li class="nav-item"><a class="nav-link text-white">Menu 8</a></li>

            </ul>
        </div>

        <!-- LOGOUT FIXED -->
        <div class="sidebar-footer">
            <button class="btn btn-danger w-100">Logout</button>
        </div>

    </div>
</body>
