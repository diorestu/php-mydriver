<table border="1">
    <thead>
        <tr>
            <th colspan='5'>
                <h1><b>REKAP ABSENSI {{ date('d m Y') }}</b></h1>
            </th>
        </tr>
        <tr>
            <th align="center">No</th>
            <th align="center">Nama</th>
            <th align="center">Jam Hadir</th>
            <th align="center">Jam Pulang</th>
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
            <td align="center">{{ $item->hadir }}</td>
            <td align="center">{{ $item->pulang }}</td>
            <td>{{ $item->deskripsi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

