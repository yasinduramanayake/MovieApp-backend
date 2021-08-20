<?php

namespace Modules\Payment\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentResourceCollection extends ResourceCollection
{
    /**
     * @var array
     */
    private $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage(),
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'pagination' => $this->pagination,
        ];
    }
}