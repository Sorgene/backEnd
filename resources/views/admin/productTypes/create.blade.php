@extends('layouts/app')

@section('content')
<div class="container">
    <form method="POST" action="/home/productTypes/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="type">請輸入產品類別：</label>
            <input type="text" class="form-control" id="type" name="type">
        </div>
        <div class="form-group">
            <label for="sort">權重：</label>
            <input type="number" min=0 class="form-control" id="sort" name="sort">
        </div>
        {{-- <div class="form-group">
            <label for="title">請輸入超連結路徑：</label>
            <input type="text" class="form-control" id="urlpath" name="urlpath">
        </div> --}}


        <button type="submit" class="btn btn-primary">送出</button>



    </form>
</div>
@endsection
