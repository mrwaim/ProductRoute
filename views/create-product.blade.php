@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products', 'page_title' => 'Create Products'])
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Product</div>
                    <div class="panel-body">
                        @include('elements.error-message-partial')

                        <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST"
                              action="{{ url('/products/create-product') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Description</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="description"
                                           value="{{ old('description') }}">
                                </div>
                            </div>

                            @if(! $config->group_enabled)
                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Price</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="price"
                                           value="{{ old('price') }}">
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="image" class="control-label col-md-4">Product Image</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="image" id="image">
                                </div> <!-- end div.col-md-6 -->
                            </div> <!-- end div.form-group -->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Bonus Category</label>

                                <div class="col-md-6">
                                    <select name='bonus_categories_id'>
                                    <option value=''>Any</option>
                                    @foreach ($site_data->get('bonus_categories') as $item)
                                            <option value='{{$item->id}}'>{{ $item->friendly_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if($config->group_enabled)
                            <div class="form-group">
                                <label class="col-md-4 control-label">Target Group</label>
                                <div class="col-md-6 column">
                                    <table class="table table-bordered table-hover" id="tab_logic">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Group</th>
                                            <th class="text-center">Product Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $index = 0 ?>
                                        @foreach ($groups as $item)
                                            <?php $index++ ?>
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <input type="hidden" name="{{ "groups[{$index}][group_id]" }}" value="{{$item->id}}"/>
                                                <td><input type="number" name={{ "groups[{$index}][price]" }} placeholder='Price' class="form-control"/></td>
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
                                        Create
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