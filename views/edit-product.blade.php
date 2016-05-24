@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products', 'page_title' => 'Edit Product'])
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Product</div>
                    <div class="panel-body">
                        @include('elements.error-message-partial')

                        <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST"
                              action="{{ url('/products/update/' . $product->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Product Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Product Description</label>

                                <div class="col-md-6">
                                    <textarea rows="10" class="form-control" name="description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            @if(! $config->group_enabled)
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Product Price</label>

                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="price"
                                               value="{{ $product->productPricing->price }}">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="image" class="control-label col-md-3">Product Image</label>
                                <div class="col-md-6">
                                    <img width='40' height='40' src='{{asset($product->image)}}'>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div> <!-- end div.col-md-6 -->
                            </div> <!-- end div.form-group -->

                            <div class="form-group">
                                <label class="col-md-3 control-label">Bonus Category</label>

                                <div class="col-md-6">
                                    <select name='bonus_categories_id'>
                                        <option value=''>Any</option>
                                        @foreach ($bonusCategories as $item)
                                            <option value='{{$item->id}}' {{ ($product->bonus_category_id == $item->id) ? 'selected' : '' }}>
                                                {{ $item->friendly_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Max Quantity</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="max_quantity"
                                           value="{{ $product->max_quantity }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Min Quantity</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="min_quantity"
                                           value="{{ $product->min_quantity }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">HQ Product</label>

                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="is_hq" value="1"
                                                {{  (old('is_hq', $product->is_hq) != '0')  ? 'checked' : '' }}
                                        >
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="is_hq" value="0"
                                                {{ (old('is_hq', $product->is_hq) == '0')  ? 'checked' : '' }}
                                        >
                                        No
                                    </label>
                                </div>
                            </div>


                        @if($config->group_enabled)
                                <div class="form-group">
                                    {{--<label class="col-md-3 control-label">Target Group</label>--}}
                                    <div class="col-md-10 col-md-offset-1 column">
                                        <table class="table table-bordered table-hover" id="tab_logic">
                                            <thead>
                                            <tr>
                                            <tr>
                                                <th class="text-center" rowspan="2">Group</th>
                                                <th class="text-center" colspan="2">Product Price</th>
                                                <th class="text-center" colspan="2">Delivery</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" colspan="1">West Malaysia</th>
                                                <th class="text-center" colspan="1">East Malaysia</th>
                                                <th class="text-center" colspan="1">West Malaysia</th>
                                                <th class="text-center" colspan="1">East Malaysia</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $index = 0 ?>
                                            @foreach ($groups as $item)
                                                <?php $index++ ?>
                                                <tr>
                                                    <input type="hidden" name="{{ "groups[{$index}][group_id]" }}"
                                                           value="{{$item->id}}"/>
                                                    <input type="hidden"
                                                           name="{{ "groups[{$index}][product_pricing_id]" }}"
                                                           value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->id : 0}}"/>
                                                    <td>{{ $item->name }}</td>
                                                    <td colspan="1">
                                                        <input type="number" name="{{ "groups[{$index}][price]" }}"
                                                               value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->price : ''}}"
                                                               placeholder='Price' class="form-control"/>
                                                    </td>
                                                    <td colspan="1">
                                                        <input type="number" name="{{ "groups[{$index}][price_east]" }}"
                                                               value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->price_east : ''}}"
                                                               placeholder='Price' class="form-control"/>
                                                    </td>
                                                    <td colspan="1">
                                                    <input type="number" name="{{ "groups[{$index}][delivery]" }}"
                                                           value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->delivery : ''}}"
                                                           placeholder='Delivery' class="form-control"/>
                                                    </td>
                                                    <td colspan="1">
                                                        <input type="number" name="{{ "groups[{$index}][delivery_east]" }}"
                                                               value="{{$product->pricingForGroup($item) ? $product->pricingForGroup($item)->delivery_east : ''}}"
                                                               placeholder='Delivery' class="form-control"/>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

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