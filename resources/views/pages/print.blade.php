@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="container-fluid">
                        <div class="panel panel-headline">
                            <div class="panel-heading">
                                <h3 class="panel-title">Cetak Data Pemindahan</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-inline" method="post" action="{{route('print')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="sr-only" for="class">Jenis Dokumen</label>
                                        <select class="form-control" id="class" name="class" required>
                                            <option value="">-- Jenis --</option>
                                            <option value="A1">KEUANGAN</option>
                                            <option value="A2">PFD</option>
                                            <option value="A3">PERMANEN</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="year">Tahun</label>
                                        <input type="number" class="form-control" id="year" name="year" placeholder="Tahun" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('data'))
                <div class="container-fluid">
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Pemindahan</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">No.</th>
                                    <th colspan="3" class="text-center">Penerimaan</th>
                                    <th rowspan="2" class="text-center">Jumlah</th>
                                    <th colspan="2" class="text-center">Pengiriman</th>
                                    <th rowspan="2" class="text-center">Judul Dokumen</th>
                                    <th rowspan="2" class="text-center">Klasifikasi</th>
                                    <th rowspan="2" class="text-center">Ret.</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">No. SP</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">No. SP</th>
                                </tr>
                                </thead>
                                @php
                                    $i=1;
                                    $data = session('data');
                                @endphp
                                @foreach($data as $d)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-center">{{$d->unit}}</td>
                                        <td class="text-center">{{$d->date_receive}}</td>
                                        <td class="text-center">{{$d->sp_receive}}</td>
                                        <td class="text-center">{{$d->doc_qty}}</td>
                                        <td class="text-center">{{$d->date_sent}}</td>
                                        <td class="text-center">{{$d->sp_sent}}</td>
                                        <td>{{$d->doc}}</td>
                                        <td class="text-center">{{$d->classification}}</td>
                                        <td class="text-center">{{$d->retensi}}</td>
                                    </tr>
                                @endforeach
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="{{route('export.pdf', ['data' => $data])}}" class="btn btn-primary" target="_blank">Export PDF</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
