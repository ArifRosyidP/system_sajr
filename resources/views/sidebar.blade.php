<head>
    <style>
        body {
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            background: #212529;
            color: white;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            margin-left: -250px;
        }

        /* Scrollable menu */
        .sidebar-menu {
            flex-grow: 1;
            overflow-y: auto;
        }

        /* Logout fixed bottom */
        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .content {
            margin-left: 250px;
            transition: all 0.3s ease;
        }

        .content.full {
            margin-left: 0;
        }

        .submenu {
            padding-left: 20px;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1030;
        }

        .overlay.active {
            display: block;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
                z-index: 1040;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .content {
                margin-left: 0;
            }
        }

        /* HOVER EFFECT */
        .sidebar .nav-link {
            transition: all 0.2s ease;
            border-radius: 6px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 12px;
        }

        /* ACTIVE MENU */
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff !important;
            font-weight: 500;
        }

        /* SUBMENU ACTIVE (biar parent ikut nyala) */
        .sidebar .collapse .nav-link.active {
            background-color: rgba(13, 110, 253, 0.8);
        }

        /* ICON ANIMATION */
        .arrow {
            transition: transform 0.3s ease;
        }

        /* saat terbuka */
        .nav-link[aria-expanded="true"] .arrow {
            transform: rotate(180deg);
        }
    </style>
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
                    <a class="nav-link text-white">Dashboard</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item">
                    <a class="nav-link text-white d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" href="#menuProduk" role="button" aria-expanded="false"
                        aria-controls="menuProduk">

                        <span>Produk</span>
                        <span class="arrow">▼</span>
                    </a>
                    <div class="collapse submenu" id="menuProduk">
                        <ul class="nav flex-column">
                            <li><a class="nav-link text-white">Semua Produk</a></li>
                            <li><a class="nav-link text-white">Kategori</a></li>
                            <li><a class="nav-link text-white">Tambah Produk</a></li>
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
