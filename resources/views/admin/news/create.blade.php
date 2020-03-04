@extends('layouts/app')

@section('content')
<div class="container">
<h2>新增最新消息</h2>
<form method="post" action="/home/news/store" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label for="img">IMG</label>
      <input type="file" class="form-control" id="img" name="img">

    </div>
    <div class="form-group">
      <label for="title">TITLE</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="sort">SORT</label>
        <input type="nnumber" class="form-control" id="sort" name="sort" >
    </div>
    <div class="form-group">
        <label for="content">CONTENT</label>
        <input type="text" class="form-control" id="content" name='content'>
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  @endsection
</div>
