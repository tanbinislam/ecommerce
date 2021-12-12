@props([
    'notify' => 0,
    'icon' => 'uil-star',
    'route'=> ''   
])
<li class="side-nav-item">
        <a href="{{ $route == '' ? url('/#') : route($route) }}" class="side-nav-link">
        <i class="{{$icon}}"></i>
        <span> {{ $slot }}</span>
        @if($notify)
        <span class="badge bg-info rounded-pill float-end">4</span>
        @endif
    </a>
</li>