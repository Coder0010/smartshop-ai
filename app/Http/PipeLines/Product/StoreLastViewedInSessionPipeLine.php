<?php

namespace App\Http\PipeLines\Product;

use Closure;
use Illuminate\Http\Request;

class StoreLastViewedInSessionPipeLine
{
    /**
     * Handle the pipeline logic for storing last viewed products in session.
     *
     * @param  array{0: Request, 1: int, 2: int}  $payload
     * @param  Closure  $next  (array{0: Request, 1: int, 2: int, 3: \Illuminate\Support\Collection<int,int>>): mixed  $next
     */
    public function handle(array $payload, Closure $next): mixed
    {
        [$request, $id, $limit] = $payload;

        $lastViewedIds = collect((array) $request->session()->get('last_viewed', []))
            ->filter(fn ($pid) => is_numeric($pid))
            ->reject(fn ($pid) => $pid == $id)
            ->prepend($id)
            ->unique()
            ->take($limit)
            ->values();

        $request->session()->put('last_viewed', $lastViewedIds->all());

        return $next([$request, $id, $limit, $lastViewedIds]);
    }
}
