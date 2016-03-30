@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Products', 'page_title' => 'View All Products'])
@endsection

@section('content')
    @include('elements.success-message-partial')

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">View All Products</h2>
        </header>
        <div class="panel-body">
            @include('product-route::list-table-partial')
        </div>
    </section>
@endsection
