<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $qb = $this->getDoctrine()
            ->getManager()
            ->createQueryBuilder()
            ->from('AppBundle:Post','p')
            ->select('p');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
          $qb,
          $request->query->get('page',1),
          20
        );


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'posts' => $pagination
        ));
    }

    /**
     * @Route("/article/{id}" , name="post_show")
     */
    public function showAction(Post $post, Request $request){

        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        if($form->isValid()){

            $this->getDoctrine()->getManager();
            $this->persist($comment);
            $this->flush();

            $this->addFlash('success','Komentarz został pomyślnie dodany');
            return $this->redirectToRoute('post_show',array('id'=>$pos->getId()));
        }

        return $this->render('default/show.html.twig', array(
            'post' => $post,
            'form' => $form->createView()
        ));
    }

}
