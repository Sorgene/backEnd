@extends('layouts/app')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection


@section('content')
<form method="post" action="/home/news/store" >
    @csrf
    <div class="container">
        <a href="/home/news/create" class="btn btn-success">新增最新消息</a>
        <hr>
        {{-- {{dd($all_news)}} --}}
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>image</th>
                    <th>title</th>
                    <th>content</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_news as $item)
                <tr>
                    <td>{{$item->image}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->content}}</td>
                    <td>
                        <a href="/home/news/edit/{{$item->id}}" class="btn btn-success">修改</a>
                        <button class="btn btn-danger">刪除</button>
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
        $('#example').DataTable();
    } );
    </script>

  @endsection
