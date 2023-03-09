<?php

namespace App\Utils;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Component\HttpFoundation\Request;

class DataSorter
{
    /**
     * Sorts the "meta" part of the response
     * @param SlidingPagination $pagination
     * @return array
     */
    public function sortResponseMetaData(SlidingPagination $pagination): array
    {
        $dataArray['currentPage'] = $pagination->getCurrentPageNumber();
        $dataArray['totalItems'] = $pagination->getTotalItemCount();
        $dataArray['itemsPerPage'] = $pagination->getItemNumberPerPage();
        $dataArray['totalPages'] = $pagination->getPageCount();

        return $dataArray;
    }

    /**
     * @param array $data
     * @param array $meta
     * @param array $links
     * @return array
     */
    public function sortData(array $data, array $meta, array $links): array
    {
        $dataArray['meta'] = $meta;
        $dataArray['links'] = $links;
        $dataArray['data'] = $data;
        return $dataArray;
    }

    /**
     * @param Request $request
     * @param SlidingPagination $pagination
     * @return array
     */
    public function sortLinksData(Request $request, SlidingPagination $pagination): array
    {
        $currentUrl = $request->getHttpHost() .$request->getRequestUri();
        if (array_key_exists('previous', $pagination->getPaginationData())) {
            $prevUrl = Request::create($currentUrl, 'GET', ['page'=> $pagination->getPaginationData()['previous']]);
            $dataArray['prev'] = urldecode($prevUrl->getHttpHost() . $prevUrl->getRequestUri());
        } else {
            $dataArray['prev'] = null;
        }
        $dataArray['self'] = $currentUrl;
        if (array_key_exists('next', $pagination->getPaginationData())) {
            $nextUrl = Request::create($currentUrl, 'GET', ['page'=> $pagination->getPaginationData()['next']]);
            $dataArray['next'] = urldecode($nextUrl->getHttpHost() . $nextUrl->getRequestUri());
        } else {
            $dataArray['next'] = null;
        }
        return $dataArray;
    }
}
