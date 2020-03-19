@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<style>
    .new_img_card .btn-danger {
        position: absolute;
        top: 0px;
        right: 15px;
        border-radius: 50%;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1>產品管理-修改</h1>
    <hr>
    <br>
    <form method="POST" action="/home/products/update/{{$products->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">現有圖片</label>
            <img class="img-fluid" width="250" src="{{$products->img}}" alt="">
        </div>
        <div class="form-group">
            <label for="title">重新上傳圖片</label>
            <input type="file" min="0" class="form-control" id="img" name="img">
        </div>
        <hr>

        <div class="row">
            {{-- {{$products}}
            {{$products->products_imgs}} --}}

            現有多張圖片組
            @foreach ($products->products_imgs as $item)
            <div class="col-2">

                <div class="product_img_card" data-productsimgid="{{$item->id}}">
                    <button type='button' class="btn btn-danger" data-productsimgid="{{$item->id}}">X</button>
                    <img class="img-fluid" src="{{$item->img_url}}" alt="">
                    <input class="from-bontrol" type="text" value="{{$item->sort}}"
                        onchange="ajax_product_post_sort(this,{{$item->id}})">

                </div>
            </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="img">新增多張影像組：(建議圖片尺寸寬400px x 高200px)</label>
            <input type="file" class="form-control" id="img" name="products_imgs[]" multiple>
        </div>
        <hr>

        {{-- <div class="form-group">
            <label for="img">影像圖路徑：</label>
            <input type="text" class="form-control" id="img" name="img" value="{{$products->img}}">
        </div> --}}
        <div class="form-group">
            <label for="sort">資料排序：</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$products->sort}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">請輸入產品類別：</label>
            <select class="form-control" id="exampleFormControlSelect1"　name="type_id" >
                @foreach ($type as $item)
                    @if($item->id == $products->type_id)
                        <option selected="true" value={{$item->id}}>{{$item->type}}</option>
                    @else
                        <option value={{$item->id}}>{{$item->type}}</option>
                    @endif
                @endforeach
            </select>
          </div>

        <div class="form-group">
            <label for="title">請輸入抬頭：</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$products->title}}">
        </div>
        <div class="form-group">
            <label for="content">請輸入說明內文：</label>
            <textarea type="text" class="form-control summernote" name="content">{!!$products->content!!}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">送出</button>

    </form>
</div>
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="{{asset('js/summernote-zh-TW.js')}}"></script>

<script>
    $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    $('.product_img_card .btn-danger').click(function(){

        var productimgid = this.getAttribute('data-productsimgid')

        $.ajax({
            url: "/home/ajax_delete_products_imgs",    //來自web.php設定
            method: 'post',
            data: {
                products_imgid: productimgid,
            },
            success: function(result){
                $(`.product_img_card[data-productsimgid=${productimgid}]`).remove();
                console.log(result);
            }
        });
    });


    function ajax_product_post_sort(element,img_id){
        var img_id;
        var sort_value = element.value;

        $.ajax({
            url: "/home/ajax_product_post_sort",    //來自web.php設定
            method: 'post',
            data: {
                img_id: img_id,
                sort_value:sort_value
            },
            success: function(result){

                // console.log(result);
            }
        });
    }

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
