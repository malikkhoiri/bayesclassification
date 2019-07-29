<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferData extends Model
{
    protected $fillable = ['unit', 'date_receive', 'sp_receive', 'doc_qty', 'date_sent', 'sp_sent', 'doc', 'retensi', 'classification'];
}
