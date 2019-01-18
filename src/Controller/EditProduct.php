<?php
// src/Controller/EditProduct.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditProduct extends AbstractController
{
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('create-product.html.twig', [
            'number' => $number,
        ]);
    }
}