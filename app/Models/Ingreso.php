<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = 'ingresos';

    protected $fillable = [
        'fecha',
        'concepto',
        'detalle',
        'monto',
        'nro_comprobante',
        'user_id',
        'categoria_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    //SCOPE PARA BUSQUEDA
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search_comprobante'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nro_comprobante', 'like', '%' . $search . '%');
            });
        })->when($filters['search_categoria'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('categoria', function ($query) use ($search) {
                    $query->where('id', $search);
                });
            });
        })->when($filters['search_anho'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereYear('fecha', $search);
            });
        })->when($filters['search_mes'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereMonth('fecha', $search);
            });
        });
       
    }
}
