<?php

// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
    ];

    public function partitions()
    {
        return $this->hasMany(Partition::class);
    }

    public function items()
    {
        return $this->hasManyThrough(Item::class, Partition::class);
    }
}