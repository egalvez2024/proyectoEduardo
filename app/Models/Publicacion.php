<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
