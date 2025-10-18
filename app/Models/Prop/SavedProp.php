<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SavedProp extends Model
{
     use HasFactory;
    public $timestamps = true;
    protected $table = 'savedprops';
    protected $fillable = [
        'prop_id',
        'user_id',
        'title',
        'image',
        'price',
        'location',

    ];
}
