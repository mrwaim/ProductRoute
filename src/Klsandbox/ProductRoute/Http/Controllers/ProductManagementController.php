<?php

namespace Klsandbox\ProductRoute\Http\Controllers;

use Klsandbox\OrderModel\Models\Product;
use Auth;
use Input;
use Klsandbox\RoleModel\Role;
use Redirect;
use Session;

use App\Http\Controllers\Controller;

class ProductManagementController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Product();
        $this->middleware('auth');
    }

    public function validator(array $data)
    {
        return \Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);
    }

    public function getList()
    {
        return view('product-route::list')
            ->with('products', Product::getList());
    }

    public function getCreateProduct()
    {
        return view('product-route::create-product');
    }

    public function postCreateProduct()
    {
        $messages = $this->validator(Input::all());

        if ($messages->messages()->count() && Auth::user()->role_id === Role::Admin()->id) {
            return view('product-route::.create-product')
                ->withErrors($messages);
        }

        $this->model->createNew(Input::all());

        Session::flash('success_message', 'Product has been created.');

        return Redirect::to('/products/list');
    }

    public function getDelete($id)
    {
        $validate = \Validator::make(['id' => $id], [
            'id' => 'required|numeric',
        ]);

        if (!$validate->messages()->count() && Auth::user()->role_id === Role::Admin()->id) {
            $this->model->setUnavailable($id);
        }

        Session::flash('success_message', 'Product has been deleted.');

        return Redirect::to('/products/list');
    }
}
