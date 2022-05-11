<?php

namespace App\Controller;

use App\Entity\Chapitres;
use App\Form\ChapitresType;
use App\Repository\ChapitresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chapitres")
 */
class ChapitresController extends AbstractController
{
    /**
     * @Route("/", name="app_chapitres_index", methods={"GET"})
     */
    public function index(ChapitresRepository $chapitresRepository): Response
    {
        return $this->render('chapitres/index.html.twig', [
            'chapitres' => $chapitresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_chapitres_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ChapitresRepository $chapitresRepository): Response
    {
        $chapitre = new Chapitres();
        $form = $this->createForm(ChapitresType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $date = new \DateTimeImmutable('now');
            $chapitre->setCreatedBy($this->getUser()->getEmail());
            $chapitre->setCreatedAt($date);
            $chapitresRepository->add($chapitre);
            return $this->redirectToRoute('app_chapitres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chapitres/new.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_chapitres_show", methods={"GET"})
     */
    public function show(Chapitres $chapitre): Response
    {
        return $this->render('chapitres/show.html.twig', [
            'chapitre' => $chapitre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_chapitres_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Chapitres $chapitre, ChapitresRepository $chapitresRepository): Response
    {
        $form = $this->createForm(ChapitresType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chapitresRepository->add($chapitre);
            return $this->redirectToRoute('app_chapitres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chapitres/edit.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_chapitres_delete", methods={"POST"})
     */
    public function delete(Request $request, Chapitres $chapitre, ChapitresRepository $chapitresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chapitre->getId(), $request->request->get('_token'))) {
            $chapitresRepository->remove($chapitre);
        }

        return $this->redirectToRoute('app_chapitres_index', [], Response::HTTP_SEE_OTHER);
    }
}
