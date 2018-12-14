<?php

namespace app\user\controller;

use think\Controller;
use think\Request;
use app\user\model\User;

class Auth extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $token = $this->request->token('__token__', 'sha1');
        $this->assign('token', $token);
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $requestData = $request->post();
        // validate($requestData, 'app\user\validate\Auth') 的前部分表示传入的值,后半部分表示要使用的验证器.
        $result = $this->validate($requestData, 'app\user\validate\Auth');
        if (true !== $result) {
            // redirect('user/auth/create') 是跳转到对应的 控制器/方法
            // with('validate',$result) 则是 redirect 提供的一个快捷 flash 闪存 的方法,与 Session::flash('validate',$result); 效果一样.
            return redirect('user/auth/create')->with('validate',$result);
        } else {
            $user = User::create($requestData);
            return redirect('user/auth/read')->params(['id' => $user->id]); 
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $user = User::find($id); // User::find($id) 是模型的一个查询语法,默认查询 $id(主键值)
        $this->assign('user', $user);
        return $this->fetch();
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
