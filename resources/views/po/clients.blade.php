@extends('main')

@section('setup-klien')
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
                                    onclick="showModalKlien()">Add</button>
                                <table class="table table-bordered table-striped" id="tableKlien">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nomor HP</th>
                                            <th>NPWP</th>
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


@push('KlienJs')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! \Proengsoft\JsValidation\Facades\JsValidatorFacade::formRequest(
        'App\Http\Requests\ClientRequest',
        '#klienForm',
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
            klienTable();
        });

        function klienTable() {
            $('#tableKlien').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5],
                    className: 'no-sort',
                }],
                processing: true,
                serverSide: true,
                responsive: true,
                align: 'center',
                ajax: '/setup/klien/dataTable',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'nomor_hp',
                        name: 'nomor_hp'
                    },
                    {
                        data: 'npwp',
                        name: 'npwp'
                    },
                    {

                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        }

        function showModalKlien() {
            $('#klienModal').modal('show');
            $('.modal-title').text('Tambah Data Klien');
            $('.btnSubmit').text('Tambah Data');

            save_method = 'add';
        }

        //tabel product
        $('#klienForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this)

            let url, method;
            url = '/klien';
            method = 'POST';

            if (save_method == 'update') {
                url = '/klien/' + $('#id').val();
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
                    $('#klienModal').modal('hide');
                    $('#tableKlien').DataTable().ajax.reload();
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
                        url: '/klien/' + id,
                        dataType: 'json',
                        success: function(response) {
                            // $('#klienModal').modal('hide');
                            $('#tableKlien').DataTable().ajax.reload();
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
                url: '/klien/' + id,
                success: function(response) {
                    // console.log(response);
                    let result = response.data;
                    $('#nama').val(result.nama);
                    $('#alamat').val(result.alamat);
                    $('#nomor_hp').val(result.nomor_hp);
                    $('#npwp').val(result.npwp);
                    $('#id').val(result.id);

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

            $('#klienModal').modal('show');
            $('.modal-title').text('Update Data Klien');
            $('.btnSubmit').text('update');

        }

        //menghapus isi modal
        $('#klienModal').on('hidden.bs.modal', function() {
            let form = $('#klienForm');
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let swalData = localStorage.getItem('swal');

            if (swalData) {
                let data = JSON.parse(swalData);

                Swal.fire({
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
                title: "{{ session('alert.title') }}",
                text: "{{ session('alert.text') }}",
                icon: "{{ session('alert.icon') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endpush
