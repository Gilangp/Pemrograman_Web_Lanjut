@empty($stok)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data stok tidak ditemukan.
                </div>
                <a href="{{ url('/stok') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/stok/' . $stok->stok_id) }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama User</label>
                        <select class="form-control" disabled>
                            @foreach($user as $item)
                                @if($item->user_id == $stok->user_id)
                                    <option selected>{{ $item->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select class="form-control" disabled>
                            @foreach($barang as $item)
                                @if($item->barang_id == $stok->barang_id)
                                    <option selected>{{ $item->barang_nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="hidden" name="barang_id" value="{{ $stok->barang_id }}">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Stok</label>
                        <input type="date" name="stok_tanggal" id="stok_tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        <small id="error-stok-tanggal" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Stok</label>
                        <input type="number" name="stok_jumlah" id="stok_jumlah" class="form-control"
                            value="{{ $stok->stok_jumlah }}" required>
                        <small id="error-stok-jumlah" class="error-text form-text text-danger"></small>
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
            $("#form-edit").validate({
                rules: {
                    user_id: { required: true },
                    barang_id: { required: true },
                    stok_tanggal: { required: true },
                    stok_jumlah: { required: true, number: true, min: 1 }
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
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                $('#table_stok').DataTable().ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function (prefix, val) {
                                    $('#error-' + prefix.replace('_', '-')).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
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
    </script>
@endempty
