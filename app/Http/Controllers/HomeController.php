<?php

namespace App\Http\Controllers;

use App\Charts\ProductChart;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $chart = new ProductChart();
        $months = collect([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ]);

        $chart->labels($months);

        $products = Product::active()->where('user_id', $user->id)->with('category')->get();

        $countProduct = $products->count();

        $categories = Category::active()->get();

        $dataCharts = [];

        foreach ($products as $product) {
            foreach ($months as $month) {
                $dataCharts[$product->category->name][$month] = 0;
                if ($product->created_at->format('F') == $month) {
                    $dataCharts[$product->category->name][$month] += $product->unit_price;
                }
            }
        }

        return view('dashboard.index', [
            'dataCharts' => $dataCharts,
            'countProduct' => $countProduct,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function generateColor()
    {
        $color = '#';
        for ($i = 0; $i < 6; ++$i) {
            $color .= dechex(rand(0, 15));
        }

        return $color;
    }
}
