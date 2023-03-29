<?php

namespace App\Controller;


use DateTime;
use App\Entity\Product;
use App\Entity\Remarks;
use App\Entity\Wishlist;
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
    #[Route('/product/detail/{slug}', name: 'detail_product')]
    public function productDetail(Product $product, $id): Response
    {
        $relatedProducts = $this->em->getRepository(Product::class)->relatedProducts($id);

        // selecting it from the database
        $newremarks = $this->em->getRepository(Remarks::class)->findProductId($product);

        //this is the total reviews of the client
        $reviewTotal = $this->em->getRepository(Remarks::class)->sumProductReview($product);


        return $this->render('gender/showdetail.html.twig', [

            'detailproduct' => $product,
            'slug' => $product->getSlug(),
            'newremarks' => $newremarks,
            'reviewTotal' => $reviewTotal,
            'relatedproducts' => $relatedProducts,
        ]);
    }

    #[Route('/product/detail/rating/{slug}', name: 'rating_product')]
    public function productRating(Product $product, Request $request)
    {
        $remarks = new Remarks();
        
        //$userReview = filter_input(INPUT_POST, 'userReview', FILTER_SANITIZE_SPECIAL_CHARS);
        //$rating_data = filter_input(INPUT_POST, 'rating_data', FILTER_DEFAULT);

        if($request->request->get('rating_data')){
            $stars = $request->request->get('rating_data');
            $comment = $request->request->get('userReview');
            
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
            //dd($remarks);
        }
    }
}
