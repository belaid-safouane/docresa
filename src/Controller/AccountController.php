<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\RegistrationProType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * @Route("/login", name="account_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        return $this->render('dashboard/login.html.twig', [
            'hasError' => $error !== null
        ]);
    }

    /**
     * @Route("/logout", name="account_logout")
     */
    public function logout(){

    }
    
/**
 * permet d'afficher le formulaire d'inscription
 * 
 * @Route("/register", name="account_register")
 *
 * @return Response
 */
public function createregister(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder,AuthenticationUtils $utils)
{
    $user = new User();
    $error = $utils->getLastAuthenticationError();
    $form = $this->createForm(RegistrationType::class, $user);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid() ){
        $hash = $encoder->encodePassword($user, $user->getHash());
        $user->setHash($hash);
        $manager->persist($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "Votre compte a bien été créé !"
        );
        return $this->redirectToRoute('account_login');
    }

    return $this->render('dashboard/account/registration.html.twig',[
        'form' => $form->createView(),
        'hasError' => $error !== null
    ]);
    }



    /**
 * permet de modifier le formulaire d'inscription
 * 
 * @Route("/{slug}/editregister", name="edit_account_register")
 *
 * @return Response
 */
public function editregister(User $user ,Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder,AuthenticationUtils $utils)
{
    
    $error = $utils->getLastAuthenticationError();
    $form = $this->createForm(RegistrationType::class, $user);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid() ){
        $hash = $encoder->encodePassword($user, $user->getHash());
        $user->setHash($hash);
        $manager->persist($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "Votre compte a bien été créé !"
        );
        return $this->redirectToRoute('account_login');
    }

    return $this->render('dashboard/account/editregistration.html.twig',[
        'form' => $form->createView(),
        'hasError' => $error !== null,
        
    ]);
    }

    /**
     * permet de supprimer un user
     * @Route("/{slug}/delete", name="delete_account_register")
     */
     public function deleteUsers(User $user, EntityManagerInterface $manager)
    {
        
        if(count($user->getAds()) > 0 ){
            $this->addFlash(
                'warning',
                "le compte des ads !"
            );
        } else{
        $manager->remove($user);
        $manager->flush();
        $this->addFlash(
            'success',
            "le compte a bien été supprimé !"
        );}
        return $this->redirectToRoute('admin_ad_index');
    }

    /**
     * permet de supprimer un ads d'un user
     * @Route("ads/{slug}/delete", name="delete_account_ad_register")
     */
    public function deleteAdsUsers(Ad $ad, EntityManagerInterface $manager)
    {
        
        $manager->remove($ad);
        $manager->flush();
        $this->addFlash(
            'success',
            "le compte a bien été supprimé !"
        );
        return $this->redirectToRoute('admin_ad_index');
    }


    /**
     * redirection vers la page de remerciement pour l'inscription
     * @Route("/congrat", name="congrat")
     */
    public function congrat(){

        return $this->render('congrat.html.twig');
    }

    /**
 * permet d'afficher le formulaire d'inscription d'un medecin prevenant du site
 * 
 * @Route("/registerpro", name="account_registerpro")
 *
 * @return Response
 */
public function registerpro(Request $request, EntityManagerInterface $manager,AuthenticationUtils $utils)
{
    $user = new User();
    $error = $utils->getLastAuthenticationError();
    $form = $this->createForm(RegistrationProType::class, $user);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid() ){
       
        $manager->persist($user);
        $manager->flush();

        
        return $this->redirectToRoute('congrat');
    }

    return $this->render('dashboard/account/registrationpro.html.twig',[
        'form' => $form->createView(),
        'hasError' => $error !== null
    ]);
    }


}
