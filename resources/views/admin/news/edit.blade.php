@extends('layouts/app')

@section('content')
<div class="container">
<h2>編輯最新消息</h2>
<form method="post" action="/home/news/update/{{$news->id}}" >
    @csrf

    <div class="form-group">
      <label for="image">IMAGE</label>
      <input type="text" class="form-control" id="image" name="image" value="{{$news->image}}">

    </div>
    <div class="form-group">
      <label for="title">TITLE</label>
      <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
    </div>
    <div class="form-group">
        <label for="content">CONTENT</label>
        <input type="text" class="form-control" id="content" name='content' value="{{$news->content}}">
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
  @endsection

