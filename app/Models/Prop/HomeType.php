<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class HomeType extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'hometypes';
    protected $fillable = [
        'id',
        'home_types',
    ];

}
