@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="container-fluid">
                        <div class="panel panel-headline">
                            <div class="panel-heading">
                                <h3 class="panel-title">Tambah Data Pemindahan</h3>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="{{route('save')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_receive">Tanggal Penerimaan</label>
                                        <input type="date" class="form-control" id="date_receive" name="date_receive" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sp_receive">No. SP Penerimaan</label>
                                        <input type="text" class="form-control" id="sp_receive" name="sp_receive" placeholder="SP Penerimaan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="doc_qty">Jumlah Dokumen</label>
                                        <input type="number" class="form-control" id="doc_qty" name="doc_qty" placeholder="Jumlah Dokumen" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_sent">Tanggal Pengiriman</label>
                                        <input type="date" class="form-control" id="date_sent" name="date_sent" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sp_sent">No. SP Pengiriman</label>
                                        <input type="text" class="form-control" id="sp_sent" name="sp_sent" placeholder="SP Pengiriman" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="doc">Judul Dokumen</label>
                                        <input type="text" class="form-control" id="doc" name="doc" placeholder="Judul Dokumen" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="retensi">Retensi</label>
                                        <select class="form-control" id="retensi" name="retensi" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="0">Permanen</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
