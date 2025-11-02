<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
    'title',
    'description',
    'start_date',
    'end_date',
    'is_active',
];

public function votes()
{
    return $this->hasMany(Vote::class);
}


}
