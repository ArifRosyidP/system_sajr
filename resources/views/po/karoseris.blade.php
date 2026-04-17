@extends('main')

@section('setup-karoseri')
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
                                    onclick="showModalKaroseri()">Add</button>
                                <table class="table table-bordered table-striped" id="tableKaroseri">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Karoseri</th>
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


@push('KaroseriJs')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! \Proengsoft\JsValidation\Facades\JsValidatorFacade::formRequest(
        'App\Http\Requests\KaroseriRequest',
        '#karoseriForm',
    ) !!}
    {{-- {!! JsValidator::formRequest('App\Http\Requests\ProductRequest', '#productForm') !!} --}}

    <script>
        // new DataTable('#tableProduct', {
        //     responsive: true
        // });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let save_method;
        $(document).ready(function() {
            karoseriTable();
        });

        function karoseriTable() {
            $('#tableKaroseri').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [0, 2],
                    className: 'no-sort',
                }],
                processing: true,
                serverSide: true,
                responsive: true,
                align: 'center',
                ajax: '/setup/karoseri/dataTable',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nomor_karoseri',
                        name: 'nomor_karoseri'
                    },
                    {

                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        }

        function showModalKaroseri() {
            $('#karoseriModal').modal('show');
            $('.modal-title').text('Tambah Data Karoseri');
            $('.btnSubmit').text('Tambah Data');

            save_method = 'add';
        }

        //tabel product
        $('#karoseriForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this)

            let url, method;
            url = '/karoseri';
            method = 'POST';

            if (save_method == 'update') {
                url = '/karoseri/' + $('#id').val();
                formData.append('_method', 'PUT');
                // method = 'PUT';
            }

            //add and edit data
            $.ajax({
                type: method,
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#karoseriModal').modal('hide');
                    $('#tableKaroseri').DataTable().ajax.reload();
                    Swal.fire({
                        title: response.title,
                        text: response.text,
                        icon: response.icon,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(jqXHR) {
                    if (jqXHR.status === 422) {
                        let errors = jqXHR.responseJSON.errors;
                        let message = '';

                        for (let field in errors) {
                            message += errors[field][0] + '<br>';
                        }
                        Swal.fire({
                            title: 'Validation Error',
                            html: message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            title: 'Server Error',
                            text: 'Terjadi kesalahan pada server',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
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
                        type: 'DELETE',
                        url: '/karoseri/' + id,
                        dataType: 'json',
                        success: function(response) {
                            // $('#klienModal').modal('hide');
                            $('#tableKaroseri').DataTable().ajax.reload();
                            // $('#klienForm')[0].reset();
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.icon,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(jqXHR) {
                            if (jqXHR.status === 422) {
                                let errors = jqXHR.responseJSON.errors;
                                let message = '';

                                for (let field in errors) {
                                    message += errors[field][0] + '<br>';
                                }
                                Swal.fire({
                                    title: 'Validation Error',
                                    html: message,
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    title: 'Server Error',
                                    text: 'Terjadi kesalahan pada server',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
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
                type: 'GET',
                url: '/karoseri/' + id,
                success: function(response) {
                    // console.log(response);
                    let result = response.data;
                    $('#karoseriModal #nomor_karoseri').val(result.nomor_karoseri);
                    $('#karoseriModal #id').val(result.id);

                    $('#karoseriModal').modal('show');
                    $('.modal-title').text('Update Data Karoseri');
                    $('.btnSubmit').text('update');

                },
                error: function(jqXHR) {
                    if (jqXHR.status === 422) {
                        let errors = jqXHR.responseJSON.errors;
                        let message = '';

                        for (let field in errors) {
                            message += errors[field][0] + '<br>';
                        }
                        Swal.fire({
                            title: 'Validation Error',
                            html: message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            title: 'Server Error',
                            text: 'Terjadi kesalahan pada server',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            })



        }

        //menghapus isi modal
        $('#karoseriModal').on('hidden.bs.modal', function() {
            let form = $('#karoseriForm');
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
