<?php

namespace App\Controller;

use App\Entity\Lesmodules;
use App\Form\LesmodulesType;
use App\Repository\LesmodulesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/lesmodules")
 */
class LesmodulesController extends AbstractController
{
    /**
     * @Route("/", name="app_lesmodules_index", methods={"GET"})
     */
    public function index(LesmodulesRepository $lesmodulesRepository): Response
    {
        return $this->render('lesmodules/index.html.twig', [
            'lesmodules' => $lesmodulesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_lesmodules_new", methods={"GET", "POST"})
     */
    public function new(Request $request, LesmodulesRepository $lesmodulesRepository): Response
    {
        $lesmodule = new Lesmodules();
        $form = $this->createForm(LesmodulesType::class, $lesmodule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTimeImmutable('now');
            $lesmodule->setCreatedBy($this->getUser()->getEmail());
            $lesmodule->setCreatedAt($date);
            $lesmodulesRepository->add($lesmodule);
            return $this->redirectToRoute('app_lesmodules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lesmodules/new.html.twig', [
            'lesmodule' => $lesmodule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_lesmodules_show", methods={"GET"})
     */
    public function show(Lesmodules $lesmodule): Response
    {
        return $this->render('lesmodules/show.html.twig', [
            'lesmodule' => $lesmodule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_lesmodules_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Lesmodules $lesmodule, LesmodulesRepository $lesmodulesRepository): Response
    {
        $form = $this->createForm(LesmodulesType::class, $lesmodule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lesmodulesRepository->add($lesmodule);
            return $this->redirectToRoute('app_lesmodules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lesmodules/edit.html.twig', [
            'lesmodule' => $lesmodule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_lesmodules_delete", methods={"POST"})
     */
    public function delete(Request $request, Lesmodules $lesmodule, LesmodulesRepository $lesmodulesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lesmodule->getId(), $request->request->get('_token'))) {
            $lesmodulesRepository->remove($lesmodule);
        }

        return $this->redirectToRoute('app_lesmodules_index', [], Response::HTTP_SEE_OTHER);
    }
}
