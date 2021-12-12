<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu leftside-menu-detached">

    <div class="leftbar-user">
        <a href="javascript: void(0);">
            <img src="{{asset('')}}images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
            <span class="leftbar-user-name">{{ auth()->user()->name }}</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">

        <x-dash.sidenav-title title="NAVIGATION">
            <x-dash.sidenav-item icon="uil-home-alt" notify="1" >Dashboard</x-dash.sidenav-item>
        </x-dash.sidenav-title>

        <x-dash.sidenav-title title="-- Income --">

            <x-dash.sidenav-dropdown icon=" uil-bill">
                Products
                <x-slot name="dropdownItems">
                    <x-dash.dropdown-item icon="uil-money-stack">All Products</x-dash.dropdown-item>
                    <x-dash.dropdown-item icon="uil-moneybag-alt">Add Product</x-dash.dropdown-item>
                </x-slot>
            </x-dash.sidenav-dropdown>

            <x-dash.sidenav-dropdown icon="uil-books">
                Orders
                <x-slot name="dropdownItems">
                    <x-dash.dropdown-item icon="uil-copy">All Orders</x-dash.dropdown-item>
                    <x-dash.dropdown-item icon="uil-file-plus-alt">Add Orders</x-dash.dropdown-item>
                </x-slot>
            </x-dash.sidenav-dropdown>

        </x-dash.sidenav-title>

    </ul>
    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->