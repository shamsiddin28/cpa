<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default (which is the plural form of the model name)
    protected $table = 'stores';

    // Define the fillable properties
    protected $fillable = [
        'name',
        'article',
    ];

    // Optionally, you can define relationships if your model interacts with other models
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Additional methods and relationships can be added here
}
