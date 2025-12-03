<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PeopleCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        $path = $request->url();
        $query = $request->query();
        $currentPage = $this->currentPage();
        $lastPage = $this->lastPage();
        
        $firstUrl = $path . '?' . http_build_query(array_merge($query, ['page' => 1]));
        $lastUrl = $path . '?' . http_build_query(array_merge($query, ['page' => $lastPage]));
        $prevUrl = $currentPage > 1 ? $path . '?' . http_build_query(array_merge($query, ['page' => $currentPage - 1])) : null;
        $nextUrl = $currentPage < $lastPage ? $path . '?' . http_build_query(array_merge($query, ['page' => $currentPage + 1])) : null;

        return [
            'data' => PeopleResource::collection($this->collection),
            'links' => [
                'first' => $firstUrl,
                'last' => $lastUrl,
                'prev' => $prevUrl,
                'next' => $nextUrl,
            ],
            'meta' => [
                'current_page' => $currentPage,
                'from' => $this->firstItem() ? ($currentPage - 1) * $this->perPage() + 1 : null,
                'last_page' => $lastPage,
                'path' => $path,
                'per_page' => $this->perPage(),
                'to' => $this->lastItem() ? min($currentPage * $this->perPage(), $this->total()) : null,
                'total' => $this->total(),
            ]
        ];
    }

    public function withResponse($request, $response)
    {
        $response->header('Content-Type', 'application/vnd.api+json');
    }
}