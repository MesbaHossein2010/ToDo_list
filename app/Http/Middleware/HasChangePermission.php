<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasChangePermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        if (str_contains($request->path(), 'categories')) {
            $item = Category::find($id);
        } else {
            $item = Task::find($id);
        }
        if ($item->user->id == Auth::user()->id) {
            return $next($request);
        } else {
            abort(403, 'You can\'t access someone else\'s item.');
        }
    }
}
