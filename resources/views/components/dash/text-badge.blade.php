@props([
    'role' => 'Customer',
    'colors' => [
        'Super Admin' => 'badge badge-success',
        'Admin' => 'badge badge-success-lighten',
        'Manager' => 'badge badge-warning-lighten',
        'Support' => 'badge badge-danger-lighten',
        'Customer' => 'badge badge-info-lighten'
    ]

])

<span class="{{$colors[$role]}}">
    {{$slot}}
</span>