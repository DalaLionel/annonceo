<?php

namespace App\Controller;

use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    
    /**
     * @Route("/profile/edit", name="edit_profile")
     */
    public function editProfile(Request $request, EntityManagerInterface $em )
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid())
        {
            $em->flush();
        }
        return $this->render('profile/edit.html.twig', [
            'ProfileEditForm'=>$form->createView()
        ]);
    }
}
