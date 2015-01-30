<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TroiswaBackBundle:Main:index.html.twig', array('name' => $name));
    }
    public function testAction()
    {
    	$prenom="Florian";
    	$age="27";
    	$acteurs=[
    	["prenom"=>"James","nom"=>"Bond"],["prenom"=>"Florian","nom"=>"Marait"]
    	];
    	return $this->render("TroiswaBackBundle:Main:test.html.twig",["firstname"=>$prenom,"old"=>$age,"allActeurs"=>$acteurs]);
    }
    public function prenomAction()
    {
    	return $this->render("TroiswaBackBundle:Main:prenom.html.twig");
    }
    public function indexAction()
    {
    	return $this->render("TroiswaBackBundle:Main:index.html.twig");
    }
}
