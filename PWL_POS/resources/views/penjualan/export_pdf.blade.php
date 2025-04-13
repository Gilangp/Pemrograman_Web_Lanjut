<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Penjualan</title>
    <style>
        body{
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        td, th {
            padding: 4px 3px;
        }
        th {
            text-align: left;
        }
        .d-block {
            display: block;
        }
        img {
            width: auto;
            height: 80px;
            max-width: 150px;
            max-height: 150px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .p-1 {
            padding: 5px 1px 5px 1px;
        }
        .font-10 {
            font-size: 10pt;
        }
        .font-11 {
            font-size: 11pt;
        }
        .font-12 {
            font-size: 12pt;
        }
        .font-13 {
            font-size: 13pt;
        }
        .font-bold {
            font-weight: bold;
        }
        .border-bottom-header {
            border-bottom: 1px solid;
        }
        .border-all, .border-all th, .border-all td {
            border: 1px solid;
        }
    </style>
</head>
<body>

    <table class="border-bottom-header">
        <tr>
            <td width="85%">
                <span class="text-center d-block font-13 font-bold">PWL POS</span>
                <br>
                <span class="text-center d-block font-11 font-bold">Jl. Merdeka No. 123, Malang</span>
            </td>
        </tr>
    </table>

    <h3 class="text-center">STRUK PENJUALAN</h3>

    <table class="border-all">
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

    <h4>Barang yang Dibeli</h4>
    <table class="border-all">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php $subtotal = 0; @endphp
            @foreach ($penjualan->penjualanDetail as $detail)
                <tr>
                    <td>{{ $detail->barang->barang_nama }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td class="text-right">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
                </tr>
                @php $subtotal += $detail->harga * $detail->jumlah; @endphp
            @endforeach
            <tr>
                <td colspan="3"><strong>Subtotal</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

</body>
</html>
