<div class="table-responsive">
    <table class="{{isset($table_class) ? $table_class : 'table table-bordered table-striped table-condensed mb-none'}}">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            @if(! $config->group_enabled)
            <th>Group</th>
            <th>Price</th>
            @endif
            <th>Bonus Category</th>
            @if($auth->admin)
                <th>Delete</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($products as $item)
            <tr>
                <td>@products-link($item)</td>
                <td>{{ $item->name }}</td>
                <td>@foreach(explode(PHP_EOL, $item->description) as $line ){{$line}}<br/>@endforeach</td>
                @if(! $config->group_enabled)
                <td>{{ $item->productPricing->groups()->first() ? $item->productPricing->groups()->first()->name : 'Any' }}</td>
                <td>{{ $item->productPricing->price }}</td>
                @endif
                <td>{{ $item->bonusCategory ? $item->bonusCategory->friendly_name : 'Any' }}</td>
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
