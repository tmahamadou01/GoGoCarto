<?php

namespace Biopen\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CoreController extends Controller
{
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        // Get Wrapper List        
        $listWrappers = $em->getRepository('BiopenCoreBundle:Wrapper')
        ->findAll();
        $this->get('session')->clear();
        
        return $this->render('@BiopenCoreBundle/home.html.twig', array('listWrappers' => $listWrappers));
    }
    
    public function partnersAction()
    {
        $em = $this->getDoctrine()->getManager();

        // Get Partner List        
        $listPartners = $em->getRepository('BiopenCoreBundle:Partner')
        ->findAll();

        return $this->render('@BiopenCoreBundle/partners.html.twig', array('listPartners' => $listPartners));
        
    }

    public function headerAction(){
        $em = $this->getDoctrine()->getManager();
        // Get About List        
        $listAbouts = $em->getRepository('BiopenCoreBundle:About')
        ->findAll();
        
        return $this->render('@BiopenCoreBundle/header.html.twig', array('listAbouts' => $listAbouts));
    }
    
    public function partnersAction()
    {
        
    	$repository = $this
    	  ->getDoctrine()
    	  ->getManager()
    	  ->getRepository('BiopenCoreBundle:Partner');

        $listPartners = $repository->findAll();

        return $this->render('@BiopenCoreBundle/partners.html.twig', array('listPartners' => $listPartners));
        
    }
}
