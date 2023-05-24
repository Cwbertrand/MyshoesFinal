<?php

namespace App\Controller;


use DateTime;
use App\Entity\Product;
use App\Entity\Remarks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductDetailController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    //Show product details
    #[Route('/product/detail/{id}', name: 'related_products')]
    public function productDetail($id): Response
    {
        $product = $this->em->getRepository(Product::class)->find($id);
         // Check if the product exists
        if (!$product) {
            return $this->redirectToRoute('home');
        }
        $relatedProducts = $this->em->getRepository(Product::class)->relatedProducts($id);
        
        // selecting it from the database
        $newremarks = $this->em->getRepository(Remarks::class)->findProductId($product);

        //this is the total reviews of the client
        $reviewTotal = $this->em->getRepository(Remarks::class)->sumProductReview($product);


        return $this->render('gender/showdetail.html.twig', [

            'detailproduct' => $product,
            'id' => $product->getId(),
            'newremarks' => $newremarks,
            'reviewTotal' => $reviewTotal,
            'relatedproducts' => $relatedProducts,
        ]);
    }

    //User's review on a product
    #[Route('/product/detail/rating/{id}', name: 'rating_product')]
    public function productRating(Product $product, Request $request)
    {
        //Instantiating remark class
        $remarks = new Remarks();
        
        if($request->request->get('rating_data')){

            //collect user rate(from 1-5 and user comments(string))
            $stars = $request->request->get('rating_data');
            $comment = $request->request->get('userReview');
            
            //setting rating properties with values
            $date = new DateTime();
            $remarks->setComment($comment);
            $remarks->setRating($stars);
            $remarks->setProduct($product);
            $remarks->setUser($this->getUser());
            $remarks->setCreateAt($date);
    
            $this->em->persist($remarks);
            $this->em->flush();
            $this->addFlash('message', 'Your review and rating has successfully been submitted');

            return $this->redirectToRoute('related_products', ['id' => $product->getId()]);
        }
    }
}
