<?php

namespace App\Controller;

use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddReviewController extends AbstractController
{
    /**
     * @Route("/reviews/add", name="add_review")
     */
    public function index()
    {
        $form = $this->createForm(ReviewType::class);
        return $this->render('add_review/index.html.twig', [
            'add_review_form' => $form->createView(),
        ]);
    }
}
