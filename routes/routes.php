<?php

/**
 * |--------------------------------------------------------------------------
 * | Route group for ADMIN only.
 * |--------------------------------------------------------------------------
 */
Route::group(['middleware' => ['role:admin']], function () {
    /**
     * |--------------------------------------------------------------------------
     * | Create staff
     * |--------------------------------------------------------------------------
     */

    Route::group(['prefix' => 'products'], function () {

        /**
         * Products
         */
        Route::get('create-product', '\Klsandbox\ProductRoute\Http\Controllers\ProductManagementController@getCreateProduct');
        Route::post('create-product', '\Klsandbox\ProductRoute\Http\Controllers\ProductManagementController@postCreateProduct');
        Route::get('delete/{product}', '\Klsandbox\ProductRoute\Http\Controllers\ProductManagementController@getDelete');
        Route::get('edit/{product}', '\Klsandbox\ProductRoute\Http\Controllers\ProductManagementController@getEdit');
        Route::get('list', '\Klsandbox\ProductRoute\Http\Controllers\ProductManagementController@getList');
        Route::get('all', '\Klsandbox\ProductRoute\Http\Controllers\ProductManagementController@getListAll');
        Route::post('update/{product}', '\Klsandbox\ProductRoute\Http\Controllers\ProductManagementController@postUpdate');

    });
});


Route::bind('product_pricing', function ($id) {
    $productPricing = \Klsandbox\OrderModel\Models\ProductPricing::find($id);
    \Klsandbox\SiteModel\Site::protect($productPricing, 'Product Pricing');
    return $productPricing;
});

Route::bind('product', function ($id) {
    $product = \Klsandbox\OrderModel\Models\Product::find($id);
    \Klsandbox\SiteModel\Site::protect($product, 'Product');
    return $product;
});
