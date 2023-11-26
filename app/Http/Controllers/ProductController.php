<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }
        $products = Product::where('user_id', $user->id)->active()->with('category')->get();

        return view('dashboard.products.index',
            [
                'products' => $products, ]
        );
    }

    public function create()
    {
        $categories = Category::where('status', Category::$active)->get();

        $categories = $categories->map(function ($category) {
            return [
                'value' => $category->id,
                'label' => $category->name,
            ];
        });

        return view('dashboard.products.create', [
            'categories' => $categories,
        ]);
    }

    public function update($product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            notify()->error('Product not found!');

            return redirect()->route('products.index');
        }

        $categories = Category::where('status', Category::$active)->get();

        $categories = $categories->map(function ($category) {
            return [
                'value' => $category->id,
                'label' => $category->name,
            ];
        });

        return view('dashboard.products.edit', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    public function updateProduct(Request $request, $product_id)
    {
        $this->validationProduct($request);

        $product = Product::find($product_id);
        if (!$product) {
            notify()->error('Product not found!');

            return redirect()->route('products.index');
        }

        $product->product_name = $request->product_name;
        $product->slug = $this->getSlug($request->product_name);
        $product->category_id = $request->product_category;
        $product->unit_price = $request->unit_price;
        $product->quantity = $request->product_quantity;
        $product->unit = $request->product_unit;
        $product->description = $request->product_description;
        $product->harvest_date = $request->harvest_date;
        $product->harvest_time = $request->harvest_time;
        $product->status = $request->product_status;

        $product->save();

        if ($request->has('product_images')) {
            $images = [];
            foreach ($request->product_images as $image) {
                $image_name = $this->uploadImage($image);
                $images[] = $image_name;
            }
            $product->images = json_encode($images);
            $product->save();
        }

        notify()->success('Product updated successfully!');

        return redirect()->route('products.index');
    }

    public function categories()
    {
        $categories = Category::all();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $category = Category::where('slug', $this->getSlug($request->category_name))->first();
        if ($category) {
            notify()->error('Category already exists!');

            return redirect()->route('categories.index');
        }

        $category = new Category();
        $category->name = $request->category_name;
        $category->slug = $this->getSlug($request->category_name);
        $category->status = $request->status;

        $category->save();
        notify()->success('Category created successfully!');

        return redirect()->route('categories.index');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $category = Category::find($id);
        if (!$category) {
            notify()->error('Category not found!');

            return redirect()->route('categories.index');
        }

        $category->name = $request->category_name;
        $category->slug = $this->getSlug($request->category_name);
        $category->status = $request->status;

        $category->save();
        notify()->success('Category updated successfully!');

        return redirect()->route('categories.index');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            notify()->error('Category not found!');

            return redirect()->route('categories.index');
        }

        $category->delete();
        notify()->success('Category deleted successfully!');

        return redirect()->route('categories.index');
    }

    public function getSlug($string)
    {
        $string = strtolower($string);
        $string = str_replace(' ', '-', $string);

        return $string;
    }

    public function storeProduct(Request $request)
    {
        $this->validationProduct($request);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->slug = $this->getSlug($request->product_name);
        $product->product_code = $this->generateProductCode();
        $product->category_id = $request->product_category;
        $product->user_id = auth()->user()->id;
        $product->unit_price = $request->unit_price;
        $product->quantity = $request->product_quantity;
        $product->unit = $request->product_unit;
        $product->description = $request->product_description;
        $product->harvest_date = $request->harvest_date;
        $product->harvest_time = $request->harvest_time;
        $product->status = $request->product_status;

        $product->save();

        $images = [];
        if ($request->has('product_images')) {
            foreach ($request->product_images as $image) {
                $image_name = $this->uploadImage($image);
                $images[] = $image_name;
            }
        }

        $product->images = json_encode($images);
        $product->save();

        notify()->success('Product created successfully!');

        return redirect()->route('products.index');
    }

    public function validationProduct($request)
    {
        $request->validate([
              'product_name' => 'required',
              'unit_price' => 'required',
              'product_quantity' => 'required',
              'product_unit' => 'required',
              'product_description' => 'required',
              'product_images.*' => 'image',
              'harvest_date' => 'required|Date',
              'harvest_time' => 'required|date_format:H:i',
              'product_status' => 'required',
              'product_category' => 'required|exists:categories,id',
          ]);

        return redirect()->back();
    }

    public function uploadImage($image)
    {
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $image_name);

        return $image_name;
    }

    public function generateProductCode()
    {
        $prefix = 'PRD-';
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $randomPartLength = 6;
        $randomPart = '';
        for ($i = 0; $i < $randomPartLength; ++$i) {
            $randomPart .= $characters[random_int(0, strlen($characters) - 1)];
        }

        $productCode = $prefix.$randomPart;

        return $productCode;
    }

    public function destroyProduct($product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            notify()->error('Product not found!');

            return redirect()->route('products.index');
        }

        $product->delete();
        notify()->success('Product deleted successfully!');

        return redirect()->route('products.index');
    }
}
