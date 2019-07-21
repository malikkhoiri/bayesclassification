<?php

namespace App\Tools;

use App\Traits\StringFilter;
use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\StopWordRemover\StopWordRemoverFactory;
use Sastrawi\Stemmer\Filter\TextNormalizer;

class NaiveBayesClassifier
{
    use StringFilter;

    private $token = [];
    private $class = [];
    private $numWordInClass = [];
    private $wordInClass = [];
    private $documents = [];
    private $totalWords = 0;

    public function train($filePath): void
    {
        if(file_exists($filePath)){
            $this->documents = array_map('str_getcsv', file($filePath));

            for ($i=0; $i<count($this->documents); $i++){

                $this->documents[$i][0] = $this->preProcessing($this->documents[$i][0]);

                $this->totalWords += count($this->documents[$i][0]);

                array_push($this->class, $this->documents[$i][1]);
            }

            $this->class = array_merge(array_unique($this->class));
        }
    }

    public function getClassification($str): array
    {
        $nbc = [];

        $str = $this->preProcessing($str);

        for($i=0; $i<count($this->class); $i++){
            $temp = array_count_values($this->wordInClass[$this->class[$i]]);
            $pr = 1;
            foreach ($str as $token){
                if (array_key_exists($token, $temp))
                    $pr *= (1 + $temp[$token]) / ($this->numWordInClass[$this->class[$i]] + $this->totalWords);
                else
                    $pr *= 1 / ($this->numWordInClass[$this->class[$i]] + $this->totalWords);
            }
            $nbc[$this->class[$i]] = $pr;
        }

        return $nbc;
    }

    //        Pembayaran Kas/bank bulan 2015

    private function preProcessing($str): array
    {
        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        $swFactory = new StopWordRemoverFactory();
        $stopWord = $swFactory->createStopWordRemover();

        $str = TextNormalizer::normalizeText($str);
        $str = $stopWord->remove($str);
        $str = $this->removeCommonWords($str);
        $str = $this->removeNumerical($str);

        for ($i=0; $i<count($str); $i++){
            $str[$i] = $stemmer->stem( $str[$i]);
        }

        $str = $this->customFilter( $str);

        return $str;
    }

    /**
     * @return array
     */
    public function getClass(): array
    {
        return $this->class;
    }

    /**
     * @return mixed
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }

    /**
     * @return array
     */
    public function getToken(): array
    {
        return $this->token;
    }

    /**
     * @return array
     */
    public function getWordInClass(): array
    {
        foreach ($this->documents as $document){
            for($i=0; $i<count($this->class); $i++){
                if(!array_key_exists($this->class[$i], $this->wordInClass))
                    $this->wordInClass[$this->class[$i]] = [];

                if($document[1] == $this->class[$i])
                    $this->wordInClass[$this->class[$i]] = array_merge($this->wordInClass[$this->class[$i]], $document[0]);
            }
        }

        return $this->wordInClass;
    }

    /**
     * @return array
     */
    public function getNumWordInClass(): array
    {
        foreach ($this->documents as $document){
            for($i=0; $i<count($this->class); $i++){
                if(!array_key_exists($this->class[$i], $this->numWordInClass))
                    $this->numWordInClass[$this->class[$i]] = 0;

                if($document[1] == $this->class[$i])
                    $this->numWordInClass[$this->class[$i]] += count($document[0]);
            }
        }
        return $this->numWordInClass;
    }

    /**
     * @return int
     */
    public function getTotalWords(): int
    {
        return $this->totalWords;
    }
}
