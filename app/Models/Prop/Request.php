<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Prop\Property;
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
      public function property(){
        return $this->belongsTo(Property::class, 'prop_id');
    }
}
