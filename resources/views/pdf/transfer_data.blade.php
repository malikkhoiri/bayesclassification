<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Pemindahan</title>

    <style type="text/css">
        @page
        {
            /*The A4 paper size is 210 mm wide by 297 mm long*/
            size: 297mm 210mm;
            margin: 1.27cm;
        }

        div {
            word-wrap: normal !important;
        }

        table {
            table-layout: auto !important;
            width: 98% !important;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #CCC;
            text-align: center;
        }

        td.doc {
            text-align: left;
        }

        tbody tr:nth-child(even){background-color: #f2f2f2}

        .table-container {
            width: 20% !important;
            display: table;
        }

        .table-container > div {
            display: table-row;
        }

        .table-container > div > div {
            display: table-cell;
            padding-top: 4px;
            padding-bottom: 4px;
        }

        .title {
            text-align: center;
        }
    </style>

<body>
    <footer class="footer">
        <span class="page-num"></span>
    </footer>
    <h2 class="title">Laporan Data Pemindahan</h2>
    <div class="table-container">
        <div>
            <div>Dokumen</div>
            <div>: {{ucfirst(strtolower($data[0]["classification"]))}}</div>
        </div>
        <div>
            <div>Tahun</div>
            <div>: {{date("Y", strtotime($data[0]["date_receive"]))}}</div>
        </div>
    </div>
    <div>
        <table>
            <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th colspan="3" >Penerimaan</th>
                <th rowspan="2" >Jumlah</th>
                <th colspan="2" >Pengiriman</th>
                <th rowspan="2" >Judul Dokumen</th>
                <th rowspan="2" >Klasifikasi</th>
                <th rowspan="2" >Ret.</th>
            </tr>
            <tr>
                <th >Unit</th>
                <th >Tanggal</th>
                <th >No. SP</th>
                <th >Tanggal</th>
                <th >No. SP</th>
            </tr>
            </thead>
            @php
                $i=1;
            @endphp
            @foreach($data as $d)
                <tr>
                    <td >{{$i++}}</td>
                    <td >{{$d["unit"]}}</td>
                    <td >{{$d["date_receive"]}}</td>
                    <td >{{$d["sp_receive"]}}</td>
                    <td >{{$d["doc_qty"]}}</td>
                    <td >{{$d["date_sent"]}}</td>
                    <td >{{$d["sp_sent"]}}</td>
                    <td class="doc">{{$d["doc"]}}</td>
                    <td >{{$d["classification"]}}</td>
                    <td >{{$d["retensi"]}}</td>
                </tr>
            @endforeach
            <tbody>
            </tbody>
        </table>
    </div>
    <p>
        <strong>
            <em>Jumlah dokumen : {{$total}}</em>
        </strong>
    </p>
</body>
