<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{   
    //GET|HEAD | category 全分類列表
    public function index(){
        // $categorys = Category::tree();
        $categorys = (new Category)->tree();
        return view('admin/category/index')->with('data',$categorys);
    }

    public function changeOrder(){
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $res = $cate->update();
        if($res){
            $data = [
                'status' => 0,
                'msg' => '分类排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }
    

    //GET | admin/category/create 添加分類
    public function create(){
        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/add',compact('data'));
    }


    //POST | admin/category 添加分類提交
    public function store(){
        $input = Input::except('_token');
        $rules = [
            'cate_name'=>'required',
        ];

        $message = [
            'cate_name.required'=>'分類名稱不得為空!',
        ];

        $validator = Validator::make($input,$rules,$message);


        if($validator->passes()){
             $res = Category::create($input);
            if($res){
                return redirect('admin/category');
            }else{
                return back()->with('errors','數據填充失敗');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //GET|HEAD | category/{category}/edit
    public function edit($cate_id){
        $field = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
    }

    //PUT|PATCH | category/{category} 更新單個分類
    public function update($cate_id){
        $input = Input::except('_token','_method');
        $res = Category::where('cate_id',$cate_id)->update($input);
        if($res){
            return redirect('admin/category')->with('errors','數據修改成功');
            // return back()->with('errors','數據修改成功');
        }else{
            return back()->with('errors','數據填充失敗');
        }
    }

    //GET|HEAD | category/{category} 顯示單個分類訊息
    public function show(){

    }

    //DELETE | category/{category} 刪除單個分類
    public function destroy($cate_id){
        $res = Category::where('cate_id',$cate_id)->delete();
        //父級分類被刪除,該分類子文章pid皆修改為0
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if($res){
            $data = [
                'status' => 0,
                'msg' => '分类删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

}
