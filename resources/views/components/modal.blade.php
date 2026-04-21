<!-- ModalProduct -->
<div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="productForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_user" id="id_user">
                    <div class="mb-3">
                        <label for="name">Name
                        </label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="description">Description
                        </label>
                        <input type="text" name="description" class="form-control" id="description">
                    </div>
                    <div class="mb-3">
                        <label for="price">Price
                        </label>
                        <input type="text" name="price" class="form-control" id="price">
                    </div>
                    <div class="mb-3">
                        <label for="image">Image (Max 2MB)
                        </label>
                        <input type="file" name="image" class="form-control" id="image" accept="image/*">
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ModalKlien -->
<div class="modal fade" id="klienModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="klienModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="klienModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" id="klienForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_user" id="id_user">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Klien</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            placeholder="Masukkan nama klien">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control" id="nomor_hp"
                            placeholder="Contoh: 081234567890">
                    </div>

                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" name="npwp" class="form-control" id="npwp"
                            placeholder="Masukkan nomor NPWP">
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ModalKaroseri -->
<div class="modal fade" id="karoseriModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="karoseriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="karoseriModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" id="karoseriForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_user" id="id_user">

                    <div class="mb-3">
                        <label for="nomor_karoseri" class="form-label">Nomor Karoseri</label>
                        <input type="text" name="nomor_karoseri" class="form-control" id="nomor_karoseri"
                            placeholder="Masukkan nomor karoseri Contoh: 54.03.B042">
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pekerjaan -->
<div class="modal fade" id="pekerjaanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="pekerjaanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="pekerjaanModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" id="pekerjaanForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_user" id="id_user">

                    <div class="mb-3">
                        <label for="nama_pekerjaan" class="form-label">Nama Pekerjaan</label>
                        <input type="text" name="nama_pekerjaan" class="form-control" id="nama_pekerjaan"
                            placeholder="Masukkan nama pekerjaan">
                    </div>

                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Pekerjaan</label>
                        <input type="text" name="kode" class="form-control" id="kode"
                            placeholder="Masukkan kode pekerjaan">
                    </div>

                    <div class="mb-3">
                        <label for="id_klien" class="form-label">Klien</label>
                        <select name="id_klien" class="form-select" id="id_klien">
                            <option value="" disabled selected>-- Pilih Klien --</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ModalPIC -->
