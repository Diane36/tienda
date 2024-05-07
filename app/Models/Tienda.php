<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tienda extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'titulo', 'autor','editorial', 'precio', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
