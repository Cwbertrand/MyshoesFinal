<?php

namespace App\Controller;

use App\Class\Search;
use App\Entity\Product;
use App\Form\SearchType;
use App\Entity\ShoesGender;
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
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $search = $this->em->getRepository(Product::class)->searchwithMen($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/menproducts.html.twig', [
                'products' => $search,
                'form' => $form->createView(),
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
            'form' => $form->createView(),
        ]);
    }

    //products for women
    #[Route('/women', name: 'women')]
    public function womenProduct(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $search = $this->em->getRepository(Product::class)->searchwithWomen($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/womenproducts.html.twig', [
                'products' => $search,
                'form' => $form->createView(),
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
            'form' => $form->createView(),
        ]);
    }
    
    //products for children
    #[Route('/children', name: 'children')]
    public function childrenProduct(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $search = $this->em->getRepository(Product::class)->searchwithWomen($search);
            $search = $this->paginator->paginate( $search, $request->query->getInt('page', 1), 6);

            return $this->render('gender/childrenproducts.html.twig', [
                'products' => $search,
                'form' => $form->createView(),
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
            'form' => $form->createView(),
        ]);
    }

    //Show product details
    #[Route('/product/detail/{slug}', name: 'detail_product')]
    public function productDetail(Product $product): Response
    {
        return $this->render('gender/showdetail.html.twig', [
            'detailproduct' => $product,
        ]);
    }
}
