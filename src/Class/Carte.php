<?php

namespace App\Class;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

Class Carte
{
    private $em;
    private $requestStack;
    private $session;

    public function __construct(EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
        $this->session = $this->requestStack->getSession();
    }

    public function getCarte(){
        return $this->session->get('carte');
    }

    //this adds the quantity of the product into the carte
    public function addCarte($id){

        //setting a session which is called 'carte' and associating it with an array which contains all the products
        $carte = $this->session->get('carte', []);

        //adding the product when the carte is not empty
        if(!empty($carte[$id])){
            $carte[$id]++;
        }else{
            $carte[$id] = 1;
        }

        return $this->session->set('carte', $carte);
        
    }

    //this minus the quantity of the product from the carte
    public function minusCarte($id){
        $carte = $this->session->get('carte', []);

        if($carte[$id] > 1){
            $carte[$id]--;
        }else{
            unset($carte[$id]);
        }

        return $this->session->set('carte', $carte);
    }

    //delete a product from the carte
    public function deleteProduct($id){
        $carte = $this->session->get('carte', []);
        unset($carte[$id]);

        return $this->session->set('carte', $carte);
    }

    //Clear the entire carte content
    public function removeCarte(){
        return $this->session->remove('carte');
    }

    //To get all the product details
    public function productDetails(){

        //we declare an empty table so as to collect more info concerning a product
        $productdetail = [];

        //if product exist in the carte, show all the product's information
        if ($this->getCarte()) {
            
            //this collects more information concerning a product e.g product name, color, etc.
            // $Id for key and $productQty for the value
            foreach ($this->getCarte() as $id => $productQty) {
                $product = $this->em->getRepository(Product::class)->findOneById($id);

                //if product doesn't exist, delete the product then return to the carte
                if(!$product){
                    $this->deleteProduct($id);

                    //it comes out from the foreach loop and goes to the next product
                    continue;
                }

                $productdetail[] = [
                    'quantity' => $productQty,
                    'productdetail' => $product
                ];

            }
        }

        return $productdetail;
    }
}