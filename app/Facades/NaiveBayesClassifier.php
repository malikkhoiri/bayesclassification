<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class NaiveBayesClassifier extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'NaiveBayesClassifier';
    }
}
