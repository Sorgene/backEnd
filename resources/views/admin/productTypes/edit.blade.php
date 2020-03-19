@extends('layouts/app')

@section('content')
<div class="container">
    <h2>產品類別修改頁面</h2>
    <form method="POST" action="/home/productTypes/update/{{$products_type->id}}">
        @csrf

        {{-- dd($products->id) --}}

        <div class="form-group">
            <label for="type">請輸入產品類別：</label>
            <input type="text" class="form-control" id="type" name="type" value="{{$products_type->type}}">
        </div>
        <div class="form-group">
            <label for="sort">權重：</label>
            <input type="number" min=0 class="form-control" id="sort" name="sort" value="{{$products_type->sort}}">
        </div>


        <button type="submit" class="btn btn-primary">送出</button>



    </form>
</div>
@endsection
