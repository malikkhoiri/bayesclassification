<?php

namespace App\Http\Controllers;

use App\Tools\NaiveBayesClassifier;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    private $nbc;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->nbc = new NaiveBayesClassifier();

        $this->nbc->train(storage_path('app/public/data/datatraining.csv'));
        $doc = $this->nbc->getDocuments();
        $class = $this->nbc->getClass();
        $wordsInClass = $this->nbc->getWordInClass();
        $numWordsInClass = $this->nbc->getNumWordInClass();
        $totalWords = $this->nbc->getTotalWords();

        return view('pages.process', [
            'doc' => $doc,
            'class' => $class,
            'ket' => ['Keuangan', 'PFD', 'Permanen'],
            'wordsInClass' => $wordsInClass,
            'numWordsInClass' => $numWordsInClass,
            'totalWords' => $totalWords
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }


    /**
     * Testing Naive Bayes Classifier
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function testing(Request $request)
    {
        $in = $request->input('testing');

        $this->nbc = new NaiveBayesClassifier();

        $this->nbc->train(storage_path('app/public/data/datatraining.csv'));
        $this->nbc->getDocuments();
        $this->nbc->getWordInClass();
        $this->nbc->getNumWordInClass();

        $classification = $this->nbc->getClassification($in);

        $output = array_search(max($classification), $classification);

        return redirect('/process')->with('output', $output)->with('classification', $classification)->with('input', $in);
    }
}
