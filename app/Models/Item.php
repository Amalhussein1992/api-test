<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'partition_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'price'
    ];

    public function partition()
    {
        return $this->belongsTo(Partition::class);
    }

    public function category()
    {
        return $this->partition->category;
    }
}