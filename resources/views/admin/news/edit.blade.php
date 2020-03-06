@extends('layouts/app')

@section('content')
<div class="container">
    <h2>編輯最新消息</h2>
    <form method="post" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">現有主要圖片</label>
            {{-- 暴力 --}}
            <img width="250px" src="{{asset($news->img)}}" alt="" srcset="">

        </div>
        <div class="form-group">
            <label for="img">重新上傳主要圖片(建議圖片尺寸400 * 200px)</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <hr>
        {{-- <div class="row">
            現有多張圖片組
            @foreach ($news->news_imgs as $item)
            <div class="col-2">
                <div class="news_img_card" data-newsimgid="{{$item->id}}">
                    <button type="button" class="btn btn-danger" data-newsimgid="{{$item->id}}">X</button>
                    <img class="img-fluid" src="{{$item->img}}" alt="">
                    <input class="form-control" type="text" value="{{$item->sort}}">
                </div>
            </div>
            @endforeach
        </div> --}}
        <div class="form-group">
            <label for="title">新增多張圖片組(建議圖片尺寸寬400px x 高200px)</label>
            <input type="file" class="form-control" id="news_imgs" name="news_imgs[]"  multiple>
        </div>
        <hr>

        <div class="form-group">
            <label for="title">TITLE</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>
        <div class="form-group">
            <label for="sort">權重Sort</label>
            <input type="text" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
        </div>
        <div class="form-group">
            <label for="content">CONTENT</label>
            <input type="text" class="form-control" id="content" name='content' value="{{$news->content}}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
