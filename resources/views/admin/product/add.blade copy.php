<x-app-layout>
    <x-dash.page-title>Add New Product :</x-dash.page-title>
    <div class="row align-items-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-4 justify-content-end">
                        <div class="col-auto">
                            <a class="btn btn-md btn-info" href="{{ route('allProducts') }}"><i class="mdi mdi-reorder-horizontal me-1"></i> <span>All Products</span> </a>
                        </div>
                    </div> 
                </div>
                <div class="card-body">
                    <div class="row my-2 justify-content-center">
                        <div class="col-auto">
                            <h3 style="border-bottom:4px solid #5CC469">-- PRODUCT --</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form id="product-form" class="form-horizontal">
                                <div class="row" style="margin-bottom: 60px;">
                                    <div class="col-12 mb-6">
                                        <div class="row mb-3">
                                            <label class="col-2 col-form-label">Title <span class="req_star">*</span> :</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="title"" id="product-title">
                                                <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong class="err" id="err-title"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="row">
                                                    <label class="col-4 col-form-label">Regular Price <span class="req_star">*</span> :</label>
                                                    <div class="col-8">
                                                        <input type="text" class="form-control" name="price" id="product-price">
                                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                                            <strong class="err" id="err-price"></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <label class="col-3 col-form-label">Discount :</label>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control" name="discount" id="product-discount">
                                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                                            <strong class="err" id="err-discount"></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-2 col-form-label">Categories <span class="req_star">*</span> :</label>
                                            <div class="col-10">
                                                <div class="row">
                                                    @foreach (App\Models\ProductCategory::all() as $category)
                                                    <div class="col-auto">
                                                        <div class="form-check form-checkbox-primary mb-2">
                                                            <input value="{{ $category->id }}" name="categories[]" type="checkbox" class="form-check-input" id="{{'category-'.Str::slug($category->title, '-')}}">
                                                            <label class="form-check-label" for="{{'category-'.Str::slug($category->title, '-')}}">{{$category->title}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong class="err" id="err-categories"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-2 col-form-label">Tags <span class="req_star">*</span> :</label>
                                            <div class="col-10">
                                                <div class="row">
                                                    @foreach (\App\Models\ProductTag::all() as $tag)
                                                    <div class="col-auto">
                                                        <div class="form-check form-checkbox-primary mb-2">
                                                            <input value="{{ $tag->id }}" name="tags[]" type="checkbox" class="form-check-input" id="{{'tag-'.Str::slug($tag->title, '-')}}">
                                                            <label class="form-check-label" for="{{'tag-'.Str::slug($tag->title, '-')}}">{{$tag->title}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong class="err" id="err-tags"></strong>
                                                </span>  
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-2 col-form-label">Description <span class="req_star">*</span> :</label>
                                            <div class="col-10">
                                                <div id="editor"></div>
                                                <input type="hidden" name="description">
                                                <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong class="err" id="err-description"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div class="row mb-3">
                                    <div class="col-auto mx-auto">
                                        <button id="submit-product" class="btn btn-info" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2 justify-content-center">
                        <div class="col-auto">
                            <h3 style="border-bottom:4px solid #5CC469">-- Stock --</h3>
                        </div>
                    </div>
                    {{-- wizard --}}
                    <div id="product-wizard">
                        <ul id="wiz-tab" class="nav nav-pills nav-justified form-wizard-header mb-4" role="tablist">
                            <li class="nav-item">
                                <a href="#tab-general" role="tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active"> 
                                    <i class="uil-store-alt me-1"></i>
                                    <span class="d-none d-sm-inline">General</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab-color" role="tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="uil-chart-bar-alt me-1"></i>
                                    <span class="d-none d-sm-inline">Colors</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab-size" role="tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="uil-scenery me-1"></i>
                                    <span class="d-none d-sm-inline">Sizes</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab-color-size" role="tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="uil-scenery me-1"></i>
                                    <span class="d-none d-sm-inline">Colors & Sizes</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content b-0 pb-0">
                            <div class="tab-pane active" id="tab-general">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="general-stock-form" class="form-horizontal">
                                            <div role="tabpanel" class="row">
                                                <div class="col-12 mb-6">
                                                    <div class="row mb-3">
                                                        <label class="col-2 col-form-label">Stock <span class="req_star">*</span> :</label>
                                                        <div class="col-10">
                                                            <input type="number" class="form-control" name="stock" id="general-stock">
                                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                                <strong class="err" id="err-stock"></strong>
                                                            </span>
                                                        </div>
                                                    </div> 
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row mb-3">
                                                <div class="col-auto mx-auto">
                                                    <button id="submit-general-stock" class="btn btn-info" type="submit">Save Stock</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        

                            <div class="tab-pane" id="tab-color">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="color-stock-form" class="form-horizontal">
                                           
                                            <div role="tabpanel" class="row">
                                                <div id="color-fields" class="col-12 mb-6">
                                                    <div class="row">
                                                        <label class="col-2 col-form-label" for="color-name">Color <span class="req_star">*</span> :</label>
                                                        <div class="col-4 mb-2">
                                                            <input type="text" id="color-name" name="color[0][name]" class="form-control" id="color-name">
                                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                                <strong class="err" id="err-color-name-0"></strong>
                                                            </span>
                                                        </div>
                                                        <label class="col-2 col-form-label" for="color-qty">Quantity <span class="req_star">*</span> :</label>
                                                        <div class="col-4 mb-2">
                                                            <input type="number" id="color-qty" name="color[0][qty]" class="form-control" id="color-qty">
                                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                                <strong class="err" id="err-color-qty-0"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row my-3 justify-content-end">
                                                <div class="col-auto">
                                                    <button id="add-color" class="btn btn-warning"><span class="uil-plus-square"></span> Add Another Color</button>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-auto mx-auto">
                                                    <button id="submit-color-stock" class="btn btn-info" type="submit">Save Color Stock</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-size">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="size-stock-form" class="form-horizontal">
                                            
                                            <div role="tabpanel" class="row">
                                                <div class="col-12 mb-6">
                                                    <div class="row mb-2">
                                                        <label class="col-2 col-form-label">XXL :</label>
                                                        <div class="col-2">
                                                            <input type="number" value="0" name="size[xxl]" id="sz-xxl-qty" class="form-control mt-1">
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                                <strong class="err" id="err-size-xxl"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-2 col-form-label">XL :</label>
                                                        <div class="col-2">
                                                            <input type="number" value="0" name="size[xl]" id="sz-xl-qty" class="form-control mt-1">
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                                <strong class="err" id="err-size-xl"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-2 col-form-label">L :</label>
                                                        <div class="col-2">
                                                            <input type="number" value="0" name="size[l]" id="sz-l-qty" class="form-control mt-1">
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                                <strong class="err" id="err-size-l"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-2 col-form-label">M :</label>
                                                        <div class="col-2">
                                                            <input type="number" value="0" name="size[m]" id="sz-m-qty" class="form-control mt-1">
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                                <strong class="err" id="err-size-m"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-2 col-form-label">S :</label>
                                                        <div class="col-2">
                                                            <input type="number" value="0" name="size[s]" id="sz-s-qty" class="form-control mt-1">
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                                <strong class="err" id="err-size-s"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row mb-3">
                                                <div class="col-auto mx-auto">
                                                    <button id="submit-size-stock" class="btn btn-info" type="submit">Save Size Stock</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-color-size">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="color-size-stock-form" class="form-horizontal">
                                            
                                            <div role="tabpanel" class="row">
                                                <div id="color-size-fields" class="col-12 mb-6">
                                                    <div class="row my-2">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <label class="col-2 col-form-label" for="color-name">Color Name <span class="req_star">*</span> :</label>
                                                                <div class="col-10 mb-2">
                                                                    <input type="text" id="color-name" name="color[0][name][title]" class="form-control" id="csf-color-name">
                                                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                                                        <strong class="err" id="csf-err-name-title-0"></strong>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row mb-2">
                                                                <label class="col-2 col-form-label">Quantity <span class="req_star">*</span> :</label>
                                                                <div class="col-2">
                                                                    <label class="form-label" for="">XXL <span id="csf-sz-xxl-rs" class="req_star">*</span> :</label>
                                                                    <input type="text" name="color[0][size][xxl]" id="sz-xxl-qty" class="form-control mt-1">
                                                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                                                        <strong class="err" id="csf-err-size-xxl-0"></strong>
                                                                    </span>
                                                                </div>
                                                                <div class="col-2">
                                                                    <label class="form-label" for="">XL <span id="sz-xl-rs" class="req_star">*</span> :</label>
                                                                    <input type="text" name="color[0][size][xl]" id="csf-sz-xl-qty" class="form-control mt-1">
                                                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                                                        <strong class="err" id="csf-err-size-xl-0"></strong>
                                                                    </span>
                                                                </div>
                                                                <div class="col-2">
                                                                    <label class="form-label" for="">L <span id="sz-l-rs" class="req_star">*</span> :</label>
                                                                    <input type="text" name="color[0][size][l]" id="csf-sz-l-qty" class="form-control mt-1">
                                                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                                                        <strong class="err" id="csf-err-size-l-0"></strong>
                                                                    </span>
                                                                </div>
                                                                <div class="col-2">
                                                                    <label class="form-label" for="">M <span id="sz-m-rs" class="req_star">*</span> :</label>
                                                                    <input type="text" name="color[0][size][m]" id="csf-sz-m-qty" class="form-control mt-1">
                                                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                                                        <strong class="err" id="csf-err-size-m-0"></strong>
                                                                    </span>
                                                                </div>
                                                                <div class="col-2">
                                                                    <label class="form-label" for="">S <span id="sz-s-rs" class="req_star">*</span> :</label>
                                                                    <input type="text" name="color[0][size][s]" id="csf-sz-s-qty" class="form-control mt-1">
                                                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                                                        <strong class="err" id="csf-err-size-s-0"></strong>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row my-3 justify-content-end">
                                                <div class="col-auto">
                                                    <button id="add-color-size" class="btn btn-warning"><span class="uil-plus-square"></span> Add Another Color</button>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-auto mx-auto">
                                                    <button id="submit-color-size-stock" class="btn btn-info" type="submit">Save Color Stock</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- tab-content -->
                    </div>
                    {{-- wizard end --}}
                    <div class="row my-2 justify-content-center">
                        <div class="col-auto">
                            <h3 style="border-bottom:4px solid #5CC469">-- Images --</h3>
                        </div>
                    </div>
                    <div class="row mb-2 justify-content-center">
                        <div class="col-12">
                            <form class="dropzone" id="image-upload-form">
                                <div class="dz-message needsclick">
                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    <h3>Drop files here or click to upload.</h3>
                                    <span class="text-muted font-13">
                                        (All Product Images will be Uploaded After Submitting)
                                    </span>
                                </div>
                            </form>
                            <div class="row my-3">
                                <div class="col-auto mx-auto">
                                    <button id="submit-images" class="btn btn-info" type="submit">Save Images</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--card body-->
            </div>  <!-- card end -->  
        </div> <!-- end col -->
    </div><!-- end row -->
    @push('css')
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/quill.snow.min.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/quill.min.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function(){
            var toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, 5, 6, 'small', 'large', 'huge', false] }],
            [{ 'font': [] }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            // ['image', 'video'],
            ];
            var quill = new Quill('#editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow',
                scrollingContainer: '#scrolling-container',
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
             });

            var product_id = "";
            $("#product-form").on('submit', function(e){
                e.preventDefault();
                $(".err").text('');
                $('input[name="description"]').attr('value', $("#editor .ql-editor").html());
                $.ajax({
                    type : 'post',
                    url : "/shop/product/create",
                    data : $('#product-form').serialize(),
                    success : function(response){
                        swal({
                            title: response.success,
                            text: 'Proceeding to next section ...',
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });
                        $('#product-title, #product-price, #product-discount, input[name="categories[]"], input[name="tags[]"]')
                        .attr('disabled', 'disabled');
                        quill.enable(false);
                        $("#submit-product").addClass('disabled');
                        product_id = response.product_id;
                    },
                    error : function(response){
                        $("#err-title").text(response.responseJSON.errors.title);
                        $("#err-price").text(response.responseJSON.errors.price);
                        $("#err-discount").text(response.responseJSON.errors.discount);
                        $("#err-categories").text(response.responseJSON.errors.categories);
                        $("#err-tags").text(response.responseJSON.errors.tags);
                        $("#err-description").text(response.responseJSON.errors.description);
                    }
                });
            });
            // Stock form
            $("#general-stock-form").on('submit', function(e){
                e.preventDefault();
                $(".err").text('');
                $.ajax({
                    type: 'post',
                    url: '/shop/product-general-stock/add/'+product_id,
                    data: $('#general-stock-form').serialize(),
                    success: function(response){
                        swal({
                            title: response.success,
                            text: 'Upload Images Now!',
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });
                        $('a[href="#tab-general"], a[href="#tab-color"], a[href="#tab-size"], a[href="#tab-color-size"], #submit-general-stock, #add-color, #submit-color-stock, #submit-size-stock, #add-color-size, #submit-color-size-stock').addClass('disabled');
                        $('#general-stock, #color-name, #color-qty, #sz-xxl-qty, #sz-xl-qty, #sz-l-qty, #sz-m-qty, #sz-s-qty, #csf-color-name, #csf-sz-xxl-qty, #csf-sz-xl-qty, #csf-sz-l-qty, #csf-sz-m-qty, #csf-sz-s-qty').attr('disabled', 'disabled');
                    },
                    error: function(response){
                        $("#err-stock").text(response.responseJSON.errors.stock);
                    }
                })
            });

            // colors form
            var color_initial = 0;
            $("#tab-color").on('click', '#add-color', function(e){
                e.preventDefault();
                color_initial++;
                var color_field = '<div class="row my-2 py-2" style="position: relative; border: 2px dashed; border-radius: 5px;">'+
                                    '<button class="color-remove-button crb">x</button>'+
                                    '<label class="col-2 col-form-label" for="color-name">Color <span class="req_star">*</span> :</label>'+
                                    '<div class="col-4 mb-2">'+
                                        '<input type="text" name="color['+color_initial+'][name]" class="form-control cstock">'+
                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                            '<strong class="err" id="err-color-name-'+color_initial+'"></strong>'+
                                        '</span>'+
                                    '</div>'+
                                    '<label class="col-2 col-form-label" for="color-qty">Quantity <span class="req_star">*</span> :</label>'+
                                   ' <div class="col-4 mb-2">'+
                                        '<input type="number" name="color['+color_initial+'][qty]" class="form-control cstock">'+
                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                            '<strong class="err" id="err-color-qty-'+color_initial+'"></strong>'+
                                        '</span>'+
                                    '</div>'+
                                '</div>';
                
                $("#color-fields").append(color_field);
            });

            $("#color-fields").on('click', '.crb', function(e){
                e.preventDefault();
                $(this).parent().remove();
            });

            $("#color-stock-form").on('submit', function(e){
                e.preventDefault();
                $(".err").text('');
                $.ajax({
                    type: 'post',
                    url: '/shop/product-color-stock/add/'+product_id,
                    data: $('#color-stock-form').serializeArray(),
                    success: function(response){
                        swal({
                            title: response.success,
                            text: 'Upload Images Now!',
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });
                        $('a[href="#tab-general"], a[href="#tab-color"], a[href="#tab-size"], a[href="#tab-color-size"], #submit-general-stock, #add-color, #submit-color-stock, #submit-size-stock, #add-color-size, #submit-color-size-stock').addClass('disabled');
                        $('#general-stock, #color-name, #color-qty, .cstock, .czstock, #sz-xxl-qty, #sz-xl-qty, #sz-l-qty, #sz-m-qty, #sz-s-qty, #csf-color-name, #csf-sz-xxl-qty, #csf-sz-xl-qty, #csf-sz-l-qty, #csf-sz-m-qty, #csf-sz-s-qty').attr('disabled', 'disabled');
                    },
                    error: function(response){
                        $.each(response.responseJSON.errors, function( index, value ) {
                            var er = index.split('.');
                            $("#err-color-"+er[2]+'-'+er[1]).text(response.responseJSON.errors[index]);
                        });
                    }
                })
            });

            // size stock form
            $("#size-stock-form").on('submit', function(e){
                e.preventDefault();
                $(".err").text('');
                $.ajax({
                    type: 'post',
                    url: '/shop/product-size-stock/add/'+product_id,
                    data: $('#size-stock-form').serialize(),
                    success: function(response){
                        swal({
                            title: response.success,
                            text: 'Upload Images Now!',
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });
                        $('a[href="#tab-general"], a[href="#tab-color"], a[href="#tab-size"], a[href="#tab-color-size"], #submit-general-stock, #add-color, #submit-color-stock, #submit-size-stock, #add-color-size, #submit-color-size-stock').addClass('disabled');
                        $('#general-stock, #color-name, #color-qty, #sz-xxl-qty, #sz-xl-qty, #sz-l-qty, #sz-m-qty, #sz-s-qty, #csf-color-name, #csf-sz-xxl-qty, #csf-sz-xl-qty, #csf-sz-l-qty, #csf-sz-m-qty, #csf-sz-s-qty').attr('disabled', 'disabled');
                    },
                    error: function(response){
                        $.each(response.responseJSON.errors, function( index, value ) {
                            // console.log(index +' : '+ value);
                            var er = index.split('.');
                            $("#err-size-"+er[1]).text(response.responseJSON.errors[index]);
                        });
                    }
                })
            });

            // color size form
            var color_size_initial = 0;
            $("#tab-color-size").on('click', '#add-color-size', function(e){
                e.preventDefault();
                color_size_initial++;
                
                var color_size_field = '<div class="row py-2 my-2" style="position: relative; border: 2px dashed; border-radius: 5px;">'+
                                            '<button class="color-remove-button csrb">x</button>'+
                                            '<div class="col-12">'+
                                                '<div class="row">'+
                                                    '<label class="col-2 col-form-label" for="color-name">Color Name <span class="req_star">*</span> :</label>'+
                                                    '<div class="col-10 mb-2">'+
                                                        '<input type="text" id="color-name" name="color['+color_size_initial+'][name][title]" class="form-control" id="csf-color-name">'+
                                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                                            '<strong class="err" id="csf-err-name-title-'+color_size_initial+'"></strong>'+
                                                        '</span>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-12">'+
                                                '<div class="row mb-2">'+
                                                    '<label class="col-2 col-form-label">Quantity <span class="req_star">*</span> :</label>'+
                                                    '<div class="col-2">'+
                                                        '<label class="form-label" for="">XXL <span id="csf-sz-xxl-rs" class="req_star">*</span> :</label>'+
                                                        '<input type="text" name="color['+color_size_initial+'][size][xxl]" id="sz-xxl-qty" class="form-control mt-1">'+
                                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                                            '<strong class="err" id="csf-err-size-xxl-'+color_size_initial+'"></strong>'+
                                                        '</span>'+
                                                    '</div>'+
                                                    '<div class="col-2">'+
                                                        '<label class="form-label" for="">XL <span id="sz-xl-rs" class="req_star">*</span> :</label>'+
                                                        '<input type="text" name="color['+color_size_initial+'][size][xl]" id="csf-sz-xl-qty" class="form-control mt-1">'+
                                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                                            '<strong class="err" id="csf-err-size-xl-'+color_size_initial+'"></strong>'+
                                                        '</span>'+
                                                    '</div>'+
                                                    '<div class="col-2">'+
                                                        '<label class="form-label" for="">L <span id="sz-l-rs" class="req_star">*</span> :</label>'+
                                                        '<input type="text" name="color['+color_size_initial+'][size][l]" id="csf-sz-l-qty" class="form-control mt-1">'+
                                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                                            '<strong class="err" id="csf-err-size-l-'+color_size_initial+'"></strong>'+
                                                        '</span>'+
                                                    '</div>'+
                                                    '<div class="col-2">'+
                                                        '<label class="form-label" for="">M <span id="sz-m-rs" class="req_star">*</span> :</label>'+
                                                        '<input type="text" name="color['+color_size_initial+'][size][m]" id="csf-sz-m-qty" class="form-control mt-1">'+
                                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                                            '<strong class="err" id="csf-err-size-m-'+color_size_initial+'"></strong>'+
                                                        '</span>'+
                                                    '</div>'+
                                                    '<div class="col-2">'+
                                                        '<label class="form-label" for="">S <span id="sz-s-rs" class="req_star">*</span> :</label>'+
                                                        '<input type="text" name="color['+color_size_initial+'][size][s]" id="csf-sz-s-qty" class="form-control mt-1">'+
                                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                                            '<strong class="err" id="csf-err-size-s-'+color_size_initial+'"></strong>'+
                                                        '</span>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'
                
                $("#color-size-fields").append(color_size_field);
            });

            $("#color-size-fields").on('click', '.csrb', function(e){
                e.preventDefault();
                $(this).parent().remove();
            });

            $("#color-size-stock-form").on('submit', function(e){
                e.preventDefault();
                $(".err").text('');
                $.ajax({
                    type: 'post',
                    url: '/shop/product-color-size-stock/add/'+product_id,
                    data: $('#color-size-stock-form').serializeArray(),
                    success: function(response){
                        swal({
                            title: response.success,
                            text: 'Upload Images Now!',
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });
                        $('a[href="#tab-general"], a[href="#tab-color"], a[href="#tab-size"], a[href="#tab-color-size"], #submit-general-stock, #add-color, #submit-color-stock, #submit-size-stock, #add-color-size, #submit-color-size-stock').addClass('disabled');
                        $('#general-stock, #color-name, #color-qty, .cstock, .czstock, #sz-xxl-qty, #sz-xl-qty, #sz-l-qty, #sz-m-qty, #sz-s-qty, #csf-color-name, #csf-sz-xxl-qty, #csf-sz-xl-qty, #csf-sz-l-qty, #csf-sz-m-qty, #csf-sz-s-qty').attr('disabled', 'disabled');
                    },
                    error: function(response){
                        $.each(response.responseJSON.errors, function( index, value ) {
                            console.log(index +' : '+ value);
                            var er = index.split('.');
                            $("#csf-err-"+er[2]+'-'+er[3]+'-'+er[1]).text(response.responseJSON.errors[index]);
                        });
                    }
                })
            });

            // image upload
            // '/shop/product-images/add/'+product_id,
            // var dz = $("#image-upload-form").dropzone({
            //     //url: '/product-images',
            //     paramName: 'images',
            //     // autoProcessQueue: false,
            //     addRemoveLinks: true,
            //     init: function() {
            //         this.on("processingfile", function(file) {
            //             this.options.url = '/shop/product-images/add/'+product_id;
            //         });
            //     }
            // });


            // $("#submit-images").on('click', function(e){
            //     // e.preventDefault();
            //     // dz.processQueue();
            //     console.log(dz);
            // });

            var dz = new Dropzone("#image-upload-form", {
                url: "/product-images",
                paramName: 'images',
                autoProcessQueue: false,
                addRemoveLinks: true,
            });

            $("#submit-images").on('click', function(e){
                e.preventDefault();
                Dropzone.options.imageUploadForm = {
                    url: '/shop/product-images/add/'+product_id
                    };
                dz.processQueue();
                
            });



        });
    </script>
    @endpush
</x-app-layout>
