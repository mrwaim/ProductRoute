<div class="table-responsive">
    <table class="{{isset($table_class) ? $table_class : 'table table-bordered table-striped table-condensed mb-none'}}" id="table-list-product">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
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
                <td>@foreach(explode(PHP_EOL, $item->description) as $line ){{$line}}<br/>@endforeach</td>
                <td>@if($item->price != $item->price_east)@money($item->price)/@money($item->price_east) @else @money($item->price) @endif</td>
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
