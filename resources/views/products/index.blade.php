<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css">
</head>

<body>
    @include('sidebar')

    <!-- CONTENT -->
    <div id="content" class="content">

        <!-- NAVBAR -->
        <nav class="navbar navbar-light bg-light shadow-sm px-3 d-flex justify-content-between">

            <!-- Left -->
            <div>
                <span onclick="toggleSidebar()" style="cursor:pointer;">☰</span>
            </div>

            <!-- Right (User Profile) -->
            <div class="d-flex align-items-center">
                <img src="https://i.pravatar.cc/40" class="rounded-circle me-2" alt="user">
                <span class="fw-semibold">Arief</span>
            </div>

        </nav>

        <!-- MAIN -->
        <div class="container mt-5">
            <div class="card">
                <div class="card header px-3 py-2">Table Product</div>
                <div class="card body px-3 py-2">
                    <button class="btn btn-primary mb-1" style="width: 100px" onclick="showModal()">Create</button>
                    <table class="table table-bordered table-striped" id="tableProduct">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('products.modal')

    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\ProductRequest', '#productForm') !!}

    <script>
        // new DataTable('#tableProduct', {
        //     responsive: true
        // });

        $(document).ready(function() {
            productsTable();
        });

        function productsTable() {
            $('#tableProduct').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: 'products/dataTable',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        }

        function showModal() {
            $('#productModal').modal('show');
            $('#modal-title').text('Create New Product');
            $('.btnSubmit').text('Create');
        }

        $('#productForm').submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'products',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#productModal').modal('hide');
                    $('#tableProduct').DataTable().ajax.reload();
                    $('#productForm')[0].reset();
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                    alert(jqXHR.responseText);
                }
            })
        });
    </script>


    {{-- SIDEBAR SCRIPT --}}
    <script>
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {

                // 🚫 JANGAN ganggu dropdown Bootstrap
                if (this.hasAttribute('data-bs-toggle')) return;

                // reset active
                document.querySelectorAll('.sidebar .nav-link').forEach(el => {
                    el.classList.remove('active');
                });

                // set active
                this.classList.add('active');

                // parent submenu ikut active
                let parentCollapse = this.closest('.collapse');
                if (parentCollapse) {
                    let parentLink = document.querySelector('[href="#' + parentCollapse.id + '"]');
                    if (parentLink) parentLink.classList.add('active');
                }
            });
        });

        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('full');
            }
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }

        /* AUTO RESPONSIVE */
        window.addEventListener('load', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                content.classList.add('full');
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                content.classList.add('full');
            } else {
                sidebar.classList.remove('collapsed');
                content.classList.remove('full');
            }
        });
    </script>
</body>


</html>
