<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/panel", name="panel")
 */
class PanelController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function panelAction(Request $request){
        return $this->render(':Panel:panel.html.twig');
    }

    /**
     * @Route("/newEvent", name="NewEvent")
     */
    public function newEvent(Request $request){
        return $this->render(':Panel:panel.html.twig');
    }
}
