@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <a href="/home/products/create" class="btn btn-success">新增一筆產品資料</a>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>產品種別</th>
                <th>圖片</th>
                <th>抬頭</th>
                <th>排序</th>
                <th>說明內文</th>
                <th width="100"></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($all_products as $item)
                <tr>
                    <td>{{$item->product_type->type}}</td>
                    <td>
                        <img width="120" src="{{asset($item->img)}}" alt="">
                        {{-- <img width="120" src="{{asset('/storage/'.$item->img)}}" alt=""> --}}
                    </td>

                    <td>{{$item->title}}</td>
                    <td>{{$item->sort}}</td>
                    {{-- <td>{{$item->img}}</td> --}}
                    <td class="">{!!$item->content!!}</td>
                    <td>

                    <td>
                        <a href="/home/products/edit/{{$item->id}}" class="btn btn-success">修改</a>
                        <button class= "btn btn-danger btm-sm" onclick="show_confirm({{$item->id}})">刪除</button>

                        <form id="delete-form-{{$item->id}}" action="/home/products/delete/{{$item->id}}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection


@section('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
            $(document).ready(function() {
                $('#example').DataTable({"order": [1,'desc']});
            } );


            function show_confirm(id)
            {
                var r=confirm("是否確定刪除該筆資料嗎?");
                if (r==true)
                {
                    //使用者確認刪除訊息
                    document.getElementById('delete-form-'+id).submit();
                }
            }

    </script>

@endsection
