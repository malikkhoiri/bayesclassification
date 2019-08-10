<?php

namespace App\Http\Controllers;

use App\Tools\NaiveBayesClassifier;
use App\TransferData;
use Dompdf\FontMetrics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

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

        $data = (DB::table('transfer_data')->where(DB::raw('EXTRACT(YEAR FROM date_receive)'), $year)
            ->where('classification', $this->class[$key])->orderBy('date_receive')->get())->all();

        return redirect('/print-data')->with('data', $data);
    }

    public function exportPdf(Request $request){
        $data = $request->input('data');

        $total = 0;

        foreach ($data as $d){
            $total += $d["doc_qty"];
        }

        $pdf = PDF::loadView('pdf.transfer_data', ['data' => $data, 'total' => $total]);
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();

        $font = new FontMetrics($canvas, $dom_pdf->getOPtions());

        $canvas->page_text($canvas->get_width()/2-35, $canvas->get_height()-35, "Page {PAGE_NUM} of {PAGE_COUNT}", $font->getFont('helvetica', 'normal'), 10, array(0, 0, 0));

        $filename = "DP_".$data[0]["classification"]."_".date("Y", strtotime($data[0]["date_receive"])).".pdf";

        return $pdf->stream($filename);
    }

}
