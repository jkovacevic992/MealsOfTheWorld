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

    /**
     * @param RequestValidator $validator
     * @param MealsRepositoryInterface $mealsRepository
     * @param DataSorter $dataSorter
     * @param ResponseDataCleaner $dataCleaner
     * @param PaginatorHelper $paginatorHelper
     */
    public function __construct(
        private readonly RequestValidator         $validator,
        private readonly MealsRepositoryInterface $mealsRepository,
        private readonly DataSorter               $dataSorter,
        private readonly ResponseDataCleaner      $dataCleaner,
        private readonly PaginatorHelper          $paginatorHelper
    ) {}

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
            $meals = $this->dataCleaner->unsetTags($requestData, $meals);
            $pagination = $this->paginatorHelper->paginate($request, $meals);
            $dataArray = $this->dataSorter->sortData(
                    $pagination->getItems(),
                    $this->dataSorter->sortResponseMetaData($pagination),
                    $this->dataSorter->sortLinksData($request, $pagination)
                );
            return $this->json(data: $dataArray, context: ['json_encode_options' => JSON_UNESCAPED_SLASHES]);
        }
        return $this->json(data: $this->validator->getErrorMessage(), status: 404);
    }
}
