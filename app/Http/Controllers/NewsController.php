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

        // 上傳主要圖片單張
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'News');
            $news_data['img'] = $path;
        }

        //create 多張
        // 從request中撈出 多筆照片的資料
        // 多張照片 要存的欄位 new_id img_url 拿一張存一張
        $news_id = News::create($news_data);

        if ($request->hasFile('news_imgs')) { //news_img 來自view/news/create.blade.php name="news_img[]"

            $files = $request->file('news_imgs');
            foreach ($files as $item) {
                //上傳圖片
                $path = $this->fileUpload($item, 'News');
                //建立Newe多張圖檔
                $NewsImgs = new NewsImgs;
                $NewsImgs->news_id = $news_id->id;
                $NewsImgs->img_url = $path;
                $NewsImgs->save();
            }
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
        //法一
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();

        //法二
        // $item 抓頁數ID=資料庫ID
        $item = News::find($id);
        // $request_data 抓網頁現有資料id、img、title、content
        $request_data = $request->all();

        //主要圖片上傳
        // if有上傳有上傳圖片新圖片，hasFile 如果有相同
        if ($request->hasFile('img')) {
            // 舊圖片刪除 File要先滑鼠右鍵選import class選擇Illuminate\Support\Facades\File，上面出現use
            $old_img = $item->img;
            File::delete(public_path() . $old_img);

            //上傳新圖片
            $file = $request->file("img"); //$file 抓新的網頁的img網址
            $path = $this->fileUpload($file, 'news'); //$path 轉換成可存取路徑，位置public/upload/product
            $request_data["img"] = $path; //$request_data["img"]替代成可存取路徑$path
            $item->update($request_data);
        }
        //update 多張圖片
        if ($request->hasFile('news_imgs')) {
            $files = $request->file('news_imgs');
            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file, 'news');

                //建立News多張圖片的資料
                $news_imgs = new NewsImgs;
                $news_imgs->news_id = $item->id; //找到使用這些圖片的news id
                $news_imgs->img = $path;
                $news_imgs->save();
            }
        }

        $item->update($request_data);

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
        //多圖片刪除

        $news_imgs = NewsImgs::where('news_id', $id)->get();

        foreach ($news_imgs as $news_img) {
            $old_image = $news_img->img;
            if (file_exists(public_path() . $old_image)) {
                File::delete(public_path() . $old_image);
            }

            $news_img->delete();
        }

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
    public function ajax_delete_news_imgs(Request $request)
    {
        $newsimgid = $request->newsimgid;

        $item = NewsImgs::find($newsimgid);//多張圖方法(model:NewsImgs)中的id
        $old_image = $item->img_url;

        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }

        $item->delete();

        return 'ajax success:'.$newsimgid;
    }

    public function ajax_post_sort(Request $request)
    {
        $news_img_id = $request->news_id;

        $sort = $request->sort_value;

        $img = NewsImgs::find($news_img_id);

        $img->sort = $sort;

        $img->save();

        return "Success!";

    }

}
