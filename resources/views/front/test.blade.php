@extends('layouts.nav')

@section('css')
<style>
    /* // using font awesome for the dots, FYI */
    $font-awesome: "Font Awesome 5 Free",
    serif;
    $dot-color: white;
    $dot-color-active: #5433FF;
    $dot-padding: .25rem;
    $transition: 200ms all linear;
    $height: 500px;

    body {
        margin: 0;
        overflow-x: hidden;
        background: #5433FF;
        background: -webkit-linear-gradient(to right, #A5FECB, #20BDFF, #5433FF);
        background: linear-gradient(to right, #A5FECB, #20BDFF, #5433FF);
    }

    .tabs {
        position: relative;
        height: $height;

        .tab-content {
            overflow: hidden;
            height: $height;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0;
            transition: $transition;

            &.active {
                opacity: 1;
            }
        }
    }

    .tabs.carousel {
        position: relative;
        text-align: center;

        .dots {
            position: absolute;
            width: 100%;
            bottom: 1rem;
            padding: $dot-padding;
            right: 0;
            left: 0;
            z-index: 100;
        }

        .tab {
            margin: 0 auto;
            border-bottom: none;
            padding: $dot-padding;
            min-width: auto;
            line-height: initial;
            text-decoration: none;
            color: $dot-color;
            transition: $transition;

            &:hover {
                border-bottom: none;
                color: $dot-color-active;
            }

            &[aria-selected="true"] {
                color: $dot-color-active;
            }
        }
    }

    .tabs.carousel.vertical {

        .dots {
            position: absolute;
            width: auto;
            right: 1rem;
            left: auto;

            a {
                display: block;
            }
        }
    }
</style>
@endsection

@section('content')


<section class="engine"><a href="">build a website for free</a></section>
<section class="cid-qTkA127IK8 mbr-fullscreen mbr-parallax-background" id="header2-1">

    <div class="container align-center">
        <div class="tabs carousel vertical">
            <div role="tablist" class="dots">
                <a id="tab-slide1" tabindex="0" role="tab" aria-label="slide1" class="tab active" aria-controls="slide1"
                    aria-selected="true" href="#slide1"><i class="fas fa-circle"></i></a>
                <a id="tab-slide2" tabindex="0" role="tab" aria-label="slide2" class="tab" aria-controls="slide2"
                    href="#slide2"><i class="fas fa-circle"></i></a>
                <a id="tab-slide3" tabindex="0" role="tab" aria-label="slide3" class="tab" aria-controls="slide3"
                    href="#slide3"><i class="fas fa-circle"></i></a>
            </div>
            <div id="slide1" class="tab-content active" aria-labelledby="tab-slide1" role="tabpanel">
                <img src="https://images.unsplash.com/photo-1579645625108-c4939763d9fe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2000&h=500&q=80"
                    alt="placeholder image">
            </div>
            <div id="slide2" class="tab-content" aria-labelledby="tab-slide2" role="tabpanel">
                <img src="https://images.unsplash.com/photo-1558254587-0a4bb2e1befd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2000&h=500&q=80"
                    alt="placeholder image">
            </div>
            <div id="slide3" class="tab-content" aria-labelledby="tab-slide3" role="tabpanel">
                <img src="https://images.unsplash.com/photo-1579645625700-f7bac7ac2f5a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2000&h=500&q=80"
                    alt="placeholder image">
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script>
    $(document).ready(function() {
  var index = 0;
  var $tabs = $("a.tab");

  $tabs.bind({
    // on keydown,
    // determine which tab to select
    keydown: function(ev) {
      var LEFT_ARROW = 37;
      var UP_ARROW = 38;
      var RIGHT_ARROW = 39;
      var DOWN_ARROW = 40;

      var k = ev.which || ev.keyCode;

      // if the key pressed was an arrow key
      if (k >= LEFT_ARROW && k <= DOWN_ARROW) {
        // move left one tab for left and up arrows
        if (k === LEFT_ARROW || k === UP_ARROW) {
          if (index > 0) {
            index--;
            // eslint-disable-next-line brace-style
          }
          // unless you are on the first tab,
          // in which case select the last tab.
          else {
            index = $tabs.length - 1;
          }
          // eslint-disable-next-line brace-style
        }

        // move right one tab for right and down arrows
        else if (k === RIGHT_ARROW || k === DOWN_ARROW) {
          if (index < $tabs.length - 1) {
            index++;
            // eslint-disable-next-line brace-style
          }
          // unless you're at the last tab,
          // in which case select the first one
          else {
            index = 0;
          }
        }

        // trigger a click event on the tab to move to
        $($tabs.get(index)).click();
        ev.preventDefault();
      }
    },

    // just make the clicked tab the selected one
    click: function(ev) {
      ev.stopImmediatePropagation();
      index = $.inArray(this, $tabs.get());
      setFocus();
      return false;
    }
  });

  var setFocus = function() {
    // undo tab control selected state,
    // and make them not selectable with the tab key
    // (all tabs)
    $tabs
      .attr({
        tabindex: "-1",
        "aria-selected": "false"
      })
      .removeClass("selected");

    // hide all tab panels.
    $(".tab-content").removeClass("active");

    // make the selected tab the selected one, shift focus to it
    $($tabs.get(index))
      .attr({
        tabindex: "0",
        "aria-selected": "true"
      })
      .addClass("active")
      .focus();

    // handle parent <li> current class (for coloring the tabs)
    $($tabs.get(index))
      .parent()
      .siblings()
      .removeClass("active");
    $($tabs.get(index))
      .parent()
      .addClass("active");

    // add a current class also to the tab panel
    // controlled by the clicked tab
    $($($tabs.get(index)).attr("href")).addClass("active");
  };

  // check hash and open relevant tab
  function openTab(hash) {
    window.scrollBy(0, -100);
    var $this = $("#" + hash);
    var $tabs = $("a.tab");
    if ($this.length !== 0 && $tabs.length !== 0) {
      $tabs
        .attr({
          tabindex: "-1",
          "aria-selected": "false"
        })
        .addClass("active");
      // hide all tab panels.
      var $tabContent = $(".tab-content");
      $tabContent.removeClass("active");
      // make the selected tab the selected one, shift focus to it
      $this.removeClass("active").focus();
      $this.attr({
        tabindex: "0",
        "aria-selected": "true"
      });
      var $thisIndex = $($tabs).index($this);
      $tabContent.eq($thisIndex).addClass("active");
    }
  }
});

</script>
@endsection
