<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quiz/" ,name="quiz")
     */
    public function showAction()
    {
        $number = 1;

        return $this->render('quizz/quizz.html.twig', [
            'number' => $number,
        ]);
    }

}