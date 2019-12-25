<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Customer extends Model
{
	protected $guarded =[];
    public function user()
    {
    	return $this->beLongsTo(User::class);
    }
    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}
