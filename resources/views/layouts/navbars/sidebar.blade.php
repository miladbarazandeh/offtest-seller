<div class="sidebar" data-color="danger" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <div class="logo">
    <a href="/" class="simple-text logo-normal">
      {{ config('app.name') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      {{--<li class="nav-item{{ $activePage == 'home' ? ' active' : '' }}">--}}
        {{--<a class="nav-link" href="{{ route('admin.home') }}">--}}
          {{--<i class="material-icons">dashboard</i>--}}
            {{--<p>{{ __('صفحه اصلی') }}</p>--}}
        {{--</a>--}}
      {{--</li>--}}
      {{--<li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">--}}
        {{--<a class="nav-link" href="{{ route('admin.users') }}">--}}
          {{--<i class="material-icons">people</i>--}}
          {{--<p>{{ __('کاربران') }}</p>--}}
        {{--</a>--}}
      {{--</li>--}}
      {{--<li class="nav-item{{ $activePage == 'cycles' ? ' active' : '' }}">--}}
        {{--<a class="nav-link" href="{{ route('admin.cycles') }}">--}}
          {{--<i class="material-icons">timer</i>--}}
          {{--<p>{{ __('دوره‌ها') }}</p>--}}
        {{--</a>--}}
      {{--</li>--}}
        {{--<li class="nav-item{{ $activePage == 'values' ? ' active' : '' }}">--}}
          {{--<a class="nav-link" href="{{ route('admin.values') }}">--}}
            {{--<i class="material-icons">business</i>--}}
            {{--<p>{{ __('ارزش‌های سازمانی') }}</p>--}}
          {{--</a>--}}
        {{--</li>--}}

      {{--<li class="nav-item{{ $activePage == 'categories' ? ' active' : '' }}">--}}
        {{--<a class="nav-link" href="{{ route('admin.categories') }}">--}}
          {{--<i class="material-icons">category</i>--}}
          {{--<p>{{ __('دسته‌بندی ارزش‌ها') }}</p>--}}
        {{--</a>--}}
      {{--</li>--}}

      {{--<li class="nav-item{{ $activePage == 'parameters' ? ' active' : '' }}">--}}
        {{--<a class="nav-link" href="{{ route('admin.parameters') }}">--}}
          {{--<i class="material-icons">checkbox</i>--}}
          {{--<p>{{ __('معیارها') }}</p>--}}
        {{--</a>--}}
      {{--</li>--}}

      {{--<li class="nav-item{{ $activePage == 'forms' ? ' active' : '' }}">--}}
        {{--<a class="nav-link" href="{{ route('admin.forms') }}">--}}
          {{--<i class="material-icons">list_alt</i>--}}
          {{--<p>{{ __('فرم‌ها') }}</p>--}}
        {{--</a>--}}
      {{--</li>--}}
      {{--<li class="nav-item{{ $activePage == 'results' ? ' active' : '' }}">--}}
        {{--<a class="nav-link" href="{{ route('admin.results') }}">--}}
          {{--<i class="material-icons">assessment</i>--}}
          {{--<p>{{ __('نتایج') }}</p>--}}
        {{--</a>--}}
      {{--</li>--}}
    </ul>
  </div>
</div>