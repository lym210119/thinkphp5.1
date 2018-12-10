<?php
namespace app\index\controller;

class Index
{
    public function home()
    {
        return view('index@index/home');
    }
    public function about()
    {
        return view('index@index/about');
    }
    public function help()
    {
        return view('index@index/help');
    }
}
