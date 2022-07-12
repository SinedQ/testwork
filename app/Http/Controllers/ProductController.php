<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    /**
     * @return View|Factory|Response|Application
     */
    public function index(): View|Factory|Response|Application
    {
        $products = Product::get();
        return view('index', ['products' => $products]);
    }

    /**
     * @param CreateProductRequest $request
     * @return RedirectResponse
     */
    public function store(CreateProductRequest $request): RedirectResponse
    {
        $data = [
            'color' => $request->input('color'),
            'size' => $request->input('size')
        ];
        $products = Product::create([
            'article' => $request->input('article'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'data' => ($data)
        ]);
        if ($products) {
            return redirect()->route('product.index')->with('success', 'Продукт создан');
        }
        return back()->withInput()->with('error', 'Продукт не создан');
    }

    /**
     * @return View
     */
    public function create(): View
    {

        return view('create');
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $product = Product::where('id', $id)->first();
        return view('show', compact("product"));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $products = Product::find($id);
        return view('edit', compact('products'));
    }

    /**
     * @param UpdateProductRequest $request
     * @param int $id
     * @return View|Factory|Application
     */
    public function update(UpdateProductRequest $request, int $id): View|Factory|Application
    {
        $products = Product::find($id);
        $data = [
            'color' => $request->input('color'),
            'size' => $request->input('size')
        ];
        $products = Product::where('id', $id)->update([
            'article' => $request->input('article'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'data' => json_encode($data)
        ]);
        $products = Product::get();
        return view('index', ['products' => $products]);
    }


    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $products = Product::find($id);
        $products->delete();

        return redirect()->route('product.index')->with('del', 'Продукт успешно удален.');
    }
}
