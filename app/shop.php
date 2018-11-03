<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\shop_catagory;

class shop extends Model
{
    protected $fillable = ['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status','created_at','updated_at'];
    public function shop_category()
    {
        return $this->belongsTo(shop_catagory::class,'shop_category_id','id');
    }
}
