<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    //显示登录页面
    public function create()
    {
        return view('sessions.create');
    }

    //验证用户登陆信息并登陆
    public function store(Request $request)
    {
       $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       ]);

       if (Auth::attempt($credentials,$request->has('remember'))) {
           // 登录成功后的相关操作
            session()->flash('success', '欢迎回来！');
            // return redirect()->route('users.show', [Auth::user()]);
            //当一个未登录的用户尝试访问自己的资料编辑页面时，将会自动跳转到登录页面，这时候如果用户再进行登录，则会重定向到其个人中心页面上，这种方式的用户体验并不好。更好的做法是，将用户重定向到他之前尝试访问的页面，即自己的个人编辑页面
            $fallback = route('users.show', Auth::user());
            return redirect()->intended($fallback);
       } else {
           // 登录失败后的相关操作
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
       }
    }

    //退出
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
