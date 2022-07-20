<x-app-layout>
    <x-dash.page-title>Edit Product Tag</x-dash.page-title>
    <div class="row align-items-center">
        <div class="col-12">                      
        <form id="product-form" class="form-horizontal" method="post" action="{{ route('updateProductTag', ['tag' => $tag]) }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header card_header">
                    <div class="row">
                        <div class="col-md-8 card_header_title">
                        <i class="mdi mdi-contactless-payment-circle"></i> Update Product Tag Information
                        </div>
                        <div class="col-md-4 card_button_part">
                        <a class="btn btn-md btn-dark" href="{{ route('allProductTags') }}"><i class="mdi mdi-reorder-horizontal me-1"></i> <span>All Product Tags</span> </a>
                        </div>
                    </div>
                </div>
                <div class="card-body card_body">
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Title<span class="req_star">*</span> :</label>
                        <div class="col-8">
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $tag->title }}">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
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
</x-app-layout>
