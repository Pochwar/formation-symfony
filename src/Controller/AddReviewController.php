<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

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
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * AddReviewController constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $router
     * @param FormFactoryInterface $formFactory
     * @param RegistryInterface $doctrine
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $router,
        FormFactoryInterface $formFactory,
        RegistryInterface $doctrine
    )
    {
        $this->twig = $twig;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->doctrine = $doctrine;
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

            $this->doctrine->getManager()->persist($review);
            $this->doctrine->getManager()->flush();

            $session->getFlashBag()->add('success', 'Your review has been submitted successfully');
            return new RedirectResponse($this->router->generate('add_review'));
        }


        return new Response($this->twig->render('add_review/index.html.twig', [
            'add_review_form' => $form->createView()
        ]));
    }
}
