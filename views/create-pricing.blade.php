@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Pricing</div>
                    <div class="panel-body">
                        @include('elements.error-message-partial')

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/product-management/create-pricing') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product</label>

                                <div class="col-md-6">
                                    <select name='product_id'>
                                        @foreach ($products as $item)
                                            <option value='{{$item->id}}'>{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            // TODO: Support ALL

                            <div class="form-group">
                                <label class="col-md-4 control-label">Level</label>

                                <div class="col-md-6">
                                    <select name='role_id'>
                                        @foreach ($roles as $item)
                                            <option value='{{$item->id}}'>{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
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