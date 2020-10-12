@if (sc_config('SITE_STATUS') == 'off')
    @include($templatePath . '.maintenance')
@else 

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta property="og:type" content="article">
    <meta property="og:title" content="Big Shop">
    <meta property="og:site_name" content="MyShop">
    <meta property="og:url" content="dungtran.local">
    <meta property="og:image" content="dungtran.local/data/product">
    <meta property="article:author" content="">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description??sc_store('description') }}">
    <meta name="keyword" content="{{ $keyword??sc_store('keyword') }}">
    <title>{{$title??sc_store('title')}}</title>
    <link rel="icon" href="{{ asset(sc_store('logo')) }}" type="image/png" sizes="16x16">
    <meta property="og:image" content="{{ !empty($og_image)?asset($og_image):asset('images/org.jpg') }}" />
    <meta property="og:url" content="{{ \Request::fullUrl() }}" />
    <meta property="og:type" content="Website" />
    <meta property="og:title" content="{{ $title??sc_store('title') }}" />
    <meta property="og:description" content="{{ $description??sc_store('description') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="fb:app_id" content="2795729107324348" />
    <meta property="fb:admins" content="AN8ARcwjcqQyw0joMKYclkd"/>

    <!-- css default for item s-cart -->
    @include($templatePath.'.common.css')
    <!--//end css defaut -->

    <!--Module meta -->
    @isset ($blocksContent['meta'])
    @foreach ( $blocksContent['meta'] as $layout)
    @php
    $arrPage = explode(',', $layout->page)
    @endphp
    @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
    @if ($layout->type =='html')
    {!! $layout->text !!}
    @endif
    @endif
    @endforeach
    @endisset
    <!--//Module meta -->
    <!-- css default for item s-cart -->
    <!--//end css defaut -->

    <link href="//fonts.googleapis.com/css?family=Roboto:300,400|Rufina:700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset($templateFile.'/lib/bootstrap/css/bootstrap.min.css')}}" />
    <!-- <link rel="stylesheet" href="//cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" > -->
    <link rel="stylesheet" href="{{ asset($templateFile.'/lib/slick/slick-theme.css')}}" />
    <link rel="stylesheet" href="{{ asset($templateFile.'/lib/slick/slick.css')}}">
    <link rel="stylesheet" href="{{ asset($templateFile.'/lib/css/animate.css')}}">
    <link rel="stylesheet"
        href="{{ asset($templateFile.'/css/main.css')}}?v={{ filemtime(public_path($templateFile.'/css/main.css')) }}" />
    <link rel="stylesheet"
        href="{{ asset($templateFile.'/css/main-rtl.css')}}?v={{ filemtime(public_path($templateFile.'/css/main-rtl.css')) }}" />
    @stack('styles')
<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
          });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="115075797023073"
        theme_color="#20cef5">
      </div>
    @include($templatePath.'.header')

    <!--Module banner -->
    @isset ($blocksContent['banner_top'])
    @foreach ( $blocksContent['banner_top'] as $layout)
    @php
    $arrPage = explode(',', $layout->page)
    @endphp
    @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
    @if ($layout->type =='html')
    {!! $layout->text !!}
    @elseif($layout->type =='view')
    @if (view()->exists($templatePath.'.block.'.$layout->text))
    @include($templatePath.'.block.'.$layout->text)
    @endif
    @endif
    @endif
    @endforeach
    @endisset
    <!--//Module banner -->


    <!--Module top -->
    @isset ($blocksContent['top'])
    @foreach ( $blocksContent['top'] as $layout)
    @php
    $arrPage = explode(',', $layout->page)
    @endphp
    @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
    @if ($layout->type =='html')
    {!! $layout->text !!}
    @elseif($layout->type =='view')
    @if (view()->exists($templatePath.'.block.'.$layout->text))
    @include($templatePath.'.block.'.$layout->text)
    @endif
    @endif
    @endif
    @endforeach
    @endisset
    <!--//Module top -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12" id="breadcrumb">
                    <!--breadcrumb-->
                    @yield('breadcrumb')
                    <!--//breadcrumb-->

                    <!--fillter-->
                    @yield('filter')
                    <!--//fillter-->
                </div>

                <!--Notice -->
                @include($templatePath.'.common.notice')
                <!--//Notice -->

                <!--body-->
                @section('main')
                @include($templatePath.'.left')
                @include($templatePath.'.center')
                @include($templatePath.'.right')
                @show
                <!--//body-->

            </div>
        </div>
    </section>

    @include($templatePath.'.footer')
    <script src="{{ asset($templateFile.'/lib/js/jquery.js')}}"></script>
    <script src="{{ asset($templateFile.'/lib/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset($templateFile.'/lib/js/jquery.scrollUp.min.js')}}"></script>
    <!-- js default for item s-cart -->
    @include($templatePath.'.common.js')
    <!--//end js defaut -->
    {{-- <script src="{{ asset($templateFile.'/lib/js/popper.min.js')}}"></script> --}}
    <script src="{{ asset($templateFile.'/lib/bootstrap/js/bootstrap.min.js')}}">
    </script>
    <script src="{{ asset($templateFile.'/lib/slick/slick.min.js')}}"></script>
    <script src="{{ asset($templateFile.'/js/main.js')}}?v={{ filemtime($templateFile.'/js/main.js') }}"></script>

    <!--Module bottom -->
    @isset ($blocksContent['bottom'])
    @foreach ( $blocksContent['bottom'] as $layout)
    @php
    $arrPage = explode(',', $layout->page)
    @endphp
    @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
    @if ($layout->type =='html')
    {!! $layout->text !!}
    @elseif($layout->type =='view')
    @if (view()->exists($templatePath.'.block.'.$layout->text))
    @include($templatePath.'.block.'.$layout->text)
    @endif
    @endif
    @endif
    @endforeach
    @endisset
    <!--//Module bottom -->
    @stack('scripts')

    <div id="sc-loading">
        <div class="sc-overlay"><i class="fa fa-spinner fa-pulse fa-5x fa-fw "></i></div>
    </div>
    
</body>

</html>
@endif