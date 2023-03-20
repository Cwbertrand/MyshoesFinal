<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'sitemap', format: 'xml')]
    public function index(Request $request)
    {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('app_login')];
        $urls[] = ['loc' => $this->generateUrl('app_register')];
        $urls[] = ['loc' => $this->generateUrl('men')];
        $urls[] = ['loc' => $this->generateUrl('women')];
        $urls[] = ['loc' => $this->generateUrl('children')];

        $response = new Response(
            $this->renderView('sitemap/index.xml.twig', 
            ['hostname' => $hostname, 'urls' => $urls]),
            Response::HTTP_OK,
            ['content-type' => 'application/xml']      
        );

        //$response->headers->set('Content-type', 'text/xml');
        return $response;
    }
}
