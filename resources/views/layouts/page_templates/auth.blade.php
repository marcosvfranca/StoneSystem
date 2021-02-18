@if($user->temAcessoUnico('menu_lateral'))
  <div class="wrapper ">
    @include('layouts.navbars.sidebar')
    <div class="main-panel">
      @include('layouts.navbars.navs.auth')
      @yield('content')
{{--      @include('layouts.footers.auth')--}}
    </div>
  </div>
@else
<div class="wrapper">
  <div class="main-panel" style="width: 100%;">
    @include('layouts.navbars.navs.auth')
    @yield('content')
{{--    @include('layouts.footers.auth')--}}
  </div>
</div>
@endif
@push('js')
    <script>
        setTimeout(function () {
            location.reload();
        }, 1000 * 60 * {{ env('SESSION_LIFETIME') }} + 1000);
    </script>
@endpush
