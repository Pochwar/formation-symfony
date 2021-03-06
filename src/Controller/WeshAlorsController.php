<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeshAlorsController extends AbstractController
{
    /**
     * @return Response
     * @Route("/wesh-alors", name="index")
     */
    public function index(): Response
    {
        $content = '';

        for ($i = 0; $i < 100; $i++) {
            $k = '';
            for ($j = 0; $j < rand(1, 1000); $j++) {
                $k = $k . '-';
            }
            $content = $content . "<br>" . $k . "Wesh Alors";
        }
        return new Response($content);
    }
}
