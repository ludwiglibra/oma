<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
    	$respuesta = $this->render('AcmeDemoBundle:Welcome:index.html.twig');
   // 	$respuesta->headers->set('Content-Type', 'text/plain');
        return $respuesta;
    }
}
