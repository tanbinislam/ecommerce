@props([
    'route' => '',
    'icon' => 'uil-star',
])
<li>
    <a href="{{ $route == '' ? url('/#') : route($route) }}">
    <i class="{{$icon}}"></i>
    <span>{{ $slot }}</span>
        
    </a>
</li>