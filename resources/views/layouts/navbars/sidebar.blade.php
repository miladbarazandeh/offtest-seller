<div class="sidebar" data-color="danger" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <div class="logo">
    <a href="/" class="simple-text logo-normal">
      {{ config('app.name') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'home' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('صفحه اصلی') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'promotions' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('panel.promotions') }}">
          <i class="material-icons">list_alt</i>
          <p>{{ __('پیشنهادها') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>