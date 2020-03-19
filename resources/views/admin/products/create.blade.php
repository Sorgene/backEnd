@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <form method="POST" action="/home/products/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img">影像圖：</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <div class="form-group">
            <label for="img">多張影像圖路徑：</label>
            <input type="file" class="form-control" id="img" name="products_imgs[]" multiple>
        </div>
        {{-- <div class="form-group">
            <label for="sort">資料排序：</label>
            <input type="number" min=0 class="form-control" id="sort" name="sort" value="0">
        </div> --}}

        <div class="form-group">
            <label for="exampleFormControlSelect1">請輸入產品類別：</label>
            <select class="form-control" id="exampleFormControlSelect1"　name="type_id" >
                @foreach ($type as $item)
                    <option value={{$item->id}}>{{$item->type}}</option>
                @endforeach
            </select>
          </div>


        {{-- <div class="form-group">
            <label for="sort">資料排序權重：</label>
            <input type="number" min=0 class="form-control" id="sort" name="sort" value="0">
        </div> --}}
        <div class="form-group">
            <label for="title">請輸入抬頭：</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="content">請輸入說明內文：</label>
            <textarea type="text" class="form-control summernote" id="content" name="content"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">送出</button>

    </form>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="{{asset('js/summernote-zh-TW.js')}}"></script>     //加入中文

<script>
    $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $(document).ready(function() {
        $('.summernote').summernote({
            //height: 300,                 // set editor height
            minHeight: 300,             // set minimum height of editor
            lang: 'zh-TW',

            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete : function(target) {
                    $.delete(target[0].getAttribute("src"));
                }
            },
        });

        $.upload = function (file) {
            let out = new FormData();       //建立一個表單格式
            out.append('file', file, file.name);        //將單筆檔案放入表單格式中 append(欄位name, 檔案類型, 檔案名稱)

            $.ajax({
                method: 'POST',
                url: '/home/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('.summernote').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $.delete = function (file_link) {
            $.ajax({
                method: 'POST',
                url: '/home/ajax_delete_img',
                data: {file_link:file_link},
                success: function (img) {
                    console.log("delete:",img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }


    });
</script>
@endsection
