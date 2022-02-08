<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

trait ApiResponser
{
    
    protected function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }
    
    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
    
    protected function showAll(Collection $collection, $code = 200)
    {
        if($collection->isEmpty()){
            return $this->successResponse(['data' => $collection], $code);
        }

        $collection = $this->filter($collection);
        $collection = $this->sort($collection);
        $collection = $this->sortDesc($collection);
        $collection = $this->group($collection);
        $collection = $this->paginate($collection);
        return $this->successResponse( $collection, $code);
    }
    
    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse($instance, $code);
    }
    
    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function filter(Collection $collection)
    {

        $first = $collection->first();
        $first = collect($first);

        foreach( request()->query() as $query => $value )
        {

            if( $first->has($query) )
            {
                $collection = $collection->where($query, $value);
            }

        }
        return $collection;
    }

    protected function sort(Collection $collection)
    {
        return ( request()->has('sort_by') )? $collection->sortBy->{request()->sort_by} : $collection;
    }

    protected function sortDesc(Collection $collection)
    {
        return ( request()->has('sort_by_desc') )? $collection->sortByDesc->{request()->sort_by_desc} : $collection;
    }

    protected function group(Collection $collection)
    {
        return ( request()->has('group_by') )? $collection->groupBy->{request()->group_by} : $collection;
    }

    protected function paginate(Collection $collection)
    {

        $page = LengthAwarePaginator::resolveCurrentPage();
        Validator::make( request()->all(), ['per_page' => 'integer|min:10|max:500'])->validate();
        $perPage = ( request()->has('per_page') )? (int) request()->per_page : 10;
        $results = $collection->slice( ($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return $paginated->appends( request()->all() );
    }
}