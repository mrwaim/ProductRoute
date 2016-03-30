@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products', 'page_title' => 'Create Products'])
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Price</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="price"
                                           value="{{ old('price') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Target Group</label>

                                <div class="col-md-6">
                                    <select name='group_id' id="group-list">
                                        <option value='0'>Any</option>
                                        @foreach ($groups as $item)
                                            <option value='{{$item->id}}'>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

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