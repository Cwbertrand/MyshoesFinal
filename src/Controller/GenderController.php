<?php

namespace App\Controller;

use DateTime;
use App\Service\Search;
use App\Entity\Product;
use App\Entity\Remarks;
use App\Form\SearchType;
use App\Entity\ShoesGender;
use App\Form\SearchAllType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenderController extends AbstractController
{
    private $em;
    private $paginator;

    public function __construct(EntityManagerInterface $em, PaginatorInterface $paginator)
    {
        $this->em = $em;
        $this->paginator = $paginator;
    }

    //products for men
    #[Route('/men', name: 'men')]
    public function menProducts(Request $request): Response
    {
        $search = new Search();

        //this search is for the checkboxes
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        //this search is for the text
        $formText = $this->createForm(SearchAllType::class, $search);
        $formText->handleRequest($request);


        //condition for the checkbox search
        if($form->isSubmitted() && $form->isValid()){
            //a query that finds all the products which match the search for the checkbox
            $search = $this->em->getRepository(Product::class)->searchwithMen($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/menproducts.html.twig', [
                'products' => $search,
                'form' => $form->createView(),
                'formText' => $formText,
            ]);
        }

        //condition for the string search
        if($formText->isSubmitted() && $formText->isValid()){

            //a query that finds all the products which match the search for the string
            $search = $this->em->getRepository(Product::class)->searchwithMen($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/menproducts.html.twig', [
                'products' => $search,
                'formText' => $formText,
                'form' => $form,
            ]);
        }

         //Query to select all men's shoes
        $men = $this->em->getRepository(ShoesGender::class)->find(1);   // the find(1) gets the id of ShoesGender
        $newman = $men->getProducts();

        $man = $this->paginator->paginate(
            $newman, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        return $this->render('gender/menproducts.html.twig', [
            // c'est la methode qui fait la relation MAnytoMany
            'products' => $man,//->toArray(),
            'form' => $form,
            'formText' => $formText,
        ]);
    }

    //products for women
    #[Route('/women', name: 'women')]
    public function womenProduct(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        //this search is for the text
        $formText = $this->createForm(SearchAllType::class, $search);
        $formText->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $search = $this->em->getRepository(Product::class)->searchwithWomen($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/womenproducts.html.twig', [
                'products' => $search,
                'form' => $form,
                'formText' => $formText,
            ]);
        }

        //condition for the string search
        if($formText->isSubmitted() && $formText->isValid()){

            //a query that finds all the products which match the search for the string
            $search = $this->em->getRepository(Product::class)->searchwithMen($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/menproducts.html.twig', [
                'products' => $search,
                'formText' => $formText,
                'form' => $form,
            ]);
        }


         //Query to select all men's shoes
        $women = $this->em->getRepository(ShoesGender::class)->find(2);   // the find(1) gets the id of ShoesGender
        $newwoman = $women->getProducts();

        $women = $this->paginator->paginate(
            $newwoman, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );
        return $this->render('gender/womenproducts.html.twig', [
            // c'est la methode qui fait la relation MAnytoMany
            'products' => $women,//->toArray(),
            'form' => $form,
            'formText' => $formText,
        ]);
    }
    
    //products for children
    #[Route('/children', name: 'children')]
    public function childrenProduct(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        //this search is for the text
        $formText = $this->createForm(SearchAllType::class, $search);
        $formText->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $search = $this->em->getRepository(Product::class)->searchwithChildren($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/childrenproducts.html.twig', [
                'products' => $search,
                'form' => $form,
                'formText' => $formText,
            ]);
        }

        //condition for the string search
        if($formText->isSubmitted() && $formText->isValid()){

            //a query that finds all the products which match the search for the string
            $search = $this->em->getRepository(Product::class)->searchwithMen($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/menproducts.html.twig', [
                'products' => $search,
                'formText' => $formText,
                'form' => $form,
            ]);
        }


         //Query to select all men's shoes
        $children = $this->em->getRepository(ShoesGender::class)->find(3);   // the find(1) gets the id of ShoesGender
        $newchildren = $children->getProducts();

        $children = $this->paginator->paginate(
            $newchildren, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );
        return $this->render('gender/childrenproducts.html.twig', [
            // c'est la methode qui fait la relation MAnytoMany
            'products' => $children,//->toArray(),
            'form' => $form,
            'formText' => $formText,
        ]);
    }

    // //Show product details
    // #[Route('/product/detail/{id}', name: 'related_products')]
    // #[Route('/product/detail/{slug}', name: 'detail_product')]
    // public function productDetail(Product $product, $id): Response
    // {
    //     $relatedProducts = $this->em->getRepository(Product::class)->relatedProducts($id);

    //     // selecting it from the database
    //     $newremarks = $this->em->getRepository(Remarks::class)->findProductId($product);

    //     //this is the total reviews of the client
    //     $reviewTotal = $this->em->getRepository(Remarks::class)->sumProductReview($product);

    //     return $this->render('gender/showdetail.html.twig', [
    //         'detailproduct' => $product,
    //         'slug' => $product->getSlug(),
    //         'newremarks' => $newremarks,
    //         'reviewTotal' => $reviewTotal,
    //         'relatedproducts' => $relatedProducts,
    //     ]);
    // }

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
        }
        
    }
}
