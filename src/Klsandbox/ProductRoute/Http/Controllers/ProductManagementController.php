<?php

namespace Klsandbox\ProductRoute\Http\Controllers;

use App\Models\BonusCategory;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Klsandbox\OrderModel\Models\Product;
use Auth;
use Input;
use Klsandbox\OrderModel\Models\ProductUnit;
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

    public function getEdit(Product $product)
    {
        if (!config('group.enabled')) {
            $groups = null;
        } else {
            $groups = Group::all();
        }

        $bonusCategories = BonusCategory::all();
        $units = $product->units()->get();
        $productUnits = ProductUnit::whereNotIn('id', $units->pluck('id'))->get();

        $data = [
            'bonusCategories' => $bonusCategories,
            'groups' => $groups,
            'product' => $product,
            'productUnits' => $productUnits,
            'units' => $units
        ];

        return view('product-route::edit-product', $data);
    }

    public function getList()
    {
        return view('product-route::list')
            ->with('products', Product::getAvailableProductList());
    }

    public function getListAll()
    {
        return view('product-route::list')
            ->with('products', Product::getAllProductList());
    }

    public function getCreateProduct()
    {
        $bonusCategories = BonusCategory::all();

        return view('product-route::create-product')
            ->with('bonusCategories', $bonusCategories)
            ->withGroups(Group::all());
    }

    /**
     * Save new product
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateProduct()
    {
        $inputs = Input::all();

        if (!config('group.enabled')) {
            $messages = $this->createProductGroupDisabledValidator($inputs);
        } else {
            $messages = $this->createProductGroupEnabledValidator($inputs);
        }

        if ($messages->messages()->count() && Auth::user()->role_id === Role::Admin()->id) {
            return redirect()
                ->back()
                ->withInput()
                ->withGroups(Group::all())
                ->withErrors($messages);
        }

        $file = Input::file('image');
        $destination = public_path() . '/uploads/';
        $extension = $file->getClientOriginalExtension();
        $fileName = bin2hex(random_bytes(32)) . '.' . $extension;
        $file->move($destination, $fileName);

        $inputs['image'] = '/uploads/' . $fileName;
        $inputs = array_except($inputs, ['_token']);

        if (!config('group.enabled')) {
            $this->model->createProductGroupDisabled($inputs);
        } else {
            $this->model->createProductGroupEnabled($inputs);
        }

        Session::flash('success_message', 'Product has been created.');

        return Redirect::to('/products/list');
    }

    public function postUpdate(Product $product)
    {
        $inputs = Input::all();

        if (!config('group.enabled')) {
            $messages = $this->updateProductGroupDisabledValidator($inputs);
        } else {
            $messages = $this->updateProductGroupEnabledValidator($inputs);
        }

        if ($messages->messages()->count() && Auth::user()->role_id === Role::Admin()->id) {
            return view('product-route::edit-product')
                ->withProductPricing($productPricing)
                ->withGroups(Group::all())
                ->withErrors($messages);
        }

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destination = public_path('uploads/');
            $extension = $file->getClientOriginalExtension();
            $fileName = bin2hex(random_bytes(32)) . '.' . $extension;
            $file->move($destination, $fileName);

            $inputs['image'] = 'uploads/' . $fileName;

            if (\File::exists(public_path($product->image))) {
                \File::delete(public_path($product->image));
            }
        }

        if (!config('group.enabled')) {
            $this->model->updateProductGroupDisabled($product, $inputs);
        } else {
            $this->model->updateProductGroupEnabled($product, $inputs);
        }

        Session::flash('success_message', 'Product has been updated.');

        return Redirect::to('/products/list');
    }

    public function getDelete(Product $product)
    {
        $this->model->setUnavailable($product->id);

        Session::flash('success_message', 'Product has been deleted.');

        return Redirect::to('/products/list');
    }

    /**
     * Validator for create new product when group is disabled
     *
     * @param array $input
     *
     * @return mixed
     */
    public function createProductGroupDisabledValidator(array $input)
    {
        return Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
        ]);
    }

    /**
     * Validator for create product when group is enabled
     *
     * @param array $input
     */
    public function createProductGroupEnabledValidator(array $input)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ];

        return Validator::make($input, $rules);
    }

    /**
     * Validator for create product when group is disabled
     *
     * @param array $input
     *
     * @return mixed
     */
    public function updateProductGroupDisabledValidator(array $input)
    {
        return Validator::make($input, [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image',
        ]);
    }

    /**
     * Validator for create product when group is enabled
     *
     * @param array $input
     *
     * @return mixed
     */
    public function updateProductGroupEnabledValidator(array $input)
    {
        return Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);
    }

    public function storeUnits(Request $request, $product)
    {
        $product->units()->attach(
            $request->input('product_unit_id'),
            ['quantity' => $request->input('product_unit_id')]
        );

        flash()->success('Success!', 'Unit has been added');

        return redirect()->back();

    }

    public function deleteUnits($product, $productUnit)
    {
        $product->units()->detach($productUnit->id);

        flash()->success('Success!', 'Unit has been deleted');

        return redirect()->back();
    }
}
