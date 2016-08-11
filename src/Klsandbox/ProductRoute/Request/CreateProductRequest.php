<?php

namespace Klsandbox\ProductRoute\Request;

use App\Http\Requests\Request;

class CreateProductRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'max_purchase_count' => 'numeric',
        ];
    }
}
