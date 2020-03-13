@extends('layouts.nav')

@section('css')

<style>
    * {
        font-family: ProximaNova, sans-serif;
    }

    .button {
        padding: 10px 20px;
        width: 160px;
        min-height: 58px;
        height: 100%;
        font-size: 16px;
        line-height: 20px;
        color: #757575;
        text-align: center;
        border: 1px solid #eee;
        background-color: #fff;
    }

    .product_img {
        width: 100%;
    }

    .product_article {
        width: 606px;
        min-height: 500px;
        box-sizing: border-box;
        padding: 48px 48px 40px;
        margin-bottom: 60px;
        background: #fafafa;
    }

    .product_section {}

    .product_section .section_title {
        font-size: 40px;
    }

    .product_section .section_info {
        font-size: 20px;
        line-height: 24px;
        color: #757575;
    }

    .product_section .section_price {
        color: #ff6700;
        font-weight: 400;
    }



    .product_news {
        font-size: 20px;
        border-bottom: 1px solid #eee;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .product_capacity {
        margin-top: 20px;
        font-size: 20px;
        line-height: 24px;
        font-weight: 400;
        border-color: #ff6700;
    }

    .capacity_button .color.active {
        color: #424242;
        border-color: #ff6700;
        transition: opacity, border .2s linear;
    }

    .product_color {
        font-size: 20px;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .color_button .color.active {
        color: #424242;
        border-color: #ff6700;
        transition: opacity, border .2s linear;
    }

    .product_qty {
        font-size: 20px;

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
    }

    .product_total {}

    .product_submit {}
</style>
@endsection


@section('cart')
<div class="container">
    <div class="media-container-row" style="margin-top:80px">
        <div class="row">
            <div class="product_img col-6">



            </div>
            <div class="product_article col-6">
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
                        <div class="col-4 button color" data-capacity="4GB+64GB">
                            <div> 4GB+64GB</div>
                        </div>
                        <div class="col-4 button color" data-capacity="6GB+128GB">
                            <div> 6GB+128GB</div>
                        </div>
                    </div>
                </div>
                <div class="product_color">
                    <div class="color_title">
                        顏色
                    </div>
                    <div class="row color_button">
                        <div class="col-4 button color " data-color="冰翡翠">
                            <div>冰翡翠</div>
                        </div>
                        <div class="col-4 button color " data-color="珍珠白">
                            <div>珍珠白</div>
                        </div>
                        <div class="col-4 button color " data-color="電光灰">
                            <div>電光灰</div>
                        </div>
                        <div class="col-4 button color" data-color="深海藍">
                            <div>深海藍</div>
                        </div>
                    </div>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="product_qty">
                        <div class="qty_title">
                            數量
                        </div>
                        <div class="qty_button">
                            <div class="number">
                                <span class="minus">-</span>
                                <input id="qty" type="text" value="1" >
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
                    <input type="text" name="product_id" id="product_id">
                    <input type="text" name="color" id="color">
                    <input type="text" name="capacity" id="capacity">




                    <div class="product_submit">
                        <button>立即購買</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>


@endsection

@section('js')


<script>
 //改pproduct_article框顏色,加上active並移除其他的
$('.capacity_button .color').click(function () {
$('.capacity_button .color').removeClass('active');
$(this).addClass('active');
// 顏色 放入 input的 value中
// 獲取 get data attr value
var capacity = $(this).attr('data-capacity');
// 改變 input value chang
$('#capacity').val(capacity)
});

    //改product_color框顏色,加上active並移除其他的
$('.color_button .color').click(function () {
$('.color_button .color').removeClass('active');
$(this).addClass('active');
console.log($(this));
//顏色 放入 input的 value中
//獲取 get data attr value
var color = $(this).attr('data-color');
//改變 input value chang
$('#color').val(color)
});

//get input number plus minus value
$(function(){//和 $(document).ready()一樣 ，用意在DOM載入後執行ready()方法

var valueElement = $('#value');
function incrementValue(e){
    valueElement.text(Math.max(parseInt(valueElement.text()) + e.data.increment, 0));
    return false;
}

$('#plus').bind('click', {increment: 1}, incrementValue);

$('#minus').bind('click', {increment: -1}, incrementValue);

});



//計算機
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
