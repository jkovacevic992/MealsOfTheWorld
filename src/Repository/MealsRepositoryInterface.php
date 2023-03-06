<?php

namespace App\Repository;

interface MealsRepositoryInterface
{
    public function findMeals(array $requestData):?array;

}