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
        </div>
    </div>
@endsection
