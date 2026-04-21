@extends('main')

@section('purchase-order')
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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                                    onclick="showModalPurchasingOrder()">Add</button>

                                <table class="table table-bordered table-striped" id="tablePurchasingOrder">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal PO</th>
                                            <th>Klien</th>
                                            <th>Pekerjaan</th>
                                            <th>Subkontraktor</th>
                                            <th>Nomor PO</th>
                                            <th>Pajak</th>
                                            <th>Supplier</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Sat</th>
                                            <th>Harga Sat</th>
                                            <th>Jumlah</th>
                                            <th>Transport</th>
                                            <th>Term Of Payment</th>
                                            <th>Tanggal Pengiriman</th>
                                            <th>PIC</th>
                                            <th>Tujuan</th>
                                            <th>Catatan</th>
                                            <th>Invoice</th>
                                            <th>Tanggal Invoice</th>
                                            <th>Nomor Bukti</th>
                                            <th>Status</th>
                                            <th>Total PO</th>
                                            <th>Total Bayar CO</th>
                                            <th>Sisa / Status</th>
                                            <th>Tanggal Bayar</th>
                                            <th>DP1</th>
                                            <th>Pelunasan1</th>
                                            <th>DP2</th>
                                            <th>Pelunasan2</th>
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


@push('PurchaseOrderJs')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! \Proengsoft\JsValidation\Facades\JsValidatorFacade::formRequest(
        'App\Http\Requests\PurchasingorderRequest',
        '#purchasingOrderForm',
    ) !!}
    {{-- {!! JsValidator::formRequest('App\Http\Requests\ProductRequest', '#productForm') !!} --}}

    <script>
        // new DataTable('#tableProduct', {
        //     responsive: true
        // });

        function formatTanggal(tanggal) {
            if (!tanggal) return '';

            let parts = tanggal.split('-');
            return `${parts[2]}-${parts[1]}-${parts[0]}`;
        }

        function loadPekerjaan(clientId, selectedPekerjaan = null) {
            const pekerjaanSelect = $('#purchasingOrderModal #id_pekerjaan');

            pekerjaanSelect.html('<option value="">Loading...</option>');

            if (!clientId) {
                pekerjaanSelect.html('<option value="">Pilih Pekerjaan</option>');
                return;
            }

            $.ajax({
                url: '/get-pekerjaan/' + encodeURIComponent(clientId),
                // url: '/get-pekerjaan/' + clientId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let options = '<option value="" disabled selected>Pilih Pekerjaan</option>';

                    response.forEach(function(item) {
                        let selected = selectedPekerjaan == item.id ? 'selected' : '';
                        options +=
                            `<option value="${item.id}" ${selected}>${item.nama_pekerjaan}</option>`;
                    });

                    pekerjaanSelect.html(options);
                },
                error: function(xhr) {
                    console.log('Backend error:', xhr.responseText);
                    pekerjaanSelect.html('<option value="">Gagal memuat data</option>');
                }
            });
        }

        function calculateTotal() {
            let qty = parseFloat($('#kuantitas').val()) || 0;
            let harga = parseFloat($('#harga_satuan').val()) || 0;
            let transport = parseFloat($('#transportasi').val()) || 0;
            let jumlah = qty * harga;

            $('#jumlah').val(jumlah.toFixed(2));

            let pajak = $('#pajak').val();
            let total_po = jumlah + transport;

            if (pajak === 'PPN') {
                total_po += jumlah * 0.11;
            }

            $('#total_po').val(total_po.toFixed(2));
        }

        $('#kuantitas, #harga_satuan, #pajak, #transportasi').on('input change', function() {
            calculateTotal();
        });

        function calculateSisaStatus() {
            let totalPO = parseFloat($('#total_po').val()) || 0;
            let totalBayar = parseFloat($('#totalbayar_co').val()) || 0;
            let sisaStatus = '';

            if (!$('#totalbayar_co').val()) {
                sisaStatus = '';
            } else {
                let selisih = totalPO - totalBayar;

                if (Math.abs(selisih) <= 1000) {
                    sisaStatus = 'Lunas';
                } else if (selisih > 0) {
                    sisaStatus = selisih.toLocaleString('id-ID');
                } else if (selisih < 0) {
                    sisaStatus = 'Over ' + Math.abs(selisih).toLocaleString('id-ID');
                }
            }

            $('#sisa_status').val(sisaStatus);
        }

        $('#totalbayar_co, #total_po').on('input change', function() {
            calculateSisaStatus();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let save_method;
        $(document).ready(function() {
            poTable();
            $('#purchasingOrderModal #id_klien').on('change', function() {
                let clientId = $(this).val();
                loadPekerjaan(clientId);
            });
        });

        function poTable() {
            $('#tablePurchasingOrder').DataTable({
                columnDefs: [{
                        targets: 0,
                        width: "50px",
                        className: ["no-sort", "text-center"],
                        orderable: false,
                    },
                    {
                        targets: 1,
                        width: "120px",
                        className: "text-center"
                    },
                    {
                        targets: 2,
                        width: "150px",
                        className: "text-center"
                    },
                    {
                        targets: 3,
                        width: "150px",
                        className: "text-center"
                    },
                    {
                        targets: 4,
                        width: "150px",
                        className: "text-center"
                    },
                    {
                        targets: 5,
                        width: "150px",
                        className: "text-center"
                    },
                    {
                        targets: 8,
                        width: "150px",
                        className: "text-center"
                    },
                    {
                        targets: 18,
                        width: "150px",
                        className: "text-center"
                    },
                    {
                        targets: 31,
                        width: "120px",
                        className: ["no-sort", "text-center"],
                        orderable: false,
                    },
                    // {
                    //     orderable: false,
                    //     targets: [0, 31],
                    //     className: ["no-sort"],
                    // }
                ],
                processing: true,
                serverSide: true,
                scrollX: true,
                autoWidth: false,
                responsive: false,
                // responsive: true,
                // align: 'center',
                ajax: '/dataTable',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tanggal_po',
                        name: 'tanggal_po'
                    },
                    {
                        data: 'id_klien',
                        name: 'id_klien'
                    },
                    {
                        data: 'id_pekerjaan',
                        name: 'id_pekerjaan'
                    },
                    {
                        data: 'id_subkontraktor',
                        name: 'id_subkontraktor'
                    },
                    {
                        data: 'nomor_po',
                        name: 'nomor_po'
                    },
                    {
                        data: 'pajak',
                        name: 'pajak'
                    },
                    {
                        data: 'id_supplier',
                        name: 'id_supplier'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'kuantitas',
                        name: 'kuantitas'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'harga_satuan',
                        name: 'harga_satuan'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'transportasi',
                        name: 'transportasi'
                    },
                    {
                        data: 'termofpayment',
                        name: 'termofpayment'
                    },
                    {
                        data: 'tanggal_pengiriman',
                        name: 'tanggal_pengiriman'
                    },
                    {
                        data: 'id_personincharge',
                        name: 'id_personincharge'
                    },
                    {
                        data: 'tujuan',
                        name: 'tujuan'
                    },
                    {
                        data: 'catatan',
                        name: 'catatan'
                    },
                    {
                        data: 'invoice',
                        name: 'invoice'
                    },
                    {
                        data: 'tanggal_invoice',
                        name: 'tanggal_invoice'
                    },
                    {
                        data: 'no_bukti',
                        name: 'no_bukti'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'total_po',
                        name: 'total_po'
                    },
                    {
                        data: 'totalbayar_co',
                        name: 'totalbayar_co'
                    },
                    {
                        data: 'sisa_status',
                        name: 'sisa_status'
                    },
                    {
                        data: 'tanggal_bayar',
                        name: 'tanggal_bayar'
                    },
                    {
                        data: 'dp1',
                        name: 'dp1'
                    },
                    {
                        data: 'pelunasan1',
                        name: 'pelunasan1'
                    },
                    {
                        data: 'dp2',
                        name: 'dp2'
                    },
                    {
                        data: 'pelunasan2',
                        name: 'pelunasan2'
                    },
                    {

                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        }

        function showModalPurchasingOrder() {
            $('#purchasingOrderModal').modal('show');
            $('.modal-title').text('Tambah Data Purchasing Order');
            $('.btnSubmit').text('Tambah Data');

            save_method = 'add';
        }

        //tabel product
        $('#purchasingOrderForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this)

            let url, method;
            url = '/purchasing-order';
            method = 'POST';

            if (save_method == 'update') {
                url = '/purchasing-order/' + $('#purchasingOrderModal #id').val();
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
                    $('#purchasingOrderModal').modal('hide');
                    $('#tablePurchasingOrder').DataTable().ajax.reload();
                    Swal.fire({
                        title: response.title,
                        text: response.text,
                        icon: response.icon,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(jqXHR) {
                    console.log(jqXHR.responseJSON);
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
                        url: '/purchasing-order/' + id,
                        dataType: 'json',
                        success: function(response) {
                            $('#tablePurchasingOrder').DataTable().ajax.reload();
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
                url: '/purchasing-order/' + id,
                success: function(response) {
                    // console.log(response);
                    let result = response.data;
                    $('#purchasingOrderModal #tanggal_po').val(formatTanggal(result.tanggal_po));
                    $('#purchasingOrderModal #id_klien').val(result.id_klien);
                    loadPekerjaan(result.id_klien, result.id_pekerjaan);
                    // $('#purchasingOrderModal #id_pekerjaan').val(result.id_pekerjaan);
                    $('#purchasingOrderModal #id_subkontraktor').val(result.id_subkontraktor);
                    $('#purchasingOrderModal #nomor_po').val(result.nomor_po);
                    $('#purchasingOrderModal #pajak').val(result.pajak);
                    $('#purchasingOrderModal #pajak').val(result.pajak);
                    $('#purchasingOrderModal #id_supplier').val(result.id_supplier);
                    $('#purchasingOrderModal #nama_barang').val(result.nama_barang);
                    $('#purchasingOrderModal #kuantitas').val(result.kuantitas);
                    $('#purchasingOrderModal #satuan').val(result.satuan);
                    $('#purchasingOrderModal #harga_satuan').val(result.harga_satuan);
                    $('#purchasingOrderModal #jumlah').val(result.jumlah);
                    $('#purchasingOrderModal #transportasi').val(result.transportasi);
                    $('#purchasingOrderModal #termofpayment').val(result.termofpayment);
                    $('#purchasingOrderModal #tanggal_pengiriman').val(formatTanggal(result
                        .tanggal_pengiriman));
                    $('#purchasingOrderModal #id_personincharge').val(result.id_personincharge);
                    $('#purchasingOrderModal #tujuan').val(result.tujuan);
                    $('#purchasingOrderModal #catatan').val(result.catatan);
                    $('#purchasingOrderModal #invoice').val(result.invoice);
                    $('#purchasingOrderModal #tanggal_invoice').val(formatTanggal(result.tanggal_invoice));
                    $('#purchasingOrderModal #no_bukti').val(result.no_bukti);
                    $('#purchasingOrderModal #status').val(result.status);
                    $('#purchasingOrderModal #total_po').val(result.total_po);
                    $('#purchasingOrderModal #totalbayar_co').val(result.totalbayar_co);
                    $('#purchasingOrderModal #sisa_status').val(result.sisa_status);
                    $('#purchasingOrderModal #tanggal_bayar').val(formatTanggal(result.tanggal_bayar));
                    $('#purchasingOrderModal #dp1').prop('checked', result.dp1 == 1);
                    $('#purchasingOrderModal #pelunasan1').prop('checked', result.pelunasan1 == 1);
                    $('#purchasingOrderModal #dp2').prop('checked', result.dp2 == 1);
                    $('#purchasingOrderModal #pelunasan2').prop('checked', result.pelunasan2 == 1);
                    $('#purchasingOrderModal #id').val(result.id);

                    $('#purchasingOrderModal').modal('show');
                    $('.modal-title').text('Update Data Purchasing Order');
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
        $('#purchasingOrderModal').on('hidden.bs.modal', function() {
            let form = $('#purchasingOrderForm');
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
