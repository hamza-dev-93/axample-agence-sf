<?php

namespace App\Controller\Admin;

use App\Entity\InfoOption;
use App\Form\InfoOptionType;
use App\Repository\InfoOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/info/option")
 */
class InfoOptionController extends AbstractController
{
    /**
     * @Route("/", name="info_option_index", methods={"GET"})
     */
    public function index(InfoOptionRepository $infoOptionRepository): Response
    {
        return $this->render('admin/info_option/index.html.twig', [
            'info_options' => $infoOptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="info_option_new", methods={"GET","POST"})
     */
    function new (Request $request): Response {
        $infoOption = new InfoOption();
        $form = $this->createForm(InfoOptionType::class, $infoOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infoOption);
            $entityManager->flush();

            return $this->redirectToRoute('info_option_index');
        }

        return $this->render('admin/info_option/new.html.twig', [
            'info_option' => $infoOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="info_option_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfoOption $infoOption): Response
    {
        $form = $this->createForm(InfoOptionType::class, $infoOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_option_index');
        }

        return $this->render('admin/info_option/edit.html.twig', [
            'info_option' => $infoOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_option_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InfoOption $infoOption): Response
    {
        if ($this->isCsrfTokenValid('delete' . $infoOption->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infoOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/info_option_index');
    }
}
