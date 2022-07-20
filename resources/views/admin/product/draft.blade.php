<x-app-layout>
    <x-dash.page-title>Drafted Products</x-dash.page-title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('createProduct') }}" class="btn btn-info mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Product</a>
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
                                    
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Product ID</th>
                                    <th>Status</th>
                                    <th style="width: 75px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    
                                    <td>
                                        <img src="{{ asset('images/product-images/'.(json_decode($product->images, true))[0]) }}" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
                                        <p class="m-0 d-inline-block align-middle font-16">
                                            <a href="{{ route('viewProduct', ['product' => $product]) }}" class="text-body">{{ Str::substr($product->title, 0, 15).'...' }}</a>
                                            <br/>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="font-14">Rating : {{ $product->rating }}</span> 
                                        </p>
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->category->title }}</td>
                                    <td>{{ $product->product_slug }}</td>
                                    <td>
                                        <span class="{{ $product->draft == 1 ? 'badge bg-warning' : 'badge bg-success'}}">{{ $product->draft == 1 ? 'Drafted' : 'Published'}}</span>
                                    </td>

                                    <td>
                                        <a href="{{route('editProduct', ['product' => $product])}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="#" class="dtbl-icon action-icon del-dta" data-name="Product" data-title="{{$product->title}}" data-url="{{route('deleteProduct', ['product' => $product])}}"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form id="delete-form" action="" method="post">
                            @csrf
                            <input style="display: none" type="submit" value="submit">
                        </form>
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