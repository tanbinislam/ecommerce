@props([
    'route' => '',
    'icon' => 'uil-star',
])
<li>
    <a href="{{ $route == '' ? 'javascript:void(0);' : route($route) }}">
    <i class="{{$icon}}"></i>
    <span>{{ $slot }}</span>
        
    </a>
</li>