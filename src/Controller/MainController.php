<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    /**
     * @Route("/gestion/calendrier", name="app_gestion_calendrier")
     */
    public function calendrier(CalendrierRepository $calendrier): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        foreach ($events as $event){

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),


            ];
            

            $data = json_encode($rdvs);
        }

        if (compact('data')){
           
        }else{
             $data=null;
        }

        return $this->render('main/gestion_calendrier.html.twig',compact('data'));
    }

    /**
     * @Route("/calendrier_etudiant", name="app_calendrier_etudiant")
     */
    public function calendrierEtudiant(CalendrierRepository $calendrier): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        foreach ($events as $event){

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),


            ];

            $data = json_encode($rdvs);
        }
        return $this->render('main/calendrier_etudiant.html.twig',compact('data'));
    }

     /**
     * @Route("/calendrier_intervenant", name="app_calendrier_intervenant")
     */
    public function calendrierIntervenant(CalendrierRepository $calendrier): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        foreach ($events as $event){

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),


            ];

            $data = json_encode($rdvs);
        }
        return $this->render('main/calendrier_intervenant.html.twig',compact('data'));
    }
}
