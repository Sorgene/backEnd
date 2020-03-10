@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2>新增最新消息</h2>
    <form method="post" action="/home/news/store" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">主要圖片上傳</label>
            <input type="file" class="form-control" id="img" name="img" required>
        </div>
        <div class="form-group">
            <label for="img">多張圖片上傳</label>
            <input type="file" class="form-control" id="img" name="new_imgs[]" required multiple>
        </div>
        <div class="form-group">
            <label for="title">標題</label>
            <input type="text" class="form-control" id="title" name="title" 　required>
        </div>

        <div class="form-group">
            <label for="content">內容</label>
            <textarea type="text" class="form-control" id="content" name='content' 　required></textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
    $('#content').summernote();
    });
</script>
@endsection
