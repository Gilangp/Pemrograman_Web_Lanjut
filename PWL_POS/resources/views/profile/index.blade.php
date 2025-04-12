<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title">Profil Pengguna</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body text-center">
            <div class="row justify-content-center mb-3">
                <!-- Foto -->
                <div class="col-md-4">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('icon_profile.png') }}"
                        alt="Photo"
                        class="img-thumbnail rounded-circle shadow"
                        style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            </div>
            <!-- Data -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <tr>
                            <th>Level</th>
                            <td>{{ $user->level->level_nama }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>********</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between">
            <button onclick="modalAction( '{{ url('profile/edit') }}')" class="btn btn-primary" data-dismiss="modal" id="btn-edit-profile">Edit Profil</button>
            <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
