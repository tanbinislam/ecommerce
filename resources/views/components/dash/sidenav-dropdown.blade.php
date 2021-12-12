@php
    $t_id = 'dd'.uniqid();
@endphp
@props([
    'icon' => 'uil-star',
    'toggle_id'=> $t_id
])

<li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#{{ $toggle_id }}" aria-expanded="false" aria-controls="{{ $toggle_id }}" class="side-nav-link">
        <i class="{{ $icon }}"></i>
        <span> {{ $slot }}</span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="{{ $toggle_id }}">
        <ul class="side-nav-second-level">
            {{ $dropdownItems }}
        </ul>
    </div>
</li>