<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default (which is the plural form of the model name)
    protected $table = 'products';

    // Define the fillable properties
    protected $fillable = [
        'name',
        'img',
        'article',
        'code',
        'buy_price',
        'sell_price',
        'category_id',
        'weight',
        'store_id',
        'IKPU',
        'status',
        'pay_web',
        'offer',
        'shipping',
        'created_at',
        'updated_at',
    ];

    // Optionally, you can define relationships if your model interacts with other models
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Automatically set the created_at field when creating a new product
        static::creating(function ($product) {
            $product->created_at = Carbon::now()->addHours(5);
            $product->updated_at = Carbon::now()->addHours(5);
        });

        // Automatically set the updated_at field when updating a product
        static::updating(function ($product) {
            $product->updated_at = Carbon::now()->addHours(5);
        });

        static::creating(function ($product) {
            $store = $product->store;

            // Get the store article prefix
            $storeArticlePrefix = $store->article;

            // Find the last product with the same store and determine the next number
            $lastProduct = Product::where('store_id', $store->id)->orderBy('id', 'desc')->first();

            $nextNumber = 1;
            if ($lastProduct) {
                $lastArticle = $lastProduct->article;
                $nextNumber = intval(str_replace($storeArticlePrefix, '', $lastArticle)) + 1;
            }

            // Generate the article and code
            $product->article = $storeArticlePrefix . $nextNumber;
            $product->code = $storeArticlePrefix . $nextNumber;
        });
    }



    // Additional methods and relationships can be added here
}
