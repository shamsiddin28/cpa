<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default (which is the plural form of the model name)
    protected $table = 'categories';

    // Define the fillable properties
    protected $fillable = [
        'name',
        'parent_id',
    ];

    // Optionally, you can define relationships if your model interacts with other models
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Additional methods and relationships can be added here
}
