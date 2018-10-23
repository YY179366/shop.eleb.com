<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $fillable = [
        'goods_name',
        'rating',
        'shop_id',
        'category_id',
        'goods_price',
        'description',
        'month_sales',
        'rating_count',
        'tips',
        'satisfy_count',
        'satisfy_rate',
        'goods_img',
        'status',
    ];
    public function menucategory()
    {
        return $this->belongsTo(menu_category::class,'category_id','id');
    }

    //关联菜品和商家信息
    public function Shops()
    {
        return $this->belongsTo(shop::class,'shop_id','id');
    }
}
