<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use App\Repository\AdRepository;
use App\Repository\UserRepository;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_user_index")
     * 
     */
    public function UserAll(UserRepository $repo)
    {
        return $this->render('admin/ad/user.html.twig', [
            'users' => $repo->findAll()
        ]);
    }


    /**
     * @Route("/admin/ads", name="admin_ad_index")
     * @IsGranted("ROLE_ADMIN")
     */
    public function AdsAll(AdRepository $repoad)
    {
        return $this->render('admin/ad/adsall.html.twig', [
            'ads' => $repoad->findAll()
        ]);
    }
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        return $this->render('admin/ad/login.html.twig', [
            'hasError' => $error !== null
        ]);
    }
    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout(){

    }

    /**
 * permet d'afficher le formulaire d'inscription
 * 
 * @Route("admin/register", name="admin_account_register")
 *
 * @return Response
 */
public function createAdmin(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder,AuthenticationUtils $utils)
{
    $admin = new Admin();
    $error = $utils->getLastAuthenticationError();
    $form = $this->createForm(AdminType::class, $admin);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid() ){
        $hash = $encoder->encodePassword($admin, $admin->getHash());
        $admin->setHash($hash);
        $manager->persist($admin);
        $manager->flush();

    
        return $this->redirectToRoute('admin_login');
    }

    return $this->render('admin/ad/registeradmin.html.twig',[
        'form' => $form->createView(),
        'hasError' => $error !== null
    ]);
    }



      /**
 * permet de modifier le formulaire d'inscription d'un medecin compris mdp
 * 
 * @Route("admin/{slug}/editadmin", name="admin_edit_register")
 *
 * @return Response
 */
public function editAdmin(Admin $admin ,Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder,AuthenticationUtils $utils)
{
    
    $error = $utils->getLastAuthenticationError();
    $form = $this->createForm(RegistrationType::class, $admin);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid() ){
        $hash = $encoder->encodePassword($admin, $admin->getHash());
        $admin->setHash($hash);
        $manager->persist($admin);
        $manager->flush();

       
        return $this->redirectToRoute('admin_login');
    }

    return $this->render('admin/ad/registeradmin.html.twig',[
        'form' => $form->createView(),
        'hasError' => $error !== null,
        
    ]);
    }


}
