<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    public function projets()
    {
        return $this->morphMany(Projet::class, 'entitable');
    }

    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            AssociationUser::class,
            'section_id', // Foreign key on pivot
            'id',         // Foreign key on users
            'id',         // Local key on sections
            'user_id'     // Local key on pivot
        );
    }
}
