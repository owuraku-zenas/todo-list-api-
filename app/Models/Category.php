<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function todos()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
}
