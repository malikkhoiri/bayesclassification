<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tools\NaiveBayesClassifier;

class ToolsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('NaiveBayesClassifier', function () {
            return new NaiveBayesClassifier;
        });
    }
}