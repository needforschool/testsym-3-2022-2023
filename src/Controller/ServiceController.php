<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ServiceController extends AbstractController
{

//    private $sluger;
//    public function __construct(SluggerInterface $sluger)
//    {
//        $this->sluger = $sluger;
//    }
    public function __construct(private SluggerInterface $sluger){}

    #[Route('/service', name: 'app_service')]
//    public function index(SluggerInterface $sluger): Response
    public function index(LoggerInterface $logger): Response
    {
        $str = 'Bonjour à tous';
        //$slug = $sluger->slug($str);
        $slug = $this->sluger->slug($str);
        $logger->info($slug);
        $logger->error('An error occurred');
        //dd($slug);

        return $this->render('service/index.html.twig', [

        ]);
    }
}
