<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        @media print {
            @page {
                size: A3;
            }
        }

        ul {
            padding: 0;
            margin: 0 0 1rem 0;
            list-style: none;
        }

        body {
            font-family: "Inter", sans-serif;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        table th,
        table td {
            border: 1px solid silver;
        }

        table th,
        table td {
            text-align: right;
            padding: 8px;
        }

        h1,
        h4,
        p {
            margin: 0;
        }

        .container {
            padding: 20px 0;
            width: 1000px;
            max-width: 90%;
            margin: 0 auto;
        }

        .inv-body table th,
        .inv-body table td {
            text-align: left;
        }

        .inv-body {
            margin-bottom: 30px;
        }

        .title {
            text-align: center;
            font-size: 20px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }
    </style>
</head>
{{-- @dd($data) --}}

<body>
    <div class="container">
        <div class="title">
            <b>AWR Motor</b>
            <br>
            Jl.Makmur Sudimoro Sidoarjo
        </div>
        <div class="inv-body">
            <table>
                <thead>
                    <th>No</th>
                    <th>Tanggal Beli</th>
                    <th>Pemasok</th>
                    <th>Spare Part</th>
                    <th>Jumlah Dibeli</th>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ indo_date($item->tanggal_pembelian) }}</td>
                            <td>{{ $item->supplier_name }}</td>
                            <td>{{ $item->sparepart }}</td>
                            <td>{{ $item->jumlah_pembelian }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>
