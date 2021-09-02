<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OppController extends AbstractController {

    public function add()
    {
        return $this->render('back/base.html.twig') ;
    
    } 

    public function new()
    {
        return $this->render('index.html.twig') ;
    
    } 

    public function new2()
    {
        return $this->render('opportunite/new.html.twig') ;
    
    } 
    
    public function index()
    {
        return new Response(
            'hello world'
        );
    }



  

}

?>