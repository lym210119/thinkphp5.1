<?php

namespace app\user\controller;

use think\Controller;
use think\Request;
use think\facade\Session as UserSession;

use app\user\model\User;

class Session extends Controller
{
    // protected $middleware 则是初始化一个中间件,而 except 方法表示,当前控制器下有哪些方法是不使用中间件的.
    protected $middleware = [
        'UserAuthorize' => [
            'except' => ['create', 'save']
        ]
    ];

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
        return $this->fetch();
        // if (UserSession::has('user')) {
        //     $user = UserSession::get('user');
        //     return redirect('user/auth/read')->params(['id' => $user->id]);
        // } else {
        //     //这一步的目的是将自定义 CSRF Token 传入模板当中.
        //     $token = $this->request->token('__token__', 'sha1');
        //     $this->assign('token', $token); // assign()为视图引擎分配一个模板变量
        //     return $this->fetch(); // 加载模板输出

        // }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $result = $this->validate($request->post(), 'app\user\validate\Session');
        if (true !== $result) {
            return redirect('user/session/create')->with('validate', $result);
        } else {
            $user = User::where('email', $request->email)->find();
            if ($user !== null && password_verify($request->password, $user->password)) {    // password_verify(请求数据, 待验证的数据)
                UserSession::set('user', $user);
                return redirect('user/auth/read')->params(['id' => $user->id]);
            } else {
                return redirect('user/session/create')->with('validate', '邮件地址不存在或密码错误');
            }
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
        //
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
        // 删除（当前作用域）
        session('user', null);
        return redirect('user/session/create')->with('validate', '您已退出');
        // dump($id);
        // if (UserSession::has('user') && $id == UserSession::get('user.id')) {
        //     UserSession::delete('user');
        //     return redirect('user/session/create')->with('validate', '您已退出');
        // } else {
        //     return '非法请求';
        // }
    }
}