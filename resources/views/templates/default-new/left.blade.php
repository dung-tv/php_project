<!--main left-->
<div class="col-12 col-sm-12 col-md-3  col-left">
  @section('left')
  <div class="left-sidebar">
    <!--Module left -->
    @isset ($blocksContent['left'])
    @foreach ( $blocksContent['left'] as $layout)
    @php
    $arrPage = explode(',', $layout->page);
    @endphp
    @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
    @if ($layout->type =='html')
    {!! $layout->text !!}
    @elseif($layout->type =='view')
    @if (view()->exists($templatePath.'.block.'.$layout->text))
    @include($templatePath.'.block.'.$layout->text)
    {{-- @php
      dd($layout);
    @endphp --}}
    @endif
    @endif
    @endif
    @endforeach
    @endisset
    <!--//Module left -->
    <div class="page-view">
      <h2>Fanpage</h2>
      <iframe 
        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FBig-Shop-Online-115075797023073&tabs=timeline&width=260&height=600&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=2795729107324348" 
        width="264" 
        height="70" 
        style="border:none; overflow:hidden;" 
        scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media">
      </iframe>
    </div>
  </div>
  @show
</div>
<!--//main left-->