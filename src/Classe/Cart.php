<?php

namespace App\Classe;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{

    private $requestStack;
    private $entityManager;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function add($id)
    {

        $cartVO = $this->requestStack->getSession()->get('cart', []);

        if (!empty($cartVO[$id])) {
            $cartVO[$id]++;
        } else {
            $cartVO[$id] = 1;
        }

        $this->requestStack->getSession()->set('cart', $cartVO);
    }

    public function get()
    {
        $cartVO =  $this->requestStack->getSession()->get('cart', []);
        return $cartVO;
    }

    public function remove($id)
    {
        $cartVO =  $this->requestStack->getSession()->remove('cart');
        if (isset($cartVO[$id])) {
            if ($cartVO[$id] > 1) {
                $cartVO[$id]--;
            } else {
                unset($cartVO[$id]);
            }
        }

        $cartVO = $this->requestStack->getSession()->set('cart', $cartVO);
        return $cartVO;
    }

    public function delete($id)
    {
        $cartVO =  $this->requestStack->getSession()->remove('cart');

        unset($cartVO[$id]);

        $cartVO = $this->requestStack->getSession()->set('cart', $cartVO);
        return $cartVO;
    }

    public function getFull()
    {
        $cartVOs = [];
        if ($this->get()) {
            foreach ($this->get() as $id => $quantity) {
                $productVO = $this->entityManager->getRepository(Product::class)->findOneById($id);

                if (!$productVO) {
                    $this->delete($id);
                    continue;
                }

                $cartVOs[] =  [
                    'productVO' => $productVO,
                    'quantity' => $quantity,
                ];
            }
        }

        return $cartVOs;
    }
}
