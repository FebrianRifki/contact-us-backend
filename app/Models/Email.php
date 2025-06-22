<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'parent_id',
        'first_name',
        'last_name',    
        'sender_email',
        'subject',
        'message',
        'status'
    ];

}
