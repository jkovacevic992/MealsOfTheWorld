<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidator
{
    private $errorMessage;
    private ValidatorInterface $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validates all fields of the request
     * @param Request $request
     * @return bool
     */
    public function validateRequestParameters(Request $request): bool
    {
        $requestData = $request->query->all();

        if (!$this->validateLang($requestData)) {
            return false;
        }

        if (array_key_exists('diff_time', $requestData) && !$this->validateDiffTime($requestData['diff_time'])) {
            return false;
        }
        if (array_key_exists('per_page', $requestData) && !$this->validatePerPage($requestData['per_page'])) {
            return false;
        }
        if (array_key_exists('page', $requestData) && !$this->validatePage($requestData['page'])) {
            return false;
        }
        if (array_key_exists('category', $requestData) && !$this->validateCategory($requestData['category'])) {
            return false;
        }
        if (array_key_exists('with', $requestData) && !$this->validateWith($requestData['with'])) {
            return false;
        }
        return true;
    }

    /**
     * Validates lang parameter
     * @param array $requestData
     * @return bool
     */
    private function validateLang(array $requestData): bool
    {
        if (array_key_exists('lang', $requestData)) {
            return true;
        }
        $this->setErrorMessage('No lang parameter');
        return false;
    }

    /**
     * Validates diff_time parameter
     * @param string $diffTime
     * @return bool
     */
    private function validateDiffTime(string $diffTime): bool
    {
        $greaterThanConstraint = new GreaterThan(['value' => 0]);
        $greaterThanConstraint->message = 'Invalid diff_time greater than 0 parameter';
        $intConstraint = new Type('integer');
        $intConstraint->message = 'Invalid diff_time integer parameter';
        $errors = $this->validator->validate((int)$diffTime, [$greaterThanConstraint, $intConstraint]);
        if (!$errors->count()) {
            return true;
        } else {
            $this->setErrorMessage($errors[0]->getMessage());
            return false;
        }
    }

    /**
     * Validates per_page parameter
     * @param string $perPage
     * @return bool
     */
    private function validatePerPage(string $perPage): bool
    {
        $greaterThanConstraint = new GreaterThan(['value' => 0]);
        $greaterThanConstraint->message = 'Invalid per_page greater than 0 parameter';
        $intConstraint = new Type('integer');
        $intConstraint->message = 'Invalid per_page integer parameter';
        $errors = $this->validator->validate((int)$perPage, [$greaterThanConstraint, $intConstraint]);
        if (!$errors->count()) {
            return true;
        } else {
            $this->setErrorMessage($errors[0]->getMessage());
            return false;
        }
    }

    /**
     * Validates page parameter
     * @param string $page
     * @return bool
     */
    private function validatePage(string $page): bool
    {
        $greaterThanConstraint = new GreaterThan(['value' => 0]);
        $greaterThanConstraint->message = 'Invalid page greater than 0 parameter';
        $intConstraint = new Type('integer');
        $intConstraint->message = 'Invalid page integer parameter';
        $errors = $this->validator->validate((int)$page, [$greaterThanConstraint, $intConstraint]);
        if (!$errors->count()) {
            return true;
        } else {
            $this->setErrorMessage($errors[0]->getMessage());
            return false;
        }
    }

    /**
     * Validates with parameter
     * @param string $with
     * @return bool
     */
    private function validateWith(string $with): bool
    {
        foreach (explode(',', $with) as $item) {
            if (!in_array($item, ['category','tags','ingredients'])) {
                $this->setErrorMessage('Only category, tags or ingredients accepted in the WITH parameter');
                return false;
            }
        }
        return true;
    }

    /**
     * Validates category parameter
     * @param string $category
     * @return bool
     */
    private function validateCategory(string $category): bool
    {
        if (strtoupper($category) === 'NULL'
        || strtoupper($category) === '!NULL'
        || (int)$category > 0) {
            return true;
        }
        $this->setErrorMessage('Category parameter can only be NULL, !NULL or a positive number');
        return false;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage(): mixed
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     */
    public function setErrorMessage(mixed $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }
}
