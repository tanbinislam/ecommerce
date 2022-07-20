<x-app-layout>
    <x-dash.page-title>Update Product</x-dash.page-title>
    <div class="row align-items-center">
        <div class="col-12">                      
        <form id="product-form" class="form-horizontal" method="post" action="{{ route('updateProduct', ['product' => $product]) }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header card_header">
                    <div class="row">
                        <div class="col-md-8 card_header_title">
                        <i class="mdi mdi-contactless-payment-circle"></i> Edit Product Information
                        </div>
                        <div class="col-md-4 card_button_part">
                        <a class="btn btn-md btn-dark" href="{{ route('allProducts') }}"><i class="mdi mdi-reorder-horizontal me-1"></i> <span>All Products</span> </a>
                        </div>
                    </div>
                </div>
                <div class="card-body card_body">
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Title<span class="req_star">*</span> :</label>
                        <div class="col-8">
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $product->title }}">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Price<span class="req_star">*</span> :</label>
                        <div class="col-8">
                            <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ $product->price }}">
                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Discount :</label>
                        <div class="col-8">
                            <input type="text" class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" name="discount" value="{{ $product->discount }}">
                            @if ($errors->has('discount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Stock<span class="req_star">*</span>:</label>
                        <div class="col-8">
                            <input type="text" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" name="stock" value="{{ $product->stock }}">
                            @if ($errors->has('stock'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('stock') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Category<span class="req_star">*</span>:</label>
                        <div class="col-8">
                            @php
                            $categories = App\Models\ProductCategory::all();
                            @endphp
                            <select class="form-control form_control" id="" name="category">
                                <option value="">Select Product Category</option>
                                @foreach($categories as $category)
                                <option {{ $category->id == $product->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Status<span class="req_star">*</span>:</label>
                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="draft" value="1" {{ $product->draft == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                  Save as Draft
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="draft" value="0" {{ $product->draft == 0 ? 'checked' : ''}}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                  Publish
                                </label>
                              </div>
                            @if ($errors->has('draft'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('draft') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Product Images<span class="req_star">*</span> :</label>
                        <div class="col-8">
                            <div id="product-images"></div>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Product Description<span class="req_star">*</span> :</label>
                        <div class="col-8">
                            <div id="editor">{!! $product->description !!}</div>
                            <input type="hidden" name="description">
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer card_footer text-center mt-2">
                    <button id="submit-product" type="submit" class="btn btn-md btn-dark">SUBMIT</button>
                </div>
            </div>
            </form>    
        </div> <!-- end col -->
    </div><!-- end row -->
    @push('css')
    <link href="{{ asset('css/image-uploader.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/quill.snow.min.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="{{ asset('js/image-uploader.min.js') }}"></script>
    <script src="{{ asset('js/quill.min.js') }}"></script>
    <script>
        var preloaded = {!! $product->images !!};
        var asfo = '{!! asset('images/product-images/') !!}';
        // image-uploader
        var pl = [];
        var j = 1;
        for(var i in preloaded){
            var t ={}
            t['id'] = i;
            t['src'] = asfo+'/'+preloaded[i];
            pl.push(t);
        }
        
        $('#product-images').imageUploader({
            preloaded: pl,
        });

        // quill.js
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
            ['image', 'video'],
        ];
        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow',
            scrollingContainer: '#scrolling-container',
        });

        $("#submit-product").on('click', function(){
                $('input[name="description"]').attr('value', $("#editor .ql-editor").html() )
                $('#product-form').submit();
            });
    </script>
    @endpush
</x-app-layout>