<div class="modal fade" id="picModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="picModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="picModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" id="picForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_user" id="id_user">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama PIC</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            placeholder="Masukkan nama PIC">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control" id="nomor_hp"
                            placeholder="Contoh: 081234567890">
                    </div>

                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" name="npwp" class="form-control" id="npwp"
                            placeholder="Masukkan nomor NPWP">
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ModalSubkontraktor -->
<div class="modal fade" id="subkontraktorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="subkontraktorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="subkontraktorModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" id="subkontraktorForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_user" id="id_user">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Subkontraktor</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            placeholder="Masukkan nama Subkontraktor">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control" id="nomor_hp"
                            placeholder="Contoh: 081234567890">
                    </div>

                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" name="npwp" class="form-control" id="npwp"
                            placeholder="Masukkan nomor NPWP">
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ModalSupplier -->
<div class="modal fade" id="supplierModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="supplierModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" id="supplierForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_user" id="id_user">

                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan"
                            placeholder="Masukkan nama perusahaan">
                    </div>

                    <div class="mb-3">
                        <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" class="form-control" id="nama_pemilik"
                            placeholder="Masukkan nama pemilik">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control" id="nomor_hp"
                            placeholder="Contoh: 081234567890">
                    </div>

                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" name="npwp" class="form-control" id="npwp"
                            placeholder="Masukkan nomor NPWP">
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Purchasing Order -->
<div class="modal fade" id="purchasingOrderModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body custom-form">
                <form id="purchasingOrderForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_user" id="id_user">

                    <!-- Informasi Umum -->
                    <h6 class="border-bottom pb-2 mb-3 text-primary fw-bold">Informasi Umum</h6>
                    <div class="row g-3">

                        {{-- <input type="date" name="tanggal_po" id="tanggal_po" class="form-control"> --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Tanggal PO</label>
                            <input type="text" name="tanggal_po" id="tanggal_po" class="form-control date-picker"
                                readonly placeholder="dd-mm-yyyy">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Nomor PO</label>
                            <input type="text" name="nomor_po" id="nomor_po" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Klien</label>
                            <select name="id_klien" id="id_klien" class="form-select">
                                <option value="" disabled selected>Pilih Klien</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Pekerjaan</label>
                            <select name="id_pekerjaan" id="id_pekerjaan" class="form-select">
                                <option value="" disabled selected>Pilih Klien Terlebih Dahulu</option>
                            </select>
                            {{-- <select name="id_pekerjaan" id="id_pekerjaan" class="form-select">
                                    <option value="">Pilih Pekerjaan</option>
                                    @foreach ($pekerjaans as $pekerjaan)
                                        <option value="{{ $pekerjaan->id }}">{{ $pekerjaan->nama_pekerjaan }}</option>
                                    @endforeach
                                </select> --}}
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Subkontraktor</label>
                            <select name="id_subkontraktor" id="id_subkontraktor" class="form-select">
                                <option value="" disabled selected>Pilih Subkontraktor</option>
                                @foreach ($subkontraktors as $subkontraktor)
                                    <option value="{{ $subkontraktor->id }}">{{ $subkontraktor->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">PIC</label>
                            <select name="id_personincharge" id="id_personincharge" class="form-select">
                                <option value="" disabled selected>Pilih PIC</option>
                                @foreach ($pics as $pic)
                                    <option value="{{ $pic->id }}">{{ $pic->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <!-- Detail Barang -->
                    <h6 class="border-bottom pb-2 mt-4 mb-3 text-primary fw-bold">Detail Barang</h6>
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Supplier</label>
                            <select name="id_supplier" id="id_supplier" class="form-select">
                                <option value="" disabled selected>Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Qty</label>
                            <input type="number" step="0.01" name="kuantitas" id="kuantitas"
                                class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Satuan</label>
                            <input type="text" name="satuan" id="satuan" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Tanggal Pengiriman</label>
                            <input type="text" name="tanggal_pengiriman" id="tanggal_pengiriman"
                                class="form-control date-picker" readonly placeholder="dd-mm-yyyy">
                            {{-- <input type="date" name="tanggal_pengiriman" id="tanggal_pengiriman"
                                class="form-control"> --}}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Tujuan</label>
                            <input type="text" name="tujuan" id="tujuan" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control"></textarea>
                        </div>

                    </div>

                    <!-- Pembayaran -->
                    <h6 class="border-bottom pb-2 mt-4 mb-3 text-primary fw-bold">Pembayaran</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Term Of Payment</label>
                            <select name="termofpayment" id="termofpayment" class="form-select searchable-select">
                                <option value="" disabled selected>Pilih Term Of Payment</option>
                                <option value="CBD">CBD</option>
                                <option value="Net 7">Net 7</option>
                                <option value="Net 14">Net 14</option>
                                <option value="Net 30">Net 30</option>
                            </select>
                            {{-- <input type="text" name="termofpayment" id="termofpayment" class="form-control"> --}}
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Pajak</label>
                            <select name="pajak" id="pajak" class="form-select">
                                <option value="" disabled selected>Pilih Pajak</option>
                                <option value="PPN">PPN</option>
                                <option value="Tidak PPN">Tidak PPN</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Harga Satuan</label>
                            <input type="number" step="0.01" name="harga_satuan" id="harga_satuan"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Jumlah</label>
                            <input type="number" step="0.01" name="jumlah" id="jumlah" class="form-control"
                                readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Transportasi</label>
                            <input type="number" step="0.01" name="transportasi" id="transportasi"
                                class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Total PO</label>
                            <input type="number" step="0.01" name="total_po" id="total_po"
                                class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Invoice</label>
                            <input type="text" name="invoice" id="invoice" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Tanggal Invoice</label>
                            {{-- <input type="date" name="tanggal_invoice" id="tanggal_invoice" class="form-control"> --}}
                            <input type="text" name="tanggal_invoice" id="tanggal_invoice"
                                class="form-control date-picker" readonly placeholder="dd-mm-yyyy">
                        </div>

                    </div>

                    <!-- Data Dari CO -->
                    <h6 class="border-bottom pb-2 mt-4 mb-3 text-primary fw-bold">Data Dari Cash Order</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Total Bayar CO</label>
                            <input type="number" step="0.01" name="totalbayar_co" id="totalbayar_co"
                                class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Sisa / Status</label>
                            <input type="text" name="sisa_status" id="sisa_status" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Tanggal Bayar</label>
                            {{-- <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control"> --}}
                            <input type="text" name="tanggal_bayar" id="tanggal_bayar"
                                class="form-control date-picker" readonly placeholder="dd-mm-yyyy">
                        </div>
                    </div>


                    <!-- Pak Manoj -->
                    <h6 class="border-bottom pb-2 mt-4 mb-3 text-primary fw-bold">Cek Data Pak Manoj</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">No Bukti</label>
                            <input type="text" name="no_bukti" id="no_bukti" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Status</label>
                            <input type="text" name="status" id="status" class="form-control">
                        </div>
                    </div>

                    <!-- Checklist -->
                    <h6 class="border-bottom pb-2 mt-4 mb-3 text-primary fw-bold">Status Pembayaran</h6>
                    <div class="row g-3">

                        <div class="row mt-2">
                            <div class="col-md-3 form-check">
                                <input class="form-check-input" type="checkbox" name="dp1" id="dp1"
                                    value="1">
                                <label class="form-check-label" for="dp1">DP1</label>
                            </div>

                            <div class="col-md-3 form-check">
                                <input class="form-check-input" type="checkbox" name="pelunasan1" id="pelunasan1"
                                    value="1">
                                <label class="form-check-label" for="pelunasan1">Pelunasan 1</label>
                            </div>

                            <div class="col-md-3 form-check">
                                <input class="form-check-input" type="checkbox" name="dp2" id="dp2"
                                    value="1">
                                <label class="form-check-label" for="dp2">DP2</label>
                            </div>

                            <div class="col-md-3 form-check">
                                <input class="form-check-input" type="checkbox" name="pelunasan2" id="pelunasan2"
                                    value="1">
                                <label class="form-check-label" for="pelunasan2">Pelunasan 2</label>
                            </div>
                        </div>


                    </div>

                </form>
            </div>
            <div class="modal-footer sticky-bottom bg-body-tertiary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="purchasingOrderForm" class="btn btn-primary btnSubmit"></button>
            </div>
        </div>
    </div>
</div>
