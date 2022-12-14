<?php

namespace App\Controller;

use http\Encoding\Stream\Dechunk;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HomeController extends AbstractController
{

    #[Route('/', name: 'homepage')]
    public function index(Request $request): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/test1/{id}/{slug}', name: 'test1',methods: ["POST","GET"], schemes: ['http'], requirements: [
        'id' => '\d+',
        'slug' => '[a-zA-Z0-9]+'
    ])]
    public function test1(Request $request, int $id, string $slug = 'prenom'): Response
    {
        dump($request->attributes->get('id'));
        dump($id);
        dump($slug);
        //dump($request);
        //dd($request->server->get('HTTP_HOST'));

//        return new Response('<h1>ici la response</h1>');
        $fruits = ['banane','kiwi','papaye'];
        //return new Response(json_encode($fruits), 200,['Content-type' => 'application-json']);
        //return new JsonResponse($fruits);
        return $this->json($fruits);

    }

    // Priorité
    #[Route('/dede/{text}', name: 'dede1', priority: 1)]
    public function dede1(Request $request,$text): Response
    {
        return $this->json($text . 'dede1');
    }

    #[Route('/dede/all', name: 'dede2', priority: 2)]
    public function dede2(Request $request): Response
    {
        //return $this->json('ok ici dede2');
//        return $this->redirect('https://weblitzer.fr');
        //return $this->redirectToRoute('homepage', ['id' => 13, 'slug' => 'icileslug']);
        // return $this->redirectToRoute('test1', ['id' => 13, 'slug' => 'icileslug']);
        //$url = $this->generateUrl('dede2'); // relatif
        $url = $this->generateUrl('dede2', [], UrlGeneratorInterface::ABSOLUTE_URL); // absolute

        $emailAdmin = $this->getParameter('app.emailadmin');
        $emailAdmin2 = $this->getParameter('app.emailperso');
        dump($emailAdmin,$emailAdmin2);

        if($url != 'dede') {
            // redirection 404
            //throw  $this->createNotFoundException('Url pas ok');
        }
        dd($url);

    }


    // TWIG
    #[Route('/twig1-dsfopihsdflkjhsdlfjkhsdkjfhls', name: 'twig1')]
    public function twig1(): Response
    {
        $fruits = ['banane','kiwi','papaye'];
        $emailAdmin2 = $this->getParameter('app.emailperso');
        $user = array(
            'email' => 'quidelantoine@gmail.com',
            'nom'   => 'michel'
        );
        $products = array(
            array('name' => 'produit item 1'),
            array('name' => 'produit 2')
        );
//        return $this->render('twig/index.html.twig', [
//            'fruits' => $fruits,
//            'emailAdmin2' => $emailAdmin2
//        ]);
        return $this->render('twig/index.html.twig', compact('fruits','emailAdmin2','user','products'));
    }




    public function getNotifications($nbre = 2) {
        // Model
        $notifications = array(
            'notif 1',
            'notif 2'
        );
        return $this->render('partials/notification.html.twig', compact('notifications','nbre'));
    }



}
