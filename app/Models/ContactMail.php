<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMail extends Model
{
    use HasFactory;

    protected $fillable =[

        'name',
        'status',
        'email',
        'number',
        'subject',
        'usermessage'
    ];


    protected $hidden = [
        'status',
    ];
    protected $casts=[
        'status'=>'boolean',
    ];





}
