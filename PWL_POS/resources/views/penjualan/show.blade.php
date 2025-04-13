<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Data Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Tabel informasi Penjualan -->
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
                    <th>Nama User</th>
                    <td>{{ $penjualan->user->nama }}</td>
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

            <!-- Tabel Detail Barang yang Dibeli -->
            <h5>Barang yang Dibeli</h5>
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($penjualan->penjualanDetail as $detail)
                        <tr>
                            <td>{{ $detail->barang->barang_nama }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @php
                            $subtotal += $detail->harga * $detail->jumlah;
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="3"><strong>Subtotal</strong></td>
                        <td><strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
