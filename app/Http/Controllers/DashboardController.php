<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subscriber;
use App\Models\Testimonial;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $ordersPending = Order::where('status', 'pending')->count();
        $ordersConfirmed = Order::where('status', 'confirmed')->count();
        $ordersShipped = Order::where('status', 'shipped')->count();
        $ordersDelivered = Order::where('status', 'delivered')->count();
        $ordersCancelled = Order::where('status', 'cancelled')->count();

        $revenueDelivered = Order::where('status', 'delivered')->sum('total');
        $now = now();
        $revenueThisMonth = Order::where('status', 'delivered')
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->sum('total');

        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $subscribersCount = Subscriber::count();
        $testimonialsCount = Testimonial::count();

        $recentOrders = Order::latest()->limit(10)->get(['id','customer_name','total','status','created_at']);
        $lowStockProducts = Product::with('category')
            ->orderBy('stock')
            ->limit(10)
            ->get(['id','name','stock','category_id','image_path']);
        $topCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get(['id','name']);
        $topOrderedProducts = OrderItem::selectRaw('product_id, SUM(quantity) as qty')
            ->groupBy('product_id')
            ->orderByDesc('qty')
            ->limit(5)
            ->get();

        $months = collect(range(0, 11))
            ->map(function ($i) {
                $d = now()->subMonths(11 - $i)->startOfMonth();
                return $d;
            });
        $chartLabels = $months->map(function ($d) { return $d->format('M Y'); });
        $chartRevenue = $months->map(function ($d) {
            return (float) order::where('status', 'delivered')
                ->whereBetween('created_at', [$d, (clone $d)->endOfMonth()])
                ->sum('total');
        });
        $chartOrders = $months->map(function ($d) {
            return (int) order::whereBetween('created_at', [$d, (clone $d)->endOfMonth()])->count();
        });

        return view('admin.pages.dashboard', compact(
            'totalOrders',
            'ordersPending',
            'ordersConfirmed',
            'ordersShipped',
            'ordersDelivered',
            'ordersCancelled',
            'revenueDelivered',
            'revenueThisMonth',
            'productsCount',
            'categoriesCount',
            'subscribersCount',
            'testimonialsCount',
            'recentOrders',
            'lowStockProducts',
            'topCategories',
            'topOrderedProducts',
            'chartLabels',
            'chartRevenue',
            'chartOrders'
        ));
    }
}
