<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nombre',
        'dni',
        'telefono',
        'email',
        'direccion',
    ];

    /**
     * Get the user that owns the persona record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
