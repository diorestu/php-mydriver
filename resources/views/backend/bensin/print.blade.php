<table>
    <thead>
        <tr>
            <th colspan='5'>
                <h1 style="align: center;"><b>REKAP BENSIN {{ Carbon\Carbon::now()->locale('id')->isoFormat('dddd, LL') }}</b></h1>
            </th>
        </tr>
        <tr>
            <th align="center">No</th>
            <th align="center">Nama</th>
            <th align="center">Mobil</th>
            <th align="center">Tanggal</th>
            <th align="center">Jumlah Pembelian</th>
            <th align="center">KM Mobil</th>
            <th align="center">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($datas as $item)
        <tr>
            <td align="center">{{ $no++ }}</td>
            <td>{{ $item->user->name }}</td>
            <td align="center">{{ $item->mobil->nama }} - {{ $item->mobil->plat }}</td>
            <td align="center">{{ $item->tanggal }}</td>
            <td align="center">{{ $item->harga }}</td>
            <td align="center">{{ $item->km }}</td>
            <td>{{ $item->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
