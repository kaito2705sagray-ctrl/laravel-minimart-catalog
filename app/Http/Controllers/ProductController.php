<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Product;
use Illuminate\Foundation\Exceptions\RegisterErrorViewPaths;
use Illuminate\Http\Request;
use Override;

class ProductController extends Controller
{
    private $product;
    private $section;

    public function __construct(Product $product , Section $section)
    {
        $this->product = $product;
        $this->section = $section;
    }

    public function index()
    {
        $all_products = $this->product->orderBy('id', 'asc')->get();

        return view('products.index')->with('all_products', $all_products);
    }

    public function create()
    {
        $all_sections = $this->section->orderBy('id', 'asc')->get();

        return view('products.create')->with('all_sections', $all_sections);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:1024',
            'price' => 'required|max:5',
            'quantity' => 'required|integer|max digits:5',
            'section' => 'required',
        ]);

        $this->product->name = $request->name;
        $this->product->description = $request->description;
        $this->product->price = $request->price;
        $this->product->quantity = $request->quantity;
        $this->product->section_id = $request->section;
        $this->product->save();

        return redirect()->route('index');
    }

    public function delete($id)
    {
        $product = $this->product->FindOrFail($id);

        $product->delete();

        return redirect()->back();
    }

    public function edit(Product $product)
    {
        $all_sections = $this->section->orderBy('id', 'asc')->get();

        return view('products.edit')->with([ 'all_sections' => $all_sections, 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:1024',
            'price' => 'required|max:5',
            'quantity' => 'required|integer|max digits:5',
            'section' => 'required|',
        ]);

        $product = $this->product->FindOrFail($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->section_id = $request->section;
        $product->save();

        return redirect()->route('index');
    }

    public function buy(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|max digits:5',
        ]);

        $product = $this->product->findOrFail($id);

        $current_quantity = $product->quantity;
        $buy_quantity = $request->quantity;

        $quantity_in_stock = $current_quantity - $buy_quantity;

        $product->quantity = $quantity_in_stock;
        $product->save();

        return redirect()->back()->with(['buy_product' => 'Your purchase has been implemented !']);

    }

}
