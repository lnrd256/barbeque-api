<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Barbeque extends Model
{
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'model', 'description','image','rented'
    ];
    public function user(){
        return $this->belongsToMany(User::class,'barbeque_user')->withPivot('id','rent_date', 'return_date');;
    }
}
