<?php

namespace App\Controller;

use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddReviewController extends AbstractController
{
    /**
     * @Route("/reviews/add", name="add_review")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $form = $this->createForm(ReviewType::class,
            [

            ],
            [
            'action' =>  $this->generateUrl('add_review')
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Your review has been submitted successfully');
        }


        return $this->render('add_review/index.html.twig', [
            'add_review_form' => $form->createView()
        ]);
    }
}
