<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Troiswa\BackBundle\Entity\Acteur;
use Symfony\Component\HttpFoundation\Request;
use Troiswa\BackBundle\Form\ActeurType;

class ActeurController extends Controller
{
    public function indexAction()
    {
    	/*$acteurs = [
		["id"=>0,"prenom"=>"Florian","nom"=>"Marait","sexe"=>0,"biographie"=>"Né en 1987, il s'intéresse très tôt à la vie."],
		["id"=>1,"prenom"=>"Jean","nom"=>"Moulin","sexe"=>0,"biographie"=>"Né par le passé, il découvre assez vite le présent."],
		["id"=>2,"prenom"=>"Francine","nom"=>"Granger","sexe"=>1,"biographie"=>"Né un jour avec soleil, elle sait savourer le temps."]
    	];*/
    	$acteurs = $this->getDoctrine()->getRepository("TroiswaBackBundle:Acteur")->findAll();
    	return $this->render("TroiswaBackBundle:Acteur:index.html.twig",["allActeurs"=>$acteurs]);
    }

    public function showAction($id)
    {
    	$acteur = $this->getDoctrine()->getRepository("TroiswaBackBundle:Acteur")->find($id);
    	return $this->render("TroiswaBackBundle:Acteur:show.html.twig",["Acteur"=>$acteur]);
    }
    
    public function ajoutAction(Request $request)
    {
        $acteur = new Acteur();
        $formulaire = $this->createForm(new ActeurType(),$acteur)->add("ajouter","submit");

        $formulaire->handleRequest($request);

            if($formulaire->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($acteur);
                $em->flush();
                return $this->redirect($this->generateUrl("troiswa_back_acteur_ajouter"));
            }

        return $this->render("TroiswaBackBundle:Acteur:ajout.html.twig",["formulaire"=>$formulaire->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $acteur = $this->getDoctrine()->getRepository("TroiswaBackBundle:Acteur")->find($id);
        $formulaire = $this->createFormBuilder($acteur)
        ->add("prenom","text")
        ->add("nom","text")
        ->add("sexe","choice",["choices"=>[0=>"Masculine",1=>"Féminin"],"expanded"=>true])
        ->add("dateNaissance","date")
        ->add("biographie","text")
        ->add("ajouter","submit")
        ->getForm();

        $formulaire->handleRequest($request);

            if($formulaire->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($acteur);
                $em->flush();
                return $this->redirect($this->generateUrl("troiswa_back_acteur"));
            }

        return $this->render("TroiswaBackBundle:Acteur:edit.html.twig",["formulaire"=>$formulaire->createView()]);
    }

}
