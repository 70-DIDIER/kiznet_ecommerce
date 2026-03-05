<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\orderItem;
use App\Models\product;
use App\Models\category;
use App\Models\Subscriber;
use App\Models\Testimonial;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = order::count();
        $ordersPending = order::where('status', 'pending')->count();
        $ordersConfirmed = order::where('status', 'confirmed')->count();
        $ordersShipped = order::where('status', 'shipped')->count();
        $ordersDelivered = order::where('status', 'delivered')->count();
        $ordersCancelled = order::where('status', 'cancelled')->count();

        $revenueDelivered = order::where('status', 'delivered')->sum('total');
        $now = now();
        $revenueThisMonth = order::where('status', 'delivered')
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->sum('total');

        $productsCount = product::count();
        $categoriesCount = category::count();
        $subscribersCount = Subscriber::count();
        $testimonialsCount = Testimonial::count();

        $recentOrders = order::latest()->limit(10)->get(['id','customer_name','total','status','created_at']);
        $lowStockProducts = product::with('category')
            ->orderBy('stock')
            ->limit(10)
            ->get(['id','name','stock','category_id','image_path']);
        $topCategories = category::withCount('products')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get(['id','name']);
        $topOrderedProducts = orderItem::selectRaw('product_id, SUM(quantity) as qty')
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
