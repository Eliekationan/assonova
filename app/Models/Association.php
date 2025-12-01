<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    //
    public function projets()
    {
        return $this->morphMany(Projet::class, 'entitable');
    }
}
