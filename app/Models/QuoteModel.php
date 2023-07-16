<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteModel extends Model
{
    use HasFactory;

    protected $table = 'quotes';
    protected $fillable = ['quote_text', 'quote_author', 'category_id'];

    public function category(){
        return $this->hasOne(CategoryModel::class, 'id');
    }
}
