<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Data Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID Penjualan</th>
                    <td>{{ $penjualan->penjualan_id }}</td>
                </tr>
                <tr>
                    <th>ID User</th>
                    <td>{{ $penjualan->user->user_id }}</td>
                </tr>
                <tr>
                    <th>Pembeli</th>
                    <td>{{ $penjualan->pembeli }}</td>
                </tr>
                <tr>
                    <th>Kode Penjualan</th>
                    <td>{{ $penjualan->penjualan_kode }}</td>
                </tr>
                <tr>
                    <th>Tanggal Penjualan</th>
                    <td>{{ $penjualan->tanggal_penjualan }}</td>
                </tr>
            </table>
    </div>
</div>
