<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\DataTransformer\StringToArrayTransformer;
use App\Entity\Task;
use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/create", name="product")
     */
    public function new(Request $request)
    {
        // creates a product and gives it some dummy data for this example
        $product = new Product();
        // $product->setProduct('Add new product');
        // $product->setCreatedAt(new \DateTime('now'));

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('price', TextType::class)
            ->add('description', TextType::class)
            ->add('tag', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Product'])
            ->getForm();
        
        // add date createdAt
        $product->setCreatedAt(new \DateTime());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$product` variable has also been updated
            $product = $form->getData();
            
            // $submitted = array_map(function($tag) {
            //     return trim($tag);
            // }, explode(',', $submitted));
    
            // ... perform some action, such as saving the product to the database
            // for example, if Product is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
    
            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/product/list", name="product_list")
     */
    public function getAll()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class)->findBy(array(), array('createdAt' => 'ASC'));

        // look for *all* Product objects
        return $this->render('product/list.html.twig', [
            'products' => $repository
        ]);

    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        // or render a template
        // in the template, print things with {{ product.name }}
        return $this->render('product/show.html.twig', ['product' => $product]);
    }


    /**
     * @Route("/product/edit/{id}", name="product_edit")
     */
    public function update($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('price', TextType::class)
            ->add('description', TextType::class)
            ->add('tag', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Edit Product'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$product` variable has also been updated
            $product = $form->getData();
            
            // $submitted = array_map(function($tag) {
            //     return trim($tag);
            // }, explode(',', $submitted));
    
            // ... perform some action, such as saving the product to the database
            // for example, if Product is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_show', [
                'id' => $product->getId()
            ]);
        }

        return $this->render('product/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
