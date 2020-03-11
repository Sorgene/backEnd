<?php

namespace App\Http\Controllers;

use App\News;
use App\NewsImgs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        // $file_name = $request->file('img')->store('', 'public');
        // $news_data['img'] = $file_name;

        // 暴力上傳 一張
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'News');
            $news_data['img'] = $path;
        }
        $news_id = News::create($news_data);

        // 多張
        // 從request中撈出 多筆照片的資料
        // 多張照片 要存的欄位 new_id img_url 拿一張存一張

        foreach ($request->new_imgs as $item) {
            $NewsImgs = new NewsImgs;
            $path = $this->fileUpload($item, 'News');
            $NewsImgs->new_id = $news_id->id;
            $NewsImgs->img_url = $path;
            $NewsImgs->save();
        }

        return redirect('/home/news');
    }


    public function edit($id)
    {
        $news = News::with('news_imgs')->find($id);
        return view('admin/news/edit', compact('news'));
    }


    public function update(Request $request, $id)
    {
        // $item 抓頁數ID=資料庫ID
        $item = News::find($id);
        // $request_data 抓網頁現有資料id、img、title、content
        $request_data = $request->all();


        //主要圖片上傳1.
        // if有上傳有上傳圖片新圖片，hasFile 如果有相同
        if ($request->hasFile('img')) {

            // 舊圖片刪除 File要先滑鼠右鍵選import class選擇Illuminate\Support\Facades\File，上面出現use
            $old_img = $item->img;
            File::delete(public_path() . $old_img);

            //上傳新圖片
            $file = $request->file("img"); //$file 抓新的網頁的img網址
            $path = $this->fileUpload($file, 'product'); //$path 轉換成可存取路徑，位置public/upload/product
            $request_data["img"] = $path; //$request_data["img"]替代成可存取路徑$path
            $item->update($request_data);
        }


        //多張圖片上傳
        // // 1.一張張叫出圖片
        // foreach ($request_data['news_imgs'] as $item) {


        //     //2. 回存資料庫 news_id img_url
        //     $news_imgs = new  NewsImgs;
        //     $file = $request->file['img'];
        //     dd($item);
        //     $path = $this->fileUpload($file, 'news');
        //     $request_data['img'] = $path;
        // }
        // News::find($id)->update($request->all());
        // $item->img = $request_data['img'];
        // $item->title = $request_data['title'];
        // $item->sort = $request_data['sort'];
        // $item->content = $request_data['content'];
        // $item->save();
        return redirect('home/news');
    }


    public function delete(Request $request, $id)
    {
        $item = News::find($id);

        $old_image = $item->img;

        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        $item->delete();
        return redirect('home/news');
    }



    //自寫函數
    private function fileUpload($file, $dir)
    {
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/')) {
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/' . $dir)) {
            mkdir('upload/' . $dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time() . md5(rand(100, 200))) . '.' . $extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path() . '/upload/' . $dir . '/' . $filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/' . $dir . '/' . $filename;
    }
}
