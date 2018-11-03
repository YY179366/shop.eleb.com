<?php

namespace App\Http\Controllers;

use App\menu;
use App\menu_category;
use App\menucategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\shop;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{

    Public function __construct()
    {

        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }
    public function index(Request $request)
    {

        $menucategories =menu_category::all();
        $id = $_GET['keyword']??'';
        $name = $_GET['name']??'';
        $max = $_GET['max_price']??'';
        $min = $_GET['min_price']??'';
        //判断是否根据类型查找
        if($id){
            //判断根据类型查询后,根据名字模糊查询
            if($name != null){
                //根据名字后,再根据金额
                if($max != null && $min != null){
                    $menus = Menu::where('goods_name','like',"%{$name}%")
                        ->where('category_id',$id)
                        ->where('goods_price','<',$max)
                        ->where('goods_price','>',$min)
                        ->paginate(5);
                }else{
                    $menus = Menu::where('goods_name','like',"%{$name}%")
                        ->where('category_id',$id)
                        ->paginate(5);
                }
                //根据金额查找
            }elseif ($max != null && $min != null){
                $menus = Menu::where('goods_name','like',"%{$name}%")
                    ->where('category_id',$id)
                    ->where('goods_price','<',$max)
                    ->where('goods_price','>',$min)
                    ->paginate(5);
                //不根据名字,也不根据金额
            }else{
                //echo 111;
                $menus = Menu::where('category_id',$id)->paginate(5);
            }
        }elseif ($name){
            //echo 222;
            $menus = Menu::where('goods_name','like',"%{$name}%")->paginate(5);
        }elseif ($max != null && $min != null){
            // echo 333;
            $menus = Menu::where('goods_price','>',$min)
                ->where('goods_price','<',$max)
                ->paginate(1);
        }else{
            // echo 444;
            $menus = Menu::paginate(5);
        };
        return view('menu/index',['menucategories'=>$menucategories,'menus'=>$menus,'id'=>$id]);


    }
    public function create()
    {

        $menucategorys = menu_category::all();
        $shops=shop::all();
        return view('menu/create', compact('menucategorys','shops'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required',
            'description'=>'required',
            'goods_price'=>'required',
            'category_id'=>'required',
            'tips'=>'required',
            'goods_img'=>'required'
        ],[
            'goods_name.required'=>'菜品名称不能为空',
            'description.required'=>'菜品描述不能为空',
            'goods_price.required'=>'菜品价格不能为空',
            'tips.required'=>'提示信息不能为空',
            'category_id.required'=>'菜品分类不能为空',
            'goods_img.required'=>'菜品图片不能为空'
        ]);

        menu::create([
            'goods_name'=>$request->goods_name,
            'description'=>$request->description,
            'goods_price'=>$request->goods_price,
            'tips'=>$request->tips,
            'status'=>$request->status,
            'rating'=>5,
            'shop_id'=>$request->shop_id,
            'category_id'=>$request->category_id,
            'month_sales'=>0,
            'rating_count'=>0,
            'satisfy_count'=>0,
            'satisfy_rate'=>0,
            'goods_img'=>$request->goods_img,

        ]);
        session()->flash('success', '添加菜品成功');
        return redirect()->route('menu.index');
    }
    public function edit(menu $menu)
    {
        $menucategorys =menu_category::all();
        $shops=shop::all();
        return view('Menu/edit',compact('menu','menucategorys','shops'));
    }
    public function update(menu $menu,Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required',
            'description'=>'required',
            'goods_price'=>'required',
            'category_id'=>'required',
            'tips'=>'required',
        ],[
            'goods_name.required'=>'菜品名称不能为空',
            'description.required'=>'菜品描述不能为空',
            'goods_price.required'=>'菜品价格不能为空',
            'tips.required'=>'提示信息不能为空',
            'category_id.required'=>'菜品分类不能为空',
        ]);
        $path= $request->file('goods_img')->store('public/menu');
        $menu->update([
            'goods_name'=>$request->goods_name,
            'description'=>$request->description,
            'goods_price'=>$request->goods_price,
            'tips'=>$request->tips,
            'category_id'=>$request->category_id,
            'goods_img'=>$path,
        ]);
        session()->flash('success', '修改菜品成功');
        return redirect()->route('menu.index');
    }
    public function destroy(menu $menu)
    {
        $menu->delete();
        session()->flash('success', '删除菜品成功');
        return redirect()->route('menu.index');
    }
    public function show(menu $menu)
    {
        $user = Auth::user()->name;
        return view('Menu/show',compact('menu','user'));
    }
    public function upload(Request $request)
    {
        $path = $request->file('file')->store('public/img');
        return ['path'=>Storage::url($path)];
    }
}
