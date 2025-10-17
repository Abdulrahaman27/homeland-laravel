<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PropImage extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'prop_images';
    protected $fillable = [
        'prop_id',
        'image',
    
    ];
}
