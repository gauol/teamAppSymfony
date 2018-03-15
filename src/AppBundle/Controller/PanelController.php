<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PanelController extends Controller
{
    /**
     * @Route("/panel", name="panel")
     */
    public function panelAction(Request $request)
    {
        return $this->render(':Panel:panel.html.twig');
    }
}
