<form action="{{ url('penjualan') }}" method="POST" id="form-penjualan">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">- Pilih User -</option>
                        @foreach ($user as $item)
                            <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-user-id" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Nama Pembeli</label>
                    <input type="text" name="pembeli" id="pembeli" class="form-control" required>
                    <small id="error-pembeli" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input type="text" name="penjualan_kode" id="penjualan_kode" class="form-control" required>
                    <small id="error-penjualan-kode" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control" required>
                    <small id="error-tanggal-penjualan" class="form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#form-penjualan').validate({
            rules: {
                user_id: { required: true },
                pembeli: { required: true },
                penjualan_kode: { required: true },
                tanggal_penjualan: { required: true },
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    method: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            $('#table_penjualan').DataTable().ajax.reload();
                        } else {
                            $('.form-text.text-danger').text('');
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix.replace('_', '-')).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'small',
            errorPlacement: function (error, element) {
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
</script>
