<x-app-layout>
    <x-dash.page-title>All Product Categories</x-dash.page-title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('allProductCategories') }}" class="btn btn-info mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Product</a>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog"></i></button>
                                <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                <button type="button" class="btn btn-light mb-2">Export</button>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered dt-responsive nowrap w-100" id="all-datatable">
                            <thead class="table-light">
                                <tr>
                                    
                                    <th>Product Category</th>
                                    <th>Slug</th>
                                    <th>Number Of Products</th>
                                    <th style="width: 75px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>
                                        <a href="{{route('editProductCategory', ['category' => $category])}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
    @if(Session::has('success'))
    @push('scripts')
        <script>
            $(document).ready(function(){
                swal({
                title: '{{Session::get('success')}}',
                icon: "success",
                buttons: false,
                timer: 3000,
            });
            });
        </script>
    @endpush
    @endif
</x-app-layout>