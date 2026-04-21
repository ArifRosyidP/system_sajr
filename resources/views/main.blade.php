{{-- {{ dd($title) }} --}}

<!doctype html>
<html lang="en" id="appTheme" data-bs-theme="light">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo SAJR.png') }}">

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>


    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="System SAJR | Sarana Abadi Jaya Raya" />
    <meta name="author" content="aprasetyio" />
    <meta name="description" content="Website pendataan PT Sarana Abadi Jaya Raya" />
    <meta name="keywords" content="Laravel 13,bootstrap 5" />
    <!--end::Primary Meta Tags-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media = 'all'" />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css">

</head>
<!--end::Head-->
<!--begin::Body-->

@if ($title === 'Login')
    @yield('login')
@elseif ($title === 'Register')
    @yield('register')
@else
    @auth

        <body id="appBody" class="layout-fixed fixed-header fixed-footer sidebar-expand-lg bg-body-tertiary">
            <!--begin::App Wrapper-->
            <div class="app-wrapper">
                <x-header></x-header>
                <x-sidebar></x-sidebar>
                @if ($title === 'Produk')
                    @yield('products')
                @elseif ($title === 'Klien')
                    @yield('setup-klien')
                @elseif ($title === 'Karoseri')
                    @yield('setup-karoseri')
                @elseif ($title === 'Pekerjaan')
                    @yield('setup-pekerjaan')
                @elseif ($title === 'PIC')
                    @yield('setup-pic')
                @elseif ($title === 'Subkontraktor')
                    @yield('setup-subkontraktor')
                @elseif ($title === 'Supplier')
                    @yield('setup-supplier')
                @elseif ($title === 'Purchase Order')
                    @yield('purchase-order')
                @endif
                <x-footer></x-footer>
            </div>
            <!--end::App Wrapper-->

            {{-- @yield('modal') --}}
            {{-- <x-modal ></x-modal> --}}
            <x-modal :clients="$clients ?? collect()" :pekerjaans="$pekerjaans ?? collect()" :subkontraktors="$subkontraktors ?? collect()" :suppliers="$suppliers ?? collect()" :pics="$pics ?? collect()"></x-modal>

        </body>
        <!--end::Body-->
    @endauth
@endif


<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{ asset('assets/js/adminlte.js') }}"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Disable OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
            sidebarWrapper &&
            OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
            !isMobile
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>
<!--end::OverlayScrollbars Configure-->
<!--end::Script-->

<script src="https://code.jquery.com/jquery-4.0.0.min.js"
    integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const html = document.documentElement;
        const themeSwitch = document.getElementById("themeSwitch");

        if (!themeSwitch) return;

        const savedTheme = localStorage.getItem("theme") || "light";

        html.setAttribute("data-bs-theme", savedTheme);
        themeSwitch.checked = savedTheme === "dark";

        themeSwitch.addEventListener("change", function() {
            const theme = this.checked ? "dark" : "light";

            html.setAttribute("data-bs-theme", theme);
            localStorage.setItem("theme", theme);

            refreshPluginsTheme();
        });

        function refreshPluginsTheme() {
            // refresh select2
            $('.searchable-select').each(function() {
                const value = $(this).val();

                $(this).select2('destroy').select2({
                    width: '100%',
                    dropdownParent: $('#purchasingOrderModal')
                });

                $(this).val(value).trigger('change');
            });

            // refresh datatable
            if ($.fn.DataTable.isDataTable('#tablePurchasingOrder')) {
                $('#tablePurchasingOrder').DataTable().columns.adjust().draw(false);
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.searchable-select').select2({
            tags: true,
            placeholder: 'Pilih atau ketik',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#purchasingOrderModal')
        });
    });

    flatpickr(".date-picker", {
        dateFormat: "d-m-Y",
        allowInput: true
    });


    document.addEventListener('DOMContentLoaded', function() {
        let swalData = localStorage.getItem('swal');

        if (swalData) {
            let data = JSON.parse(swalData);

            Swal.fire({
                theme: 'bootstrap-5',
                title: data.title,
                text: data.text,
                icon: data.icon,
                showConfirmButton: false,
                timer: 1500
            });

            // hapus setelah dipakai
            localStorage.removeItem('swal');
        }
    });
</script>
@if (session('alert'))
    <script>
        Swal.fire({
            theme: 'bootstrap-5',
            title: "{{ session('alert.title') }}",
            text: "{{ session('alert.text') }}",
            icon: "{{ session('alert.icon') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@stack('ProdukJs')
@stack('LoginJs')
@stack('RegisterJs')
@stack('KlienJs')
@stack('KaroseriJs')
@stack('PekerjaanJs')
@stack('PicJs')
@stack('SubkontraktorJs')
@stack('SupplierJs')
@stack('PurchaseOrderJs')







</html>
