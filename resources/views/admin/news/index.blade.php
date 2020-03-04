@extends('layouts/app')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection


@section('content')
<form method="post" action="/home/news/store">
    @csrf
    <div class="container">
        <a href="/home/news/create" class="btn btn-success">新增最新消息</a>
        <hr>
        {{-- {{dd($all_news)}} --}}
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>img</th>
                    <th>title</th>
                    <th>sort</th>
                    <th>content</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_news as $item)
                @csrf
                <tr>
                    <td><img width="100px" src="{{asset('/storage/'.$item->img)}}" alt="" srcset="">
                        {{-- <img src="{{asset('/storage/'.$item->img)}}" alt="" > --}}
                    </td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->sort}}</td>
                    <td>{{$item->content}}</td>
                    <td>
                        <a href="/home/news/edit/{{$item->id}}" class="btn btn-success btn-sm">修改</a>
                        <a href="/home/news/delete/{{$item->id}}" class="btn btn-danger btn-sm">刪除</a>
                        {{-- <button class="btn btn-danger btn-sm">刪除</button> --}}
                    </td>

                </tr>
                @endforeach
        </table>
    </div>


</form>
</div>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({

    "order": [[ 2, 'desc' ]]
} );

    } );
</script>

@endsection
