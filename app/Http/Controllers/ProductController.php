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
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(): View|Factory|Response|Application
    {
        $products = Product::get();
        return view('index', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
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
     * Show the form for creating a new resource.
     *
     * @return View|
     */
    public function create(): View
    {

        return view('create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $product = Product::where('id', $id)->first();
        return view('show', compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $products = Product::find($id);
        return view('edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return Application|Factory|View
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
//        if ($products) {
//            return redirect()->route('product.index')->with('success', 'Продукт создан');
//        }
//
//        return back()->withInput()->with('error', 'Продукт не создан');
    }


    /**
     * Remove the specified resource from storage.
     *
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
