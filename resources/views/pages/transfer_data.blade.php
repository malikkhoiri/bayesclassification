@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Pemindahan</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 margin-bottom-30">
                                <a href="{{url('/transfer-data/add')}}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>&ensp;<span> Tambah Data</span>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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
                                        <th rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">No. SP</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">No. SP</th>
                                    </tr>
                                    </thead>
                                    @php $i=1 @endphp
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
                                            <td class="text-center">
                                                <form method="post" action="{{route('delete', $d->id)}}">
                                                    @csrf
                                                    {{@method_field('DELETE')}}
                                                    <button type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
