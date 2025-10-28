<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckProductLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // if (!$user) {
        //     return redirect()->route('login');
        // }

        $productCount = Product::where('user_id', $user->id)->count();

        if ($productCount >= 5) {
            return redirect()->route('products.index')
                ->with('error', 'You cannot create more than 5 products.');
        }

        return $next($request);
    }
}
