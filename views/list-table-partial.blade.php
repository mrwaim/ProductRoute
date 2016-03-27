<div class="table-responsive">
    <table class="{{isset($table_class) ? $table_class : 'table table-bordered table-striped table-condensed mb-none'}}">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            @if($auth->admin)
                <th>Delete</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->price }}</td>
                @if($auth->admin)
                    <td>
                        <a href="/products/delete/{{ $item->id }}" class="panel-action panel-action-dismiss"></a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
