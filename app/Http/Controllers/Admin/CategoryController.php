<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{   
    //GET|HEAD | category 全分類列表
    public function index(){
        // $categorys = Category::tree();
        $categorys = (new Category)->tree();
        return view('admin.category.index')->with('data',$categorys);
    }

    
    //POST | category
    public function store(){

    }

    //GET|HEAD | category/create 添加分類
    public function create(){

    }

    //GET|HEAD | category/{category} 顯示單個分類訊息
    public function show(){

    }

    //PUT|PATCH | category/{category} 更新單個分類
    public function update(){

    }

    //DELETE | category/{category} 刪除單個分類
    public function destroy(){

    }

    //GET|HEAD | category/{category}/edit
    public function edit(){

    }
}
