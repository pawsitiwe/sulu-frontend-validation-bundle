<?php

declare(strict_types=1);

namespace Pawsitiwe\Controller;

use Sulu\Bundle\FormBundle\Form\BuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ValidationController extends AbstractController
{
    private BuilderInterface $formBuilder;

    public function __construct(BuilderInterface $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    public function validateFormField(Request $request): JsonResponse
    {
        $form = $this->formBuilder->buildByRequest($request);
        if ($form instanceof FormInterface !== true) {
            return new JsonResponse(['message' => 'No form data found'], 400);
        }

        if ($form->isValid() === true) {
            return new JsonResponse(['message' => 'The form is valid!'], 200);
        }

        $fields = $form->all();
        $errorMessages = [];
        foreach ($fields as $field) {
            if ($field->isValid() !== true) {
                $errorMessages[$field->getName()] = $this->getFieldErrors($field);
            }
        }

        return new JsonResponse(['errors' => $errorMessages], 422);
    }

    private function getFieldErrors(FormInterface $field): array
    {
        $errors = $field->getErrors();
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = $error->getMessage();
        }

        return $errorMessages;
    }
}
