<?php
namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * HomeController.
 *
 * @author    Unknown
 * @since    v0.0.1
 * @version    v1.0.0    Thursday, July 25th, 2019.
 * @see        AbstractController
 * @global
 */
class HomeController extends AbstractController
{
    /**
     * index fonction symfony de testing retour un void
     *
     * @Route("/", name = "home")
     * @author    Hamza
     * @since    v0.0.1
     * @version   v1.0.0    Thursday, July 25th, 2019.
     * @access    public
     * @param    propertyrepository    $repo
     * 
     *
     */
    public function index(PropertyRepository $repo): Response
    {
        $properties = $repo->findAll();
        return $this->render('home/index.html.twig', [
            'current_menu' => 'home',
            'properties' => $properties,
        ]);
    }

}