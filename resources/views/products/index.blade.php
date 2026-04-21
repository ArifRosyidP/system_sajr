@extends('main')

@section('products')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">{{ $title }}</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel {{ $title }}</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"
                                        title="Collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    {{-- <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"
                                            title="Remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button> --}}
                                </div>
                            </div>

                            <div class="card-body">

                                <button class="btn btn-primary mb-1" style="width: 100px"
                                    onclick="showModalProduct()">Add</button>
                                <table class="table table-bordered table-striped" id="tableProduct">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th width="15%">Image</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">Footer</div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection


@push('ProdukJs')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! \Proengsoft\JsValidation\Facades\JsValidatorFacade::formRequest(
        'App\Http\Requests\ProductRequest',
        '#productForm',
    ) !!}
    {{-- {!! JsValidator::formRequest('App\Http\Requests\ProductRequest', '#productForm') !!} --}}

    <script>
        // new DataTable('#tableProduct', {
        //     responsive: true
        // });

        let save_method;
        $(document).ready(function() {
            productsTable();
        });

        function productsTable() {
            $('#tableProduct').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5, 6],
                    className: 'no-sort',
                }],
                processing: true,
                serverSide: true,
                responsive: true,
                align: 'center',
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
                        data: 'image',
                        name: 'image'
                    },
                    {

                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        }

        function showModalProduct() {
            $('#productModal').modal('show');
            $('.modal-title').text('Add Product');
            $('.btnSubmit').text('Add');

            save_method = 'add';
        }

        //tabel product
        $('#productForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this)

            let url, method;
            url = 'products';
            method = 'POST';

            if (save_method == 'update') {
                url = 'products/' + $('#id').val();
                formData.append('_method', 'PUT');
                // method = 'PUT';
            }

            //add and edit data
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                type: method,
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#productModal').modal('hide');
                    $('#tableProduct').DataTable().ajax.reload();
                    Swal.fire({
                        title: response.title,
                        text: response.text,
                        icon: response.icon,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                    alert("Error : " + jqXHR.responseText);
                }
            })
        });

        //destroy or delete data
        function deleteModal(e) {
            let id = e.getAttribute('data-id');
            // alert(id);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute(
                                    'content')
                        },
                        type: 'DELETE',
                        url: 'products/' + id,
                        dataType: 'json',
                        success: function(response) {
                            // $('#productModal').modal('hide');
                            $('#tableProduct').DataTable().ajax.reload();
                            // $('#productForm')[0].reset();
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.icon,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText);
                            alert(jqXHR.responseText);
                        }
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });

            });
        }

        //show data for edit
        function editModal(e) {
            let id = e.getAttribute('data-id');
            save_method = 'update';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                type: 'GET',
                url: 'products/' + id,
                success: function(response) {
                    // console.log(response);
                    let result = response.data;
                    $('#name').val(result.name);
                    $('#description').val(result.description);
                    $('#price').val(result.price);
                    $('#id').val(result.id);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                    alert("Error displaying data: " + jqXHR.responseText);
                }
            })

            $('#productModal').modal('show');
            $('.modal-title').text('Update Data Product');
            $('.btnSubmit').text('update');

        }

        //menghapus isi modal
        $('#productModal').on('hidden.bs.modal', function() {
            let form = $('#productForm');
            form[0].reset(); // reset input
            // reset validator
            if (form.data('validator')) {
                form.validate().resetForm();
            }
            // hapus class valid / invalid
            form.find('.is-valid').removeClass('is-valid');
            form.find('.is-invalid').removeClass('is-invalid');
        });
    </script>
@endpush
