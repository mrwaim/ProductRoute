@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products Unit', 'page_title' => 'Create Product Unit'])
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Create Product Unit</h2>
        </div>
        <div class="panel-body">
            <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST"
                  action="{{ url('/products/units') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-md-3 control-label">Unit Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Unit Description</label>

                    <div class="col-md-6">
                        <textarea rows="10" class="form-control" name="description" required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection