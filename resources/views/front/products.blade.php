@extends('layouts/nav')
@section('content')
    {{-- <section class="mbr-gallery mbr-slider-carousel cid-rS3hYJJSXz" id="gallery2-3">
        <div class="container pt-5">
            <div>
                <!-- Filter -->
                <div class="mbr-gallery-filter container gallery-filter-active">
                    <ul buttons="0">
                        <li class="mbr-gallery-filter-all"><a class="btn btn-md btn-primary-outline active display-7"
                                href="">All</a></li>
                    </ul>
                </div><!-- Gallery -->
                <div class="mbr-gallery-row">
                    <div class="mbr-gallery-layout-default">
                        <div>
                            <div>

                                @foreach($products_data as $item)
                                <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false"
                                    data-tags="{{$item->datatags}}">
                                    <div href="{{$item->urlpath}}" data-slide-to="0" data-toggle="modal"><img
                                            src="{{$item->img}}" alt="" title=""><span
                                            class="icon-focus"></span></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div><!-- Lightbox -->

            </div>
        </div>

    </section> --}}

    <section class="services1 cid-rSHipPxh3m" id="services1-5">
        <!---->

        <!---->
        <!--Overlay-->

        <!--Container-->
        <div class="container>
            <div class="row justify-content-center">
                <!--Titles-->
                <div class="title pb-5 col-12">
                    <h2 class="align-left pb-3 mbr-fonts-style display-1">
                        Our Shop
                    </h2>

                </div>
                <!--Card-1-->

                @foreach($products_data as $item)
                    <div class="card col-12 col-md-6 p-3 col-lg-4">
                        <div class="card-wrapper">
                            <div class="card-img">
                                <img src="{{$item->img}}" alt="Mobirise">
                            </div>
                            <div class="card-box">
                                <h4 class="card-title mbr-fonts-style display-5">
                                    {{$item->title}}
                                </h4>
                                <p class="mbr-text mbr-fonts-style display-7">
                                    {!!$item->content!!}
                                </p>
                                <!--Btn-->
                                <div class="mbr-section-btn align-left">
                                    <a href="https://mobirise.co" class="btn btn-warning-outline display-4">
                                        {{-- {{$item->product_type->$type_id}} --}} 990
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


@endsection
