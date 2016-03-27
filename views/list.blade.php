@extends('app')

@section('page-header')
    <h2>Products</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Products</span></li>
            <li><span>View All Products</span></li>
        </ol>

        <div class="sidebar-right-toggle"></div>
    </div>
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
