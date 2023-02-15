<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

final class CarteService
{
    private $productRepository;
    private $carte = [];

    public function __construct(RequestStack $requestStack, ProductRepository $productRepository)

    {
        $this->carte = $requestStack->getSession()->get('carte');
        $this->productRepository = $productRepository;
    }

    public function getCarte(): self
    {
        return $this->carte;
    }

    public function setCarte(int $id, int $size): self
    {
        $product = $this->productRepository->find($id);

        $this->carte[$id] = [
            'product' => $this->productRepository->find($id),
            'size' => $size,
            'quantity' => 0,
        ];

        return $this->carte;
    }

    public function setQuantity(int $id, string $calculator, int $quantity): self
    {
        if ($calculator === '+') {
            $this->carte[$id]['quantity'] += $quantity;
        } 
        if ($calculator === '-') {
            $this->carte[$id]['quantity'] -= $quantity;
        }

        return $this->carte;
    }
}