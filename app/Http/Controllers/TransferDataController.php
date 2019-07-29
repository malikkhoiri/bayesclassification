<?php

namespace App\Http\Controllers;

use App\Tools\NaiveBayesClassifier;
use App\TransferData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TransferDataController extends Controller
{
    private $class = [
        "A1" => "KEUANGAN",
        "A2" => "PFD",
        "A3" => "PERMANEN"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TransferData::all()->sortByDesc('date_receive');
        return view('pages.transfer_data', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.add_data');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TransferData();

        $data->unit = $request->input('unit');
        $data->date_receive = $request->input('date_receive');
        $data->sp_receive = $request->input('sp_receive');
        $data->doc_qty = $request->input('doc_qty');
        $data->date_sent= $request->input('date_sent');
        $data->sp_sent = $request->input('sp_sent');
        $data->doc = $request->input('doc');
        $data->retensi = $request->input('retensi');

        $in = $request->input('doc');

        $nbc = new NaiveBayesClassifier();

        $nbc->train(storage_path('app/public/data/datatraining.csv'));
        $nbc->getDocuments();
        $nbc->getWordInClass();
        $nbc->getNumWordInClass();

        $classification = $nbc->getClassification($in);

        $output = $this->class[array_search(max($classification), $classification)];

        $data->classification = $output;

        $data->save();

        return redirect('/transfer-data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TransferData::find($id);

        $data->delete();

        return redirect('/transfer-data');
    }

    /**
     * Print preview a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function preview()
    {
        return view('pages.print');
    }

    /**
     * Print the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        $year = $request->input('year');
        $key = $request->input('class');

        $data = DB::table('transfer_data')->where(DB::raw('EXTRACT(YEAR FROM date_receive)'), $year)
            ->where('classification', $this->class[$key])->get();

        return redirect('/print-data');
    }

}
