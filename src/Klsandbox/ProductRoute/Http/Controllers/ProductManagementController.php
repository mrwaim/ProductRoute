<?php

namespace Klsandbox\ProductRoute\Http\Controllers;

use App\Models\BonusCategory;
use Klsandbox\OrderModel\Models\Product;
use Auth;
use Input;
use Klsandbox\OrderModel\Models\ProductPricing;
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
            'image' => 'required|image'
        ]);
    }

    public function updateValidator(array $data)
    {
        return \Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image'
        ]);
    }

    public function getEdit(ProductPricing $productPricing)
    {
        $bonusCategories = BonusCategory::forSite()->get();

        return view('product-route::edit-product')
            ->with('bonusCategories', $bonusCategories)
            ->withGroups(\App\Models\Group::forSite()->get())
            ->withProductPricing($productPricing);
    }

    public function getList()
    {

        return view('product-route::list')
            ->with('products', Product::getList());
    }

    public function getCreateProduct()
    {
        $bonusCategories = BonusCategory::forSite()->get();
        return view('product-route::create-product')
            ->with('bonusCategories', $bonusCategories)
            ->withGroups(\App\Models\Group::forSite()->get());
    }

    public function postCreateProduct()
    {
        $messages = $this->validator(Input::all());

        if ($messages->messages()->count() && Auth::user()->role_id === Role::Admin()->id) {
            return redirect()
                ->back()
                ->withInput()
                ->withGroups(\App\Models\Group::forSite()->get())
                ->withErrors($messages);
        }

        $inputs = Input::all();

        $file = Input::file('image');
        $destination = public_path() . '/uploads/';
        $extension = $file->getClientOriginalExtension();
        $fileName = bin2hex(random_bytes(32)) . '.' . $extension;
        $file->move($destination, $fileName);

        $inputs['image'] = '/uploads/' . $fileName;
        $inputs = array_except($inputs, ['_token']);

        $this->model->createNew($inputs);

        Session::flash('success_message', 'Product has been created.');

        return Redirect::to('/products/list');
    }

    public function postUpdate(ProductPricing $productPricing)
    {
        $messages = $this->updateValidator(Input::all());

        if ($messages->messages()->count() && Auth::user()->role_id === Role::Admin()->id) {
            return view('product-route::edit-product')
                ->withProductPricing($productPricing)
                ->withGroups(\App\Models\Group::forSite()->get())
                ->withErrors($messages);
        }

        $inputs = Input::all();

        if(Input::hasFile('image'))
        {
            $file = Input::file('image');
            $destination = public_path('uploads/');
            $extension = $file->getClientOriginalExtension();
            $fileName = bin2hex(random_bytes(32)) . '.' . $extension;
            $file->move($destination, $fileName);

            $inputs['image'] = 'uploads/' . $fileName;

            if(\File::exists(public_path($productPricing->product->image)))
            {
                \File::delete(public_path($productPricing->product->image));
            }
        }

        $productPricing->price = $inputs['price'];
        $productPricing->save();

        if ($inputs['group_id'])
        {
            $productPricing->groups()->sync([$inputs['group_id']]);
        }
        else
        {
            $productPricing->groups()->sync([]);
        }

        $inputs = array_except($inputs, ['group_id', 'price', '_token']);

        $productPricing->product->update($inputs);

        Session::flash('success_message', 'Product has been updated.');

        return Redirect::to('/products/list');
    }

    public function getDelete(Product $product)
    {
        $this->model->setUnavailable($product->id);

        Session::flash('success_message', 'Product has been deleted.');

        return Redirect::to('/products/list');
    }

}
