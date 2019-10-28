<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeshAlorsController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $content = '';

        for ($i = 0; $i < 100; $i++) {
            $content = $content . "<br>Wesh Alors";
        }
        return new Response($content);
    }
}
