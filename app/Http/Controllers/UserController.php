<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use APP\shop_catagory;

class UserController extends Controller
{
    public function create(){
        $shop_categories=shop_category::all();
        return view('user/create', compact('shop_categories'));
    }
    //保存管理员账号
    public function store(Request $request)
    {
        //数据验证
        $request->validate([
            'shop_category_id' => 'required',
            'shop_name' => 'required|max:20|unique:shops',
            'sho_img' => 'required',
            'brand' => 'required',
            'on_time' => 'required',
            'fengniao' => 'required',
            'bao' => 'required',
            'piao' => 'required',
            'zhun' => 'required',
            'start_send' => 'required',
            'send_cost' => 'required',
            'notice' => 'required',
            'discount' => 'required',

            'email' => 'required',


        ], [
            'shop_category_id.required' => '店铺所属类型必选',
            'shop_name.required' => '店铺名称必填',
            'shop_name.max' => '店铺名称最大不能超过20个字符',
            'shop_name.unique' => '店铺名称不能重复',
            'shop_img.required' => '店铺图片必须上传',
            'brand.required' => '是否是品牌店必选',
            'on_time.required' => '是否准时送达必选',
            'fengniao.required' => '是否蜂鸟配送必选',
            'bao.required' => '是否保标记必选',
            'piao.required' => '是否票标记必选',
            'zhun.required' => '是否准标记必选',
            'start_send.required' => '起送金额必填',
            'start_send.numeric' => '起送金额必须为数字',
            'send_cost.numeric' => '配送金额必须为数字',
            'send_cost.required' => '配送费必须填写',
            'notice.required' => '店公告必须填写',
            'notice.max' => '店公告最大字数不能超过200',
            'discount.max' => '店铺优惠信息最大字数不能超过200',
            'discount.required' => '店铺优惠信息必须填写',

        ]);


        //保存数据,确保两个表的添加都成功,事务
        DB::beginTransaction();
        try {
            dd($request->input());
            $shops = shop::create([
                'shop_category_id' => $request->shop_category_id,
                'shop_name' => $request->shop_name,
                'shop_img' => $request->shop_img,
                'shop_rating' => $request->shop_rating,
                'brand' => $request->brand,
                'on_time' => $request->on_time,
                'fengniao' => $request->fengniao,
                'bao' => $request->bao,
                'piao' => $request->piao,
                'zhun' => $request->zhun,
                'start_send' => $request->start_send,
                'send_cost' => $request->send_cost,
                'notice' => $request->notice,
                'discount' => $request->discount,
                'status' => 1,
            ]);


            $shop_id = $shops->id;

            $password = bcrypt($request->password);
            $shop_user = shop::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'status' => 1,
                'shop_id' => $shop_id,
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            //如果失败,跳转;
            return redirect()->route('shop_user.create')->with('success', '提交失败,请重新提交申请');
        }
    }
    public function reset(User $user)
    {
        //dd($user);
        return view('session/reset', compact('user'));
    }

    //重置密码后保存
    public function reset_save(User $user, Request $request)
    {
        //数据验证
        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => '密码必须输入'
        ]);

        $password = bcrypt($request->password);
        //修改保存
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => $password,
            ]);

        //修改成功,跳转
        return redirect()->route('user.index')->with('success', '重置密码成功');
    }
}
