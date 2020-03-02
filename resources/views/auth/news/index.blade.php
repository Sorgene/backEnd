@extends('layouts/app')

@section('content')
<form method="post" action="/home/news/store" >
    @csrf
    <div class="container">
    <div class="form-group">
      <label for="image">IMAGE</label>
      <input type="text" class="form-control" id="image" name="image">

    </div>
    <div class="form-group">
      <label for="title">TITLE</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="content">CONTENT</label>
        <input type="text" class="form-control" id="content" name='content'>
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
  @endsection
