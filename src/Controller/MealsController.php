<?php

namespace App\Controller;

use App\Repository\MealsRepositoryInterface;
use App\Utils\DataSorter;
use App\Utils\PaginatorHelper;
use App\Utils\ResponseDataCleaner;
use App\Validator\RequestValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MealsController extends AbstractController
{
    private RequestValidator $validator;
    private MealsRepositoryInterface $mealsRepository;
    private DataSorter $dataSorter;
    private ResponseDataCleaner $dataCleaner;
    private PaginatorHelper $paginatorHelper;

    /**
     * @param RequestValidator $validator
     * @param MealsRepositoryInterface $mealsRepository
     * @param DataSorter $dataSorter
     * @param ResponseDataCleaner $dataCleaner
     * @param PaginatorHelper $paginatorHelper
     */
    public function __construct(
        RequestValidator $validator,
        MealsRepositoryInterface $mealsRepository,
        DataSorter $dataSorter,
        ResponseDataCleaner $dataCleaner,
        PaginatorHelper $paginatorHelper
    ) {
        $this->validator = $validator;
        $this->mealsRepository = $mealsRepository;
        $this->dataSorter = $dataSorter;
        $this->dataCleaner = $dataCleaner;
        $this->paginatorHelper = $paginatorHelper;
    }

    #[Route('/meals', name: 'app_meals')]
    public function index(Request $request): Response
    {
        $requestData = $request->query->all();
        if ($this->validator->validateRequestParameters($request)) {
            if (array_key_exists('tags', $requestData)) {
                $meals = $this->dataCleaner->cleanByTag(
                    $requestData,
                    $this->mealsRepository->findMeals($requestData)
                );
            } else {
                $meals = $this->mealsRepository->findMeals($requestData);
            }
            $pagination = $this->paginatorHelper->paginate($request, $meals);
            if ($pagination) {
                $dataArray = $this->dataSorter->sortData(
                    $pagination->getItems(),
                    $this->dataSorter->sortResponseMetaData($pagination),
                    $this->dataSorter->sortLinksData($request, $pagination)
                );
            } else {
                $dataArray = $this->dataSorter->sortData($meals);
            }

            if (empty($dataArray['data'])) {
                return $this->json('No meals with requested parameters');
            }

            return $this->json($dataArray, 200, [], ['json_encode_options' => JSON_UNESCAPED_SLASHES]);
        }

        return $this->json($this->validator->getErrorMessage());
    }
}
