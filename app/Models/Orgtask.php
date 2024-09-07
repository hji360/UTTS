<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orgtask extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'activity', 'description', 'type', 'creator_id'];
}