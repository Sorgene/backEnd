@extends('layouts.nav')

@section('css')
<style>
    span {
        cursor: pointer;
    }

    .number {
        margin: 100px;
    }

    .minus,
    .plus {
        width: 20px;
        height: 20px;
        background: #f2f2f2;
        border-radius: 4px;
        padding: 8px 5px 8px 5px;
        border: 1px solid #ddd;
        display: inline-block;
        vertical-align: middle;
        text-align: center;
    }

    input {
        height: 34px;
        width: 100px;
        text-align: center;
        font-size: 26px;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: inline-block;
        vertical-align: middle;
    }
</style>
@endsection


@section('cart')
<div class="container">
    <div class="media-container-row" style="margin-top:80px">
        <div class="row w-100">
            <div class="product_img" class="col-6">



            </div>
            <div class="product_article" class="col-6">
                <div class="product_section">
                    <div class="section_title">
                        <h1>Redmi Note 8 Pro</h1>
                    </div>
                    <div class="section_info">
                        <span>6GB+128GB</span>, <span>冰翡翠</span>
                    </div>
                    <div class="section_price">
                        <span>NT$7,599</span>
                    </div>
                </div>
                <div class="product_news">
                    <img src="" alt="">雙倍
                    <span>該商品可享受雙倍積分</span>

                </div>
                <div class="product_capacity">
                    <div class="capacity_title">
                        容量
                    </div>
                    <div class="capacity_button">
                        <div class="col-4">6GB+64GB</div>
                        <div class="col-4">6GB+128GB</div>
                    </div>
                </div>
                <div class="product_color">
                    <div class="color_title">
                        顏色
                    </div>
                    <div class="row color_button">
                        <div class="col-4">冰翡翠</div>
                        <div class="col-4">珍珠白</div>
                        <div class="col-4">電光灰</div>
                        <div class="col-4">深海藍</div>
                    </div>
                </div>
                <div class="product_qty">
                    <div class="qty_title">
                        數量
                    </div>
                    <div class="qty_button">
                        <div class="number">
                            <span class="minus">-</span>
                            <input type="text" value="1" />
                            <span class="plus">+</span>
                        </div>
                    </div>
                </div>
                <div class="product_total">
                    <div class="total_title">

                    </div>
                    <div class="total_button">
                        <span>Redmi Note 8 Pro</span>
                        <span>冰翡翠</span>
                        <span>6GB</span>+<span>64GB</span>*<span>1</span>
                        <span>NT$6,599 </span>
                        <span>總計：</span>
                        <span>NT$6,599</span>
                    </div>
                </div>
                <div class="product_submit">
                    <button>立即購買</button>
                </div>


            </div>


        </div>





    </div>
</div>
</section>


@endsection

@section('js')
<script>
    $(document).ready(function() {
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});
</script>


@endsection
