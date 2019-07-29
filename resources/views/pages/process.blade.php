@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Testing</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{url('/process/testing')}}">
                                    <div class="input-group">
                                        <label class="sr-only" for="testing"></label>
                                        <input type="text" id="testing" name="testing" class="form-control" placeholder="Input disini" required minlength="3">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">Test</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if(session('output'))
                            <pre>Input: {{session('input')}}<br>Output: {{session('output')}}<br><br>Hasil Naive Bayes Classifier:<br>@foreach(session('classification') as $key => $val){{$key}} => {{sprintf('%0.6f', $val)}}<br>@endforeach</pre>
                        @endif
                    </div>
                </div>

                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Proses Naive Bayes Classifier</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center">Kelas</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($doc as $d)
                                        <tr>
                                            <td class="text-center">{{$i++}}</td>
                                            <td>{{implode($d[0], ' ')}}</td>
                                            <td class="text-center">{{$d[1]}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Kata Dalam Kelas</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Kelas</th>
                                        <th>Kata Dalam Kelas</th>
                                        <th class="text-center">Jumlah Kata</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wordsInClass as $key => $val)
                                        <tr>
                                            <td class="text-center">{{$key}}</td>
                                            <td>{{implode($val, ', ')}}</td>
                                            <td class="text-center">{{count($val)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Total</th>
                                            <th></th>
                                            <th class="text-center">{{$totalWords}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-headline">
                            <div class="panel-heading">
                                <h3 class="panel-title">Kelas</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Jenis File</th>
                                                <th class="text-center">Kelas</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i=1 @endphp
                                            @foreach($class as $c)
                                                <tr>
                                                    <td class="text-center">{{$i++}}</td>
                                                    <td>{{$ket[$i-2]}}</td>
                                                    <td class="text-center">{{$c}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
