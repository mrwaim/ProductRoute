<?php

/**
 * |--------------------------------------------------------------------------
 * | Route group for ADMIN only.
 * |--------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth.admin']], function () {
    /**
     * |--------------------------------------------------------------------------
     * | Create staff
     * |--------------------------------------------------------------------------
     */


    Route::controllers([
        'products' => '\Klsandbox\ProductRoute\Http\Controllers\ProductManagementController',
    ]);
});
