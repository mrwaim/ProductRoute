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
                                <label class="col-md-4 control-label">Product Name *</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Description *</label>
                                <div class="col-md-6">
                                    <textarea rows="10" class="form-control" name="description" required>{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="control-label col-md-4">Product Image *</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="image" id="image" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Bonus Category</label>
                                <div class="col-md-6">
                                    <select name='bonus_categories_id' class="form-control">
                                        <option value=''>Any</option>
                                        @foreach ($site_data->get('bonus_categories') as $item)
                                            <option value='{{$item->id}}'>{{ $item->friendly_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Max Quantity *</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="max_quantity"
                                           value="{{ old('max_quantity') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Min Quantity *</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="min_quantity"
                                           value="{{ old('min_quantity') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Hide</label>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="hidden_from_ordering" value="1" {{  (old('hidden_from_ordering') == '1')  ? 'checked' : '' }} />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="hidden_from_ordering" value="0" {{ (old('hidden_from_ordering') != '1')  ? 'checked' : '' }} />
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">HQ Product</label>
                                <div class="col-md-6">
                                    <label class="control-label">
                                        <input type="radio" name="is_hq" value="1" {{  (old('is_hq') != '0')  ? 'checked' : '' }} />
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="is_hq" value="0" {{ (old('is_hq') == '0')  ? 'checked' : '' }} />
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">For Customer</label>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="for_customer" value="1"{{  (old('for_customer') != '0')  ? 'checked' : '' }}/>
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="for_customer" value="0" {{ (old('for_customer') == '0')  ? 'checked' : '' }}/>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">For new user</label>

                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="new_user" value="1" {{  (old('new_user') != '0')  ? 'checked' : '' }}/>
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="new_user" value="0" {{ (old('new_user') == '0')  ? 'checked' : '' }}/>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Exipiry Date</label>
                                <div class="col-md-6">
                                    <input type="text" name="expiry_date" data-plugin-datepicker data-date-format="dd/mm/yyyy" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Role</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="role_id">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ (old('role') == $role->id) ? 'selected' : null }}> {{ $role->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Membership product ?</label>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="is_membership" value="1" {{  (old('is_membership') == '1')  ? 'checked' : '' }}/>
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="is_membership" value="0" {{ (old('is_membership') != '1')  ? 'checked' : '' }}/>
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Membership group</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="membership_group_id" {{ (old('is_membership') == '1') ? null : 'disabled' }}>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ (old('membership_group_id') == $group->id) ? 'selected' : null }}> {{ $group->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Price *</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="price" value="{{ old('price') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Price east *</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="price_east" value="{{ old('price_east') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Delivery </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="delivery" value="{{ old('delivery') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Delivery east</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="delivery_east" value="{{ old('delivery_east') }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Group</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="group_id">
                                        <option value=''>Any</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ (old('group_id') == $group->id) ? 'selected' : null }}> {{ $group->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group text-left">
                                <div class="col-md-6 col-md-offset-4">
                                    *) Required
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