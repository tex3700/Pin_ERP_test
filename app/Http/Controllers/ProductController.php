<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Jobs\SendProductCreatedNotification;
use App\Models\Product;
use Illuminate\Http\{ Request, RedirectResponse };
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\{ Factory, View };
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Product $product): Factory|View|Application
    {
        return view('dashboard', [
            # Local Scope для получения только доступных продуктов (STATUS = “available”)
            'productList' => $product->available()->get(),

            # Получение всех продуктов из базы
            //'productList' => $product->all(),
        ]);
    }

    public function show(int $id): Factory|View|Application
    {
        return view('product-card')->with('product', Product::findOrFail($id));
    }

    public function store(StoreProductRequest $request, Product $product): RedirectResponse
    {
//        dd($request);
        if (!empty($request->old())) {
            $product->fill($request->old());
        }

        if ($product->fill($request->validated())->save()) {

            dispatch(new SendProductCreatedNotification($product));

            return redirect()->route('show', $product['id'])
                ->with('success', __('Продукт успешно добавлен'));
        }

        return back()->with('error', __('Не удалось добавить продукт'));
    }

    public function edit(Product $product): Factory|View|Application
    {
        return view('edit-product', [
            'product' => $product,
        ]);
    }

    public function update(StoreProductRequest $request, Product $product,): RedirectResponse
    {
        if ($product->fill($request->validated())->update()) {
            return redirect()->route('show', $product['id'])
                ->with('success', __('Продукт успешно обновлен'));
        }

        return back()->with('error', __('Неудалось обновить продукт'));
    }

    public function destroy(Product $product): JsonResponse|Redirector|RedirectResponse|Application
    {
        try {
            $deleted =  $product->delete();
            if ($deleted === false) {
                return response()->json( "error", 400);
            }
            return response()->json("ok");

        } catch (\Exception $exception) {
            return response()->json( "error", 400);
        }
    }

}
