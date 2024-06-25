
<!DOCTYPE html>
<html>
<head>
    <title>Data Disposisi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .nested-table {
            width: 100%;
            border-collapse: collapse;
        }
        .nested-table th, .nested-table td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Disposisi</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Surat</th>
                <th>Nomor Surat Masuk</th>
                <th>Perihal</th>
                <th>Pengirim</th>
                <th>Keterangan Disposisi</th>
                <th>Keputusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disposisis as $index => $disposisi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $disposisi->created_at }}</td>
                    <td>{{ $disposisi->surat->nomor_surat }}</td>
                    <td>{{ $disposisi->surat->perihal }}</td>
                    <td>{{ $disposisi->surat->pengirim }}</td>
                    <td>
                        <table class="nested-table">
                            <thead>
                                <tr>
                                    <th>Tgl</th>
                                    <th>Oleh</th>
                                    <th>Disposisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($disposisi->keterangan_disposisi as $keterangan)  
                                <tr>
                                        <td>{{ $keterangan['tgl'] }}</td>
                                        <td>{{ $keterangan['oleh'] }}</td>
                                        <td>{{ $keterangan['disposisi'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td>{{ $disposisi->keputusan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>