<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SessionController extends Controller


{
    public function login()
    {
        return view('session/index');
    }

    //验证登录
    public function store(Request $request)
    {
        //判断合法性
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '请填写用户名',
            'password.required' => '请填写密码',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误'
        ]);
        //验证账号和密码是否正确
        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ], $request->remember)
        ) {
            //账号状态

            //信息状态
            $status2= DB::select("select * from users where name='{$request->name}' and status=0");

            //判断商家账号和商家信息有一个未审核通过就不能登录
            if ( $status2) {
                return back()->with('danger', '账号未启用或商家信息未审核通过,请耐心等待...');
            }
            return redirect()->route('menu.index')->with('success', '登录成功');
        }else{
            return back()->with('danger', '账号或者密码错误');
        }
    }

    //注销登录
    public function logout(){
        Auth::logout();
        //跳转
        return redirect()->route('login')->with('success','注销成功');
    }
    public function change(){

        return view('session/change');
    }
    //修改密码
    public function change_save(Request $request){
        //数据验证
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ],[
            'old_password.required'=>'必须输入旧密码',
            'password.required'=>'请设置新密码',
            'password.confirmed'=>'两次密码输入不一致,请重新输入',
        ]);


        if(Hash::check($request->old_password,auth()->user()->password)){
            //密码正确,跳转登录页面,重新登录
            //dd(6666);
            $new_password = bcrypt($request->password);
            $id = auth()->user()->id;
            User::where('id',$id)->update([
                'password'=>$new_password,
            ]);
            Auth::logout();
            //修改保存成功,跳转登录页面
            return redirect('session.login')->with('success','密码修改成功,请重新登录');
        }else{
            //旧密码输入不正确
            return redirect()->route('session.change')->with('danger','旧密码输入错误,请重新输入');
        }
    }
}
