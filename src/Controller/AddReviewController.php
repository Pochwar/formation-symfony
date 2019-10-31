<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Manager\ReviewManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;

class AddReviewController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ReviewManagerInterface
     */
    private $reviewManager;
    // As there is only one manager implementing this interface, we can type with the interface
    // If many, we would type with the manager

    /**
     * AddReviewController constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $router
     * @param FormFactoryInterface $formFactory
     * @param ReviewManagerInterface $reviewManager
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $router,
        FormFactoryInterface $formFactory,
        ReviewManagerInterface $reviewManager
    )
    {
        $this->twig = $twig;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->reviewManager = $reviewManager;
    }


    /**
     * @param Request $request
     * @param Session $session
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @Route("/reviews/add", name="add_review")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, Session $session)
    {
        $review = new Review();

        $form = $this->formFactory->create(ReviewType::class,
            $review,
            [
            'action' =>  $this->router->generate('add_review')
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->reviewManager->manage($review);

            $session->getFlashBag()->add('success', 'Your review has been submitted successfully');
            return new RedirectResponse($this->router->generate('add_review'));
        }


        return new Response($this->twig->render('add_review/index.html.twig', [
            'add_review_form' => $form->createView()
        ]));
    }
}
