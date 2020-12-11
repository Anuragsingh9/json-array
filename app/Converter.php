<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Converter extends Model
{
    protected $table = 'save_array_data';
    
    protected $fillable = ['bounce_type','bounceSubType','timestamp','mail_timestamp','name',
    'value','from','reply_to','to'];

    protected $casts = [
        'from' => 'array',
        'reply_to'=>'array',
        'to' => 'array'
      ];
}
