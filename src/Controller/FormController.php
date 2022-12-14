<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('nom', TextType::class)
            ->add('message', TextareaType::class, [
                'attr' => ['class' => 'textareaperso']
            ])
            ->add('submit', SubmitType::class)
            ->getForm()
        ;
        // Request => $form
        $form->handleRequest($request);

        return $this->render('form/index.html.twig', array(
            'formulaire' => $form->createView()
        ));
    }
}
