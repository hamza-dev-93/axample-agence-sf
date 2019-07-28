<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
    /**
     * @var        mixed    $repository
     */
    private $repo;
    private $manager;

    /**
     * __construct.
     *
     * @author    Hamza
     * @since    v1.0.0
     * @version    v1.0.0    Friday, July 26th, 2019.
     * @access    public
     * @param    propertyrepository    $repo
     *
     */
    public function __construct(PropertyRepository $repo, ObjectManager $manager)
    {
        $this->repo = $repo;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin", name="admin_property_index")
     *
     *
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        //code qui config la formSearch pour filtrer data
        $search = new PropertySearch();
        $formSearch = $this->createForm(PropertySearchType::class, $search);
        $formSearch->handleRequest($request);

        //code qui recupere data de database table Property avec config pagination
        if ($search) {
            $query = $this->repo->findAllVisibleQuery($search);
        } else {
            # code...
            $query = $this->repo->findAllVisibleQuery();
        }
        $req = $request->query->getInt('page', 1);
        $properties = $paginator->paginate($query, $req, 6);

        // $properties = $this->repo->findAll();
        return $this->render('admin/property/index.html.twig', [
            'current_menu' => 'Admin',
            'properties' => $properties,
            'formSearch' => $formSearch->createView(),

        ]);
    }

    /**
     * new.
     * @Route("/admin/property/create", name="admin_property_new" )
     *
     * @author    Hamza
     * @since    v1.0.0
     * @version    v1.0.0    Friday, July 26th, 2019.
     * @access    public
     *
     */
    function new (Request $req) {
        $repo = new Property();

        $formProperty = $this->createForm(PropertyType::class, $repo);

        $formProperty->handleRequest($req);
        if ($formProperty->isSubmitted() && $formProperty->isValid()) {
            $this->manager->persist($repo);
            $this->manager->flush();
            $this->addFlash('success', 'Le bien a été bien enregistré avec succés !');

            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $repo,
            'formproperty' => $formProperty->createView(),

        ]);

    }

    /**
     * edit.  sert a editer les info concernant la proprieté
     * @Route("/admin/{id}", name="admin_property_edit")
     *
     * @author    Hamza
     * @since    v1.0.0
     * @version    v1.0.0    Friday, July 26th, 2019.
     * @version    v1.0.1    Friday, July 26th, 2019.
     * @access    public
     * @param    property         $repo
     * @param    request          $req
     * @param    objectmanager    $manager
     * 
     */
    public function edit(Property $repo, Request $req)
    {

        // $option = new Option();
        // $repo->addOption();

        $formProperty = $this->createForm(PropertyType::class, $repo);

        $formProperty->handleRequest($req);
        if ($formProperty->isSubmitted() && $formProperty->isValid()) {
            // $this->manager->persist($formProperty);
            
            $this->manager->flush();
            $this->addFlash('success', 'Le bien a été bien modifié avec succés !');
            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'property' => $repo,
            'formproperty' => $formProperty->createView(),

        ]);

    }

    /**
     * @Route("/admin/delete/{id}", name="admin_property_delete")
     *
     *
     */
    public function delete(Property $property, Request $req)
    {

        if ($this->isCsrfTokenValid('delete' . $property->getId(), trim($req->get('_token')))) {

            $this->manager->remove($property);
            $this->manager->flush();
            $this->addFlash('success', 'Le bien a été bien supprimé avec succés !');
            return $this->redirectToRoute('admin_property_index');

        }

        return $this->render('admin/property/index.html.twig', [
            'current_menu' => 'Admin',
            'properties' => $this->repo->findAll(),
        ]);

    }

}
