@extends('layouts/app')

@section('content')
<div class="container">
    <h2>編輯最新消息</h2>
    <form method="post" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">現有圖片</label>
            {{-- 非暴力 --}}
            <img width="250px" src="{{asset('/storage/'.$news->img)}}" alt="" srcset="">
             {{-- 暴力 --}}
            {{-- <img width="250px" src="{{asset($new->img)}}" alt="" srcset=""> --}}

        </div>
        <div class="form-group">
            <label for="img">重新上傳圖片(建議圖片尺寸400 * 200px)</label>
            <input type="file" class="form-control" id="img" name="img" value="{{$news->img}}" >
        </div>
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
