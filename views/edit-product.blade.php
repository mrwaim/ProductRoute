@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products', 'page_title' => 'Edit Product'])
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Product</div>
                    <div class="panel-body">
                        @include('elements.error-message-partial')

                        <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST"
                              action="{{ url('/products/update/' . $product->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Description</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="description"
                                           value="{{ $product_pricing->product->description }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Price</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="price"
                                           value="{{ $product_pricing->price }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Target Group</label>

                                <div class="col-md-6">
                                    <select name='group_id' id="group-list">
                                        <option value='0'>Any</option>
                                        @foreach ($groups as $item)
                                            <option value='{{$item->id}}' @if($product_pricing->groups()->where('group_id', '=', $item->id)->count() > 0) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="control-label col-md-4">Product Image</label>
                                <div class="col-md-6">
                                    <img width='40' height='40' src='{{asset($product_pricing->product->image)}}'>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div> <!-- end div.col-md-6 -->
                            </div> <!-- end div.form-group -->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Bonus Category</label>

                                <div class="col-md-6">
                                    <select name='bonus_categories_id'>
                                        @foreach ($bonusCategories as $item)
                                            <option value='{{$item->id}}' {{ ($product_pricing->product->bonus_categories_id == $item->id) ? 'selected' : '' }}>
                                                {{ $item->friendly_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection