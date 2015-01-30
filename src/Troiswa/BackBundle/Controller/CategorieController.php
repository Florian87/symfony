<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends Controller
{
    public function indexAction()
    {
    	/*$acteurs = [
		["id"=>0,"prenom"=>"Florian","nom"=>"Marait","sexe"=>0,"biographie"=>"Né en 1987, il s'intéresse très tôt à la vie."],
		["id"=>1,"prenom"=>"Jean","nom"=>"Moulin","sexe"=>0,"biographie"=>"Né par le passé, il découvre assez vite le présent."],
		["id"=>2,"prenom"=>"Francine","nom"=>"Granger","sexe"=>1,"biographie"=>"Né un jour avec soleil, elle sait savourer le temps."]
    	];*/
    	$categories = $this->getDoctrine()->getRepository("TroiswaBackBundle:Categorie")->findAll();
    	return $this->render("TroiswaBackBundle:Categorie:index.html.twig",["allCategories"=>$categories]);
    }
    
}
