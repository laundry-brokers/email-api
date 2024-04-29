<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Email extends Model
{
    use SoftDeletes;

    protected $table = 'emails';
    protected $fillable = ['name', 'email', 'phone', 'laundry', 'range', 'state', 'city', 'message'];
    public $timestamp = true;

    public static function filterEmails()
    {
        $emails = DB::table('emails')
                      ->select('email')
                      ->get();

        return $emails;
    }

    public static function filterEmail($email)
    {
        $email = DB::table('emails')
                     ->select('email')
                     ->where('email', '=', $email)
                     ->first();
    }
}
