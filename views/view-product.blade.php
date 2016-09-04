@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products', 'page_title' => 'Edit Product'])
@endsection

@section('content')
    <section class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">View Product</h2>
        </div>
        <div class="panel-body">
            @include('elements.error-message-partial')

            <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST">
                <div class="form-group">
                    <label class="col-md-3 control-label">Product Name</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6"> {{ $product->name }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Product Description *</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->description }}</div>
                </div>

                <div class="form-group">
                    <label for="image" class="control-label col-md-3">Product Image</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6"><img width='40' height='40' src='{{asset($product->image)}}'></div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Bonus Category</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">
                        {{ $product->bonusCategory ? $product->bonusCategory->friendly_name : '-' }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Max Quantity</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->max_quantity }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Min Quantity</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->min_quantity }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Max purchase count</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->max_purchase_count }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Hide</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->hidden_from_ordering ? 'YES' : 'NO' }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">HQ Product</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->is_hq ? 'YES' : 'NO' }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">For Customer</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->for_customer ? 'YES' : 'NO' }}</div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">For new user</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->new_user ? 'YES' : 'NO' }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Exipiry Date</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->expiry_date }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Role</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->role->name }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Membership product</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->is_membership ? 'YES' : 'NO' }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Membership group</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->membershipGroup ? $product->membershipGroup->name : '-' }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Price </label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->price }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Price east </label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->price_east }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Delivery </label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->delivery }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Delivery east</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->delivery_east }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Group</label>
                    <label class="col-md-1 text-right">:</label>
                    <div class="col-md-6">{{ $product->group ? $product->group->name : '-' }}</div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <a class="btn btn-primary" href="{{ url('products/edit/'. $product->id) }}">Edit</a>
                        <a class="btn btn-primary" href="{{ url('order-management/products-sold?product_id='. $product->id) }}">View orders with this product</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection