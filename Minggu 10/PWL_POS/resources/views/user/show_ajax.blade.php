<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Data User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <!-- Foto -->
                <div class="col-md-4 text-center mb-3">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('icon_profile.png') }}"
                        alt="Photo"
                        class="img-thumbnail rounded-circle shadow"
                        style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                <!-- Data -->
                <div class="col-md-8">
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <tr>
                            <th>ID</th>
                            <td>{{ $user->user_id }}</td>
                        </tr>
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
    </div>
</div>
