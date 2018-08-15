<?php

namespace Biopen\CoreBundle\Controller;

use Biopen\CoreBundle\Controller\GoGoController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Biopen\SaasBundle\Helper\SaasHelper;

class CoreController extends GoGoController
{
    public function homeAction()
    {
        $sassHelper = new SaasHelper();
        if ($this->container->getParameter('use_as_saas') && $sassHelper->isRootProject()) return $this->redirectToRoute('biopen_saas_home');

        $em = $this->get('doctrine_mongodb')->getManager();
        // Get Wrapper List        
        $listWrappers = $em->getRepository('BiopenCoreBundle:Wrapper')
        ->findAllOrderedByPosition();
        $mainCategory = $em->getRepository('BiopenGeoDirectoryBundle:Category')->findOneByIsRootCategory(true);
        $mainOptions = $mainCategory ? $mainCategory->getOptions() : [];

        $this->get('session')->clear();
        
        return $this->render('@BiopenCoreBundle/home.html.twig', array('listWrappers' => $listWrappers, 'mainOptions' => $mainOptions));
    }

    public function headerAction($title = "GoGoCarto") 
    {          
        return $this->render('@BiopenCoreBundle/header.html.twig', array("title" => $title, "renderedFromController" => true)); 
    }
    
    public function partnersAction()
    {        
    	$repository = $this
    	  ->get('doctrine_mongodb')->getManager()
    	  ->getRepository('BiopenCoreBundle:Partner');

        $listPartners = $repository->findAllOrderedByPosition();

        return $this->render('@BiopenCoreBundle/partners.html.twig', array('listPartners' => $listPartners));
        
    }    
}
