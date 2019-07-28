<?php
namespace App\Controller;

use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(PaginatorInterface $paginator, PropertyRepository $repo, Request $request): Response
    {
        //code qui config la formSearch pour filtrer data
        $search = new PropertySearch();
        $formSearch = $this->createForm(PropertySearchType::class, $search);
        $formSearch->handleRequest($request);

        if ($search) {
            $query = $repo->findAllVisibleQuery($search);
        } else {
            # code...
            $query = $repo->findAllVisibleQuery();
        }

        $req = $request->query->getInt('page', 1);
        $properties = $paginator->paginate($query, $req, 6);

        // $properties = $repo->findAll();
        return $this->render('home/index.html.twig', [
            'current_menu' => 'home',
            'properties' => $properties,
            'formSearch' => $formSearch->createView(),
        ]);
    }

}
