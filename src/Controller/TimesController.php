<?php

namespace App\Controller;

use App\Entity\Times;
use App\Form\TimesType;
use App\Repository\TimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/times")
 */
class TimesController extends AbstractController
{
    /**
     * @Route("/", name="app_times_index", methods={"GET"})
     */
    public function index(TimesRepository $timesRepository): Response
    {
        return $this->render('times/index.html.twig', [
            'times' => $timesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_times_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TimesRepository $timesRepository): Response
    {
        $time = new Times();
        $form = $this->createForm(TimesType::class, $time);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timesRepository->add($time);
            return $this->redirectToRoute('app_times_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('times/new.html.twig', [
            'time' => $time,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_times_show", methods={"GET"})
     */
    public function show(Times $time): Response
    {

        
        return $this->render('times/show.html.twig', [
            'time' => $time,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_times_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Times $time, TimesRepository $timesRepository): Response
    {
        $form = $this->createForm(TimesType::class, $time);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timesRepository->add($time);
            return $this->redirectToRoute('app_times_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('times/edit.html.twig', [
            'time' => $time,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_times_delete", methods={"POST"})
     */
    public function delete(Request $request, Times $time, TimesRepository $timesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$time->getId(), $request->request->get('_token'))) {
            $timesRepository->remove($time);
        }

        return $this->redirectToRoute('app_times_index', [], Response::HTTP_SEE_OTHER);
    }
}
