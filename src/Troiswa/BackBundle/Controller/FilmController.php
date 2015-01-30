<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Troiswa\BackBundle\Entity\Film;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{
    public function indexAction()
    {
    	/*$acteurs = [
		["id"=>0,"prenom"=>"Florian","nom"=>"Marait","sexe"=>0,"biographie"=>"Né en 1987, il s'intéresse très tôt à la vie."],
		["id"=>1,"prenom"=>"Jean","nom"=>"Moulin","sexe"=>0,"biographie"=>"Né par le passé, il découvre assez vite le présent."],
		["id"=>2,"prenom"=>"Francine","nom"=>"Granger","sexe"=>1,"biographie"=>"Né un jour avec soleil, elle sait savourer le temps."]
    	];*/
    	$films = $this->getDoctrine()->getRepository("TroiswaBackBundle:Film")->findAll();
    	return $this->render("TroiswaBackBundle:Film:index.html.twig",["allFilms"=>$films]);
    }


    public function ajoutAction(Request $request)
    {
        $film = new Film();
        $formulaire = $this->createFormBuilder($film)
        ->add("titre","text")
        ->add("description","text")
        ->add("fichier","file")
        ->add("dateSortie","date")
        ->add("duree","text")
        ->add("note","text")
        ->add("ajouter","submit")
        ->getForm();

        $formulaire->handleRequest($request);

            if($formulaire->isValid())
            {
                $film->upload();
                $em = $this->getDoctrine()->getManager();
                $em->persist($film);
                $em->flush();
                return $this->redirect($this->generateUrl("troiswa_back_film_ajouter"));
            }
            
        return $this->render("TroiswaBackBundle:Film:ajout.html.twig",["formulaire"=>$formulaire->createView()]);
    }
    
    public function editAction($id, Request $request)
    {
        $film = $this->getDoctrine()->getRepository("TroiswaBackBundle:Film")->find($id);
        $formulaire = $this->createFormBuilder($film)
        ->add("titre","text")
        ->add("description","text")
        ->add("dateSortie","date")
        ->add("image","text")
        ->add("duree","text")
        ->add("note","text")
        ->add("ajouter","submit")
        ->getForm();

        $formulaire->handleRequest($request);

            if($formulaire->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($film);
                $em->flush();
                return $this->redirect($this->generateUrl("troiswa_back_film"));
            }

        return $this->render("TroiswaBackBundle:Film:edit.html.twig",["formulaire"=>$formulaire->createView()]);
    }


}
