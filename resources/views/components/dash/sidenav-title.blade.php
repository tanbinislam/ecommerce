@props([
    'title' => '',  
])
<li class="side-nav-title side-nav-item">{{ $title }}</li>
{{ $slot }}