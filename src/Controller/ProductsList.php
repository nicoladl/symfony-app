<?php
// src/Controller/ProductsList.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsList extends AbstractController
{
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('products-list.html.twig', [
            'number' => $number,
        ]);
    }
}