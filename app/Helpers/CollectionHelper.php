<?php

namespace App\Helpers;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CollectionHelper
{
    /**
     * @param Collection $results Collection items
     * @param int $total Total items
     * @param int $pageSize Items per page
     * @return LengthAwarePaginator
     */
    public static function paginate(Collection $results, $total, $pageSize)
    {
        $page = Paginator::resolveCurrentPage('page');
        
        return self::paginator($results->forPage($page, $pageSize), $total, $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ]);
    }
    
    /**
     * Create a new length-aware paginator instance.
     *
     * @param  \Illuminate\Support\Collection  $items Collection items
     * @param  int  $total Total items
     * @param  int  $perPage Items per page
     * @param  int  $currentPage Current Page number
     * @param  array  $options Additional options of a page
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function paginator(Collection $items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(
            LengthAwarePaginator::class,
            compact('items', 'total', 'perPage', 'currentPage', 'options')
        );
    }
}
