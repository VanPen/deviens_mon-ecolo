<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/" , name="homepage")
     */
    public function number(Session $session)
    {
        $start = $session->isStarted();
        $name = $session->getId();
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository(User::class)->find(1);

        return $this->render('base.html.twig', [
            'number' => $start,
            'entity' => $entity->getUsername(),
            'id'     => $entity->getId(),

        ]);
    }
}
