<x-app-layout>
    <x-dash.page-title>View Product Information</x-dash.page-title>
    <div class="row align-items-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <!-- Product image -->
                            <a href="javascript: void(0);" class="text-center d-block mb-4">
                                <img src="{{ asset('images/product-images/'.(json_decode($product->images, true))[0]) }}" id="preview-img" class="img-fluid" style="max-width: 280px;" alt="Product-img">
                            </a>

                            <div class="d-lg-flex" style="overflow-x: scroll">
                                @foreach (json_decode($product->images, true) as $k=>$img)
                                <a class="mx-1" href="javascript: void(0);">
                                    <img src="{{ asset('images/product-images/'.$img) }}" class="img-fluid img-thumbnail p-2 product-images" style="max-width: 75px;" alt="Product-img">
                                </a>
                                @endforeach
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-7">
                            <form class="ps-lg-4">
                                <!-- Product title -->
                                <h3 class="mt-0">{{ $product->title }}<a href="{{ route('editProduct', ['product' => $product]) }}" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>
                                <p class="mb-1">Added Date: {{ $product->created_at->toFormattedDateString()}}</p>
                                <p class="mb-1">Updated Date: {{ $product->updated_at->toFormattedDateString()}}</p>
                                <p class="font-16">
                                    <span class="font-14">Rating :</span>
                                    <span class="text-warning mdi mdi-star font-14"></span>
                                    <span class="font-14">{{ $product->rating }}</span>
                                </p>

                                <!-- Product stock -->
                                <div class="mt-3">
                                    <h4><span class="{{ $product->stock < 1 ? 'badge badge-danger-lighten' : 'badge badge-success-lighten'}}">{{ $product->stock < 1 ? 'Out of stock' : 'Instock'}}</span></h4>
                                </div>

                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Retail Price:</h6>
                                    <h3> ${{$product->price}}</h3>
                                </div>
                                <div class="mt-4">
                                    <h6 class="font-14">Discont Price:</h6>
                                    <h5> ${{$product->price - $product->discount}} <span class="text-danger">( -${{ $product->discount }} )</span></h5>
                                </div>

                               
                                <div class="mt-4">
                                    <h6 class="font-14">Category : {{ $product->category->title }}</h6>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-16 fw-bold">tags :
                                        @foreach ($product->tags as $tag)
                                            <span class="badge bg-secondary">
                                                <span class="mdi mdi-tag-multiple"></span> {{ $tag->title }}
                                            </span>
                                        @endforeach
                                    </h5>
                                </div>

                                <!-- Product information -->
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="font-14">Available Stock:</h6>
                                            <p class="text-sm lh-150">{{ $product->stock }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Product ID:</h6>
                                            <p class="text-sm lh-150">{{ $product->product_slug }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Status</h6>
                                            <p class="text-sm lh-150">
                                                <span class="{{ $product->draft == 1 ? 'badge bg-warning' : 'badge bg-success'}}">
                                                    {{ $product->draft == 1 ? 'Drafted' : 'Published'}}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div> <!-- end col -->
                    </div> <!-- end row-->   
                    <div class="row">
                        <div class="col">
                            <!-- product description -->
                            <div class="mt-4">
                                <h6 class="font-14">Description:</h6>
                                <div>{!! $product->description !!}</div>
                            </div>
                        </div>
                    </div>                 
                </div> <!-- end card-body-->
            </div> 
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