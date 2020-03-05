<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        // $all_news = DB::table('news')->get();
        $all_news = News::all();
        return view('admin/news/index', compact('all_news'));
    }

    public function create()
    {

        return view('admin/news/create');
    }


    public function store(Request $request)
    {
        $news_data = $request->all();

        //上傳檔案
        $file_name = $request->file('img')->store('', 'public');
        $news_data['img'] = $file_name;

        News::create($news_data);

        return redirect('/home/news');
    }


    public function edit($id)
    {
        $news = News::find($id);
        return view('admin/news/edit', compact('news'));
    }


    public function update(Request $request, $id)
    {
        $request_data = $request->all();
        $item = News::find(id);

        // if有上傳有上傳圖片新圖片
        if($request->hasFile('img')){

            // 舊圖片刪除
            $old_img = $item->img;
            fileDB::delete(public_path().$old_img);//.或+

            //上傳新圖片
            $file = $request->file('img');
            $path =$this->fileUpload($file, 'news');
            $request_data['img'] = $path;
        }
        News::find($id)->update($request->all());
        return redirect('home/news');
    }

    public function delete(Request $request, $id)
    {
        News::find($id)->delete();
        return redirect('home/news');
    }



//自寫函數
private function fileUpload($file,$dir){
    //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
    if( ! is_dir('upload/')){
        mkdir('upload/');
    }
    //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
    if ( ! is_dir('upload/'.$dir)) {
        mkdir('upload/'.$dir);
    }
    //取得檔案的副檔名
    $extension = $file->getClientOriginalExtension();
    //檔案名稱會被重新命名
    $filename = strval(time().md5(rand(100, 200))).'.'.$extension;
    //移動到指定路徑
    move_uploaded_file($file, public_path().'/upload/'.$dir.'/'.$filename);
    //回傳 資料庫儲存用的路徑格式
    return '/upload/'.$dir.'/'.$filename;
}





}

