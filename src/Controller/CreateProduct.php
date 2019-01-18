<?php
// src/Controller/CreateProduct.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateProduct extends AbstractController
{
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('create-product.html.twig', [
            'number' => $number,
        ]);
    }
}