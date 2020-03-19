@extends('layouts.nav')


@section('content')

<section class="engine">
    <a href="https://mobirise.info/x">css templates</a></section>
<section class="features3 cid-rRF3umTBWU" id="features3-7" style="padding-top:100px">

    <div class="container">
        <div class="media-container-row ">
            <h2>標題 : {{$news->title}}</h2>


            <br>
            <p>多張圖片 :</p>
            <br>

            @foreach ($news ->news_imgs as $news_img)
            <div class="row">

                <div class="col-6">
                    <img width="120" src="{{$news_img->img_url}}" alt="">
                    {{-- <img width="120" src="{{asset('/storage/'.$item->img)}}" alt=""> --}}
                </div>

            </div>
            @endforeach
        </div>
</section>




@endsection
