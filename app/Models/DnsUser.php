<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DnsUser extends Model
{
    use HasFactory;

    protected $table = 'dns_users'; // Specify the table name

    protected $fillable = ['username', 'email', 'password'];
}
