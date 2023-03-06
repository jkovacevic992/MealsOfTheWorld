<?php

namespace App\Utils;

use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PaginatorHelper
{
    private PaginatorInterface $paginator;

    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @param Request $request
     * @param array $dataArray
     * @return PaginationInterface|null
     */
    public function paginate(Request $request, array $dataArray): ?PaginationInterface
    {
        $pagination = null;
        $requestData = $request->query->all();
        if (array_key_exists('per_page', $requestData)
            && array_key_exists('page', $requestData)) {
            $pagination = $this
                ->paginator
                ->paginate(
                    $dataArray,
                    $request->query->getInt('page'),
                    $requestData['per_page']
                );
        } elseif (array_key_exists('per_page', $requestData)
            && !array_key_exists('page', $requestData)) {
            $pagination = $this->paginator->paginate($dataArray, 1, $requestData['per_page']);
        }
        return $pagination;
    }
}
