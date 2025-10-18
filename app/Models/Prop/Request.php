<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Request extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'requests';
    protected $fillable = [
        'prop_id',
        'agent_name',
        'user_id',
        'name',
        'email',
        'phone',
    ]; 
}
