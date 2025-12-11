<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Association extends Model
{
    //
    protected $fillable = [
        'name', 'acronym', 'object', 'description',
        'email', 'phone', 'address', 'country', 'city',
        'president_name', 'president_phone',
        'creation_date', 'rccm', 'npi',
        'logo_path'
    ];

    protected $casts = [
        'documents' => 'array',
        'creation_date' => 'date'
    ];
    public function projets()
    {
        return $this->morphMany(Projet::class, 'entitable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'association_user')
            ->withPivot(['section_id', 'role', 'is_admin'])
            ->withTimestamps();
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->uuid) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }
}
