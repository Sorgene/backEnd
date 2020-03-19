@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection


@section('content')
<div class="container">
    <a href="/home/news/create" class="btn btn-success">"新增"最新消息</a>
    <hr>
    {{-- {{dd($all_news)}} --}}
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>圖片</th>
                <th>標題</th>
                <th>權重</th>
                <th>內容</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_news as $item)
            <tr>
                <td><img width="100px" src="{{asset($item->img)}}" alt="" srcset="">
                    {{-- <img src="{{asset('/storage/'.$item->img)}}" alt="" > --}}
                </td>
                <td>{{$item->title}}</td>
                <td>{{$item->sort}}</td>
                <td>{{$item->content}}</td>
                <td>
                    <a href="/home/news/edit/{{$item->id}}" class="btn btn-success btn-sm">修改</a>
                    {{-- <a href="/home/news/delete/{{$item->id}}" class="btn btn-danger btn-sm">刪除</a> --}}

                    <button class="btn btn-danger btn-sm" onclick="show_confirm({{$item->id}})">刪除</button>
                    <form id="delete-form-{{$item->id}}" action="/home/news/delete/{{$item->id}}" method="POST" style="display: none;">
                        @csrf</form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    function show_confirm(id) {
        console.log(id);

        var d = confirm("是否確定刪除??");
        if(d == true){
            //點擊確認刪除後送出
            document.getElementById('delete-form-'+id).submit();
            // document.getElementById(`delete-form-${id}`).submit();
        }
    }
    $('.summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            // maxHeight: null,             // set maximum height of editor
            // focus: true                  // set focus to editable area after initializing summernote
        });

</script>

@endsection
