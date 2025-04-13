<form action="{{ url('penjualan') }}" method="POST" id="form-penjualan">
    @csrf
    <div class="modal-dialog modal-lg" role="document" id="modal-master">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" class="form-control" value="{{ $user->level->level_nama }}" readonly>
                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                </div>

                <div class="form-group">
                    <label>Nama Pembeli</label>
                    <input type="text" name="pembeli" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input type="text" name="penjualan_kode" class="form-control" readonly value="{{ $kodePenjualan }}">
                </div>

                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input type="date" name="tanggal_penjualan" class="form-control" value="{{ date('Y-m-d') }}">
                </div>

                <!-- tambah barang -->
                <div class="form-group">
                    <div class="row mb-2">
                        <div class="col d-flex justify-content-between align-items-center">
                            <label>Daftar Barang</label>
                            <button type="button" class="btn btn-success btn-sm" id="tambah-barang"><i></i> Tambah Barang</button>
                        </div>
                    </div>

                    <table class="table table-bordered" id="table-barang">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="barang_id[]" class="form-control barang-select" required>
                                        <option value="">-- Pilih Barang --</option>
                                        @foreach ($barang as $b)
                                            <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" class="form-control harga" name="harga[]" readonly></td>
                                <td><input type="number" class="form-control jumlah" name="jumlah[]" value="1" min="1" required></td>
                                <td class="subtotal text-right">Rp 0</td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="$(this).closest('tr').remove(); hitungTotal();">Hapus</button></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total</strong></td>
                                <td colspan="2" class="text-right" id="totalHargaText">Rp 0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <input type="hidden" name="total_harga" id="total_harga" value="0">

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#form-penjualan").validate({
            rules: {
                user_id: { required: true },
                pembeli: { required: true },
                penjualan_kode: { required: true },
                tanggal_penjualan: { required: true },
                'barang_id[]': { required: true },
                'jumlah[]': {required: true, number: true, min: 1}
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: response.message
                            });
                            dataPenjualan.ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengirim data.'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    $(document).ready(function () {
        $('#tambah-barang').off('click').on('click', function () {
            let row = `
                <tr>
                    <td>
                        <select name="barang_id[]" class="form-control barang-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" class="form-control harga" name="harga[]" readonly></td>
                    <td><input type="number" class="form-control jumlah" name="jumlah[]" value="1" min="1" required></td>
                    <td class="subtotal text-right">Rp 0</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="$(this).closest('tr').remove(); hitungTotal();">Hapus</button></td>
                </tr>
            `;
            $('#table-barang tbody').append(row);
        });

        $(document).on('change', '.barang-select', function () {
            let harga = $(this).find('option:selected').data('harga') || 0;
            $(this).closest('tr').find('.harga').val(harga);
            updateSubtotal($(this).closest('tr'));
        });

        $(document).on('input', '.jumlah', function () {
            updateSubtotal($(this).closest('tr'));
        });

        function updateSubtotal(row) {
            let harga = parseFloat(row.find('.harga').val()) || 0;
            let jumlah = parseInt(row.find('.jumlah').val()) || 1;
            let subtotal = harga * jumlah;
            row.find('.subtotal').text("Rp " + subtotal.toLocaleString('id-ID'));
            hitungTotal();
        }

        function hitungTotal() {
            let total = 0;
            $('#table-barang tbody tr').each(function () {
                let harga = parseFloat($(this).find('.harga').val()) || 0;
                let jumlah = parseInt($(this).find('.jumlah').val()) || 0;
                total += harga * jumlah;
            });
            $('#totalHargaText').text("Rp " + total.toLocaleString('id-ID'));
            $('#total_harga').val(total);
        }
    });
</script>
