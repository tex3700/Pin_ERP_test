<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $currentProduct = Product::find(request()->route('product'));

        $articleRules = ['required', 'string', 'alpha_dash:ascii'];
        $articleRules[] =
            is_null($currentProduct)
            || request()->input('article') === $currentProduct->value('article')
            ? 'max:255'
            : Rule::prohibitedIf(!$this->user()->checkUserRole());

        return [
            'article' => $articleRules,
            'name' => ['required', 'string', 'min:10'],
            'status' => ['string', Rule::in(["available", "unavailable"])],
            'data' => ['json', 'nullable'],
        ];
    }
}
