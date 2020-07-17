<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_MODO")
 */
class BackOfficeController extends AbstractController
{
    /**
     * @Route("/back", name="back_office")
     */
    public function show()
    {
        return $this->render('back_office/index.html.twig');
    }
}
