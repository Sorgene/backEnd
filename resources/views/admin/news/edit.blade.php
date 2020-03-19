@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2>編輯最新消息</h2>
    <form method="post" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">現有主要圖片</label>
            {{-- 暴力 --}}
            <img width="250px" src="{{asset($news->img)}}" alt="" srcset="">

        </div>

        <div class="form-group">
            <label for="img">重新上傳主要圖片(建議圖片尺寸400 * 200px)</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <hr>


        <div class="row">
            現有多張圖片組
            @foreach ($news->news_imgs as $item)
            <div class="col-2">
                <div class="news_img_card" data-newsimgid="{{$item->id}}">
                    <button type="button" class="btn btn-danger" data-newsimgid="{{$item->id}}">X</button>
                    <img class="img-fluid" src="{{$item->img_url}}" alt="">
                    <input class="form-control" type="text" value="{{$item->sort}}"
                        onchange="ajax_post_sort(this,{{$item->id}})">>
                </div>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="title">新增多張圖片組(建議圖片尺寸寬400px x 高200px)</label>
            <input type="file" class="form-control" id="news_imgs" name="news_imgs[]" multiple>
        </div>
        <hr>

        <div class="form-group">
            <label for="title">標題</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>
        <div class="form-group">
            <label for="sort">權重(數字大的排前面)</label>
            <input type="text" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
        </div>
        <div class="form-group">
            <label for="content">內容</label>
            <textarea type="text" class="form-control" id="content" name='content'
                value="{!!$news->content!!}"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">送出</button>
    </form>
</div>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.news_img_card .btn-danger').click(function(){
        var newsimgid = this.getAttribute('data-newsimgid')
        // $(this).parent().parent().hide();

        $.ajax({
            url: "/home/ajax_delete_news_imgs", //來自web.php設定
            method: 'post',
            data: {
            newsimgid: newsimgid,//自訂變數 :
            },
            success: function(result){
                $(`.news_img_card`).prepend(`
                    ${result}
                `)
                $(`.news_img_card[data-newsimgid=${newsimgid}]`).remove();
            }
        });
    });

    function ajax_post_sort(element,img_id) {
        var img_id;
        var sort_value = element.value;

        $.ajax({
            url: "/home/ajax_post_sort",
            method: 'post',
            data: {
                news_id: img_id,
                sort_value: sort_value
            },
            success: function(result){
            }
        });
    }
    $(document).ready(function() {

        $('#content').summernote({
            minHeightt:200,
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


        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.upload = function (file) {
            let out = new FormData(); //建立一個表單格式
            out.append('file', file, file.name); //將單筆檔案放入表單格式中 append(欄位name, 檔案類型, 檔案名稱)

            $.ajax({
                method: 'POST',
                url: '/home/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#content').summernote('insertImage', img); //針對你上傳圖片的summertnote執行插入圖片的事件
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });

        };

        $.delete = function (file_link) {

            $.ajax({
                method: 'POST',
                url: '/admin/ajax_delete_img',
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
