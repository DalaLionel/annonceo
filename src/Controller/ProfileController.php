<?php

namespace App\Controller;

use App\Form\EditPasswordType;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManager;
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
            $this->addFlash('success','Votre profil a bien été modifié');
        }
        return $this->render('profile/edit.html.twig', [
            'ProfileEditForm'=>$form->createView()
        ]);
    }
    /**
     * @Route("/editpassword", name="edit_password")
     */
    public function editPassword(Request $request, EntityManagerInterface $em )
    {
        $user = $this->getUser();
        $form = $this->createForm(EditPasswordType::class, $user);
        $form->handleRequest($request);
        if ( $form->isSubmitted()&&$form->isValid())
        {
            $em->flush();
            $this->addFlash('success','Votre mot de passe a bien été modifié');
        }
        return $this->render('profile/editPassword.html.twig', [
            'PasswordEditForm'=>$form->createView()
        ]);
    }

}
