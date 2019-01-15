<?php

namespace App\Controller\Administration;

use App\Entity\RidingSchool;
use App\Entity\School;
use App\Entity\Session;
use App\Entity\User;
use App\Form\CreateSessionType;
use App\Form\CreateUserType;
use App\Form\UpdateUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class AdminController extends AbstractController
{
    /**
     * @Route("/administration/admin", name="administration_admin")
     */
    public function index()
    {
        return $this->render('administration/accueil.html.twig', [

        ]);
    }

    public function gestion_droits(){
        return $this->render('administration/gestion_droits.html.twig', [

        ]);
    }

    public function gestion_base(){
        return $this->render('administration/gestion_base.html.twig', [

        ]);
    }

    /*
    * Require IS_AUTHENTICATED_FULLY for only this controller method.
    *
    * @IsGranted("ROLE_SUPERADMIN")
    */
    public function gestion_utilisateurs(){
//        $this->denyAccessUnlessGranted('ROLE_SUPERADMIN');

                $user = $this->getUser();
//        $user->setRoles(['ROLE_SUPER_ADMIN']);
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($user);
//        $entityManager->flush();
        $user1 = $this->getDoctrine()
            ->getRepository(User::class)
            ->find(1);
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        $schools = $this->getDoctrine()
            ->getRepository(School::class)
            ->findAll();


        $userForm = new User();
        $form = $this->createForm(UpdateUserType::class);
        $createUserForm = $this->createForm(CreateUserType::class, null, ['action'=>$this->generateUrl('add_user')]);
        return $this->render('administration/gestion_utilisateur.html.twig', [
            'users'=>$users,
            'schools'=>$schools,
            'updateUser'=>$form->createView(),
            'addUserForm'=>$createUserForm->createView()
            ]
        );
    }

    /**
     * @param Request $request
     * @Route("/admin/gestion_utilisateurs/addUser", name="add_user", methods={"POST"})
     */
    public function add_user(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $form = $this->createForm(CreateUserType::class);
//        dd($request);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $user = new User();
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('admin_users');
        }
        else{
            dd($form, $request);
        }
    }


    /**
     * @param Request $request
     * @Route("/admin/gestion_utilisateurs/del_User/{id}", name="del_User", methods={"DELETE"}, defaults={"id"=null})
     */
    public function del_User(Request $request, $id){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        try{
            $user = $this->getDoctrine()->getRepository(User::class)
                ->find($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();

            return new Response($serializer->serialize(['return'=>true], 'json'));
        }catch (Exception $e){
            return new Response($serializer->serialize(['return'=>$e], 'json'));
        }


    }

    public function gestion_sessions(){
        $ridingSchools = $this->getDoctrine()
            ->getRepository(RidingSchool::class)
            ->findAll();
        $sessions = $this->getDoctrine()
            ->getRepository(Session::class)
            ->findAll();
        $createSessionForm = $this->createForm(CreateSessionType::class, null, ['action'=>$this->generateUrl('add_session')]);
        return $this->render('administration/gestion_seance.html.twig', [
            'createSessionForm'=>$createSessionForm->createView(),
            'sessions'=>$sessions,
            'ridingSchools'=>$ridingSchools
        ]);
    }


    /**
     * @param Request $request
     * @Route("/admin/gestion_sessions/add_session", name="add_session", methods={"POST"})
     */
    public function add_session(Request $request){
        $form = $this->createForm(CreateSessionType::class);
//        dd($request);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $session = new Session();
            $session = $form->getData();
//            dd($session);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();
            return $this->redirectToRoute('admin_sessions');
        }
        else{
            dd($form, $request);
        }
    }

    public function del_session(){

    }
}
