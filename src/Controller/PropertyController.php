<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    private $repo;
    /**
     * __construct
     *
     * @param PropertyRepository $repo
     *
     */
    public function __construct(PropertyRepository $repo)
    {
        return $this->repo = $repo;

    }

    /**
     * @Route("/biens", name="property_index")
     *
     *
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        //code qui config la formSearch pour filtrer data
        $search = new PropertySearch();
        $formSearch = $this->createForm(PropertySearchType::class, $search);
        $formSearch->handleRequest($request);

        if ($search) {
            $query = $this->repo->findAllVisibleQuery($search);
        } else {
            # code...
            $query = $this->repo->findAllVisibleQuery();
        }
        $req = $request->query->getInt('page', 1);
        $properties = $paginator->paginate($query, $req, 6);

        // $properties = $this->repo->findAll();
        return $this->render('property/index.html.twig', [
            'current_menu' => 'Admin',
            'properties' => $properties,
            'formSearch' => $formSearch->createView(),

        ]);
    }

    public function indexold(ObjectManager $manager, PropertyRepository $repo): Response
    {
        $repo->findAllVisible();

        // initiation de table property avec des donnes de title: premier bien
        // $property = new Property();
        // $property->setTitle('premier bien maison')
        //     ->setPrice(200000)
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setDescription('joli petite maison')
        //     ->setSurface(90)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setAddress('1 rue de la gare')
        //     ->setCity('Villepinte')
        //     ->setPostalCode(93420);

        // $manager->persist($property);
        // $manager->flush();

        return $this->render('property/index.html.twig', [
            'current_menu' => 'property',
        ]);
    }

    /**
     * @Route("/biens/{id}-{slug}", name="property_show")
     * @param Property $property
     * @return Response
     */
    public function show(Property $repo, $slug): Response
    {

        if ($repo->getSlug() !== $slug) {
            return $this->redirectToRoute("property_show", [
                'id' => $repo->getId(),
                'slug' => $repo->getSlug(),
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property' => $repo,
        ]);

    }

}
