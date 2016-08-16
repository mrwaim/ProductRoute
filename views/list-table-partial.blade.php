<div class="table-responsive">
    <table class="{{isset($table_class) ? $table_class : 'table table-bordered table-striped table-condensed mb-none'}}" id="table-list-product">
        <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Description</th>
            <th class="text-center">Price</th>
            <th class="text-center">Bonus Category</th>
            @if($auth->admin)
                <th width="15%" class="text-center">Action</th>
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
                    <td class="text-center">
                        <a href="/products/edit/{{ $item->id }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="/products/delete/{{ $item->id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
