<form action="{{ url('/user/ajax') }}" method="POST" id="form-tambah" enctype="multipart/form-data">
@csrf
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="form-group text-center mt-3 mb-4">
                <input type="file" name="photo" id="photo" class="d-none" accept="image/*">
                <label for="photo">
                    <img id="preview-photo" src="{{ asset('icon_profile.png') }}" alt="Photo" class="img-thumbnail rounded-circle shadow"
                        style="width: 120px; height: 120px; object-fit: cover; cursor: pointer;" title="Klik untuk ganti foto">
                </label>
                <label for="photo" class="d-block mt-2 text-primary" style="cursor: pointer;">
                    Tambah Foto
                </label>
                <small id="error-foto" class="error-text form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label>Level Pengguna</label>
                <select name="level_id" id="level_id" class="form-control" required>
                    <option value="">- Pilih Level -</option>
                    @foreach($level as $l)
                        <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                    @endforeach
                </select>
                <small id="error-level_id" class="error-text form-text text-danger"></small>
            </div>
        <div class="form-group">
            <label>Username</label>
            <input value="" type="text" name="username" id="username" class="form-control" required>
            <small id="error-username" class="error-text form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input value="" type="text" name="nama" id="nama" class="form-control" required>
            <small id="error-nama" class="error-text form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input value="" type="password" name="password" id="password" class="form-control" required>
            <small id="error-password" class="error-text form-text text-danger"></small>
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
        $('#photo').on('change', function () {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $('#preview-photo').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        $.validator.addMethod("filesize", function (value, element, param) {
            if (element.files.length === 0) return true;
            return element.files[0].size <= param;
        }, "Ukuran file maksimal 2MB.");

        $("#form-tambah").validate({
            rules: {
                photo: { extension: "jpg|jpeg|png", filesize: 2097152 },
                level_id: { required: true, number: true },
                username: { required: true, minlength: 3, maxlength: 20 },
                nama: { required: true, minlength: 3, maxlength: 100 },
                password: { required: true, minlength: 6, maxlength: 20 },
            },
            submitHandler: function (form) {
                let formData = new FormData(form);
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataUser.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]);
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
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
