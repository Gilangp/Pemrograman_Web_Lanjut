<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title">Edit Profil</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form method="POST" action="{{ url('profile') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-body">
                <div class="form-group text-center mt-3 mb-4">
                    <input type="file" name="photo" id="photo" class="d-none" accept="image/*">
                    <label for="photo">
                        <img id="preview-photo"
                            src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('icon_profile.png') }}"
                            alt="Photo"
                            class="img-thumbnail rounded-circle shadow"
                            style="width: 120px; height: 120px; object-fit: cover; cursor: pointer;"
                            title="Klik untuk ganti foto">
                    </label>
                    <label for="photo" class="d-block mt-2 text-primary fw-semibold" style="cursor: pointer;">
                        Ubah Foto
                    </label>
                    <small id="error-foto" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Level Pengguna</label>
                    <input type="text" class="form-control" value="{{ $user->level->level_nama }}" readonly disabled>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input value="{{ $user->username }}" type="text" name="username"
                        id="username" class="form-control" required>
                    <small id="error-username" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input value="{{ $user->nama }}" type="text" name="nama" id="nama"
                        class="form-control" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">Abaikan jika tidak ingin ubah password</small>
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#photo').on('change', function () {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview-photo').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        $.validator.addMethod("filesize", function (value, element, param) {
            if (element.files.length === 0) return true;
            return element.files[0].size <= param;
        }, "Ukuran file maksimal 2MB.");

        $("#form-edit").validate({
            rules: {
                photo: {
                    extension: "jpg|jpeg|png",
                    filesize: 2097152
                },
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                password: {
                    minlength: 6,
                    maxlength: 20
                }
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
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
