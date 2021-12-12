@props([
    'title' => 'Card Title',
    'icon' => 'mdi mdi-account-multiple',
    'icon-bg' => '',
    'percent' => '0',
    'percent_type' => '',

])

<div class="card widget-flat">
    <div class="card-body">
        <div class="float-end">
            <i class="{{ $icon }} widget-icon"></i>
        </div>
        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">{{ $title }}</h5>
        <h3 class="mt-3 mb-3">{{ $slot }}</h3>
        <p class="mb-0 text-muted">
            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> {{ $percent }}%</span>
            <span class="text-nowrap">Since last month</span>  
        </p>
    </div> <!-- end card-body-->
</div> <!-- end card-->