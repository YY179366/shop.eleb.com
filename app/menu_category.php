<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu_category extends Model
{
    protected $fillable=['name','created_at','shop_id','updated_at','type_accumulation','description','is_selected'];

    public function shop()
    {
        return $this->belongsTo(shop::class, 'shop_id','id');
    }
}
