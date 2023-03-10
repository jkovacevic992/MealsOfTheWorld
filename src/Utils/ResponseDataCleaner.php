<?php

namespace App\Utils;

class ResponseDataCleaner
{
    /**
     * Created to remove meals that don't have all the required tags as I had issues with doing it through the query
     * @param array $requestData
     * @param array $meals
     * @return array
     */
    public function cleanByTag(array $requestData, array $meals): array
    {
        $tags = explode(',', $requestData['tags']);
        $mealIds = [];

        foreach ($meals as $mealKey => $meal) {
            $tagDiff = [];
            foreach ($meal['tags'] as $tag) {
                if (in_array($tag['id'], $tags)) {
                    $tagDiff[] = $tag['id'];
                }
                if (!array_diff($tags, $tagDiff)) {
                    $mealIds[$mealKey] = $meal['id'];
                }
            }
        }
        foreach ($meals as $mealKey => $meal) {
            if (!in_array($meal['id'], $mealIds)) {
                unset($meals[$mealKey]);
            }
        }
        return $meals;
    }

    public function unsetTags(array $requestData, array $meals)
    {
        if (array_key_exists('with',$requestData)) {
            $withTags = str_contains($requestData['with'],'tags');
        }
        foreach ($meals as $mealKey => $meal) {
            //Used "===" instead of !$withTags because the value can be 0
            if (!isset($withTags) || !$withTags) {
                unset($meals[$mealKey]['tags']);
            }
        }
        return $meals;
    }
}
