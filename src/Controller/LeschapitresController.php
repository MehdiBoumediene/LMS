<?php

namespace App\Controller;

use App\Entity\Leschapitres;
use App\Entity\Files;
use App\Entity\Lesmodules;
use App\Entity\Couvertures;
use App\Entity\Medias;
use App\Entity\Times;
use App\Form\LeschapitresType;
use App\Repository\LeschapitresRepository;
use App\Repository\BlocsRepository;
use App\Repository\FormationsRepository;
use App\Repository\LesmodulesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leschapitres")
 */
class LeschapitresController extends AbstractController
{
    /**
     * @Route("/", name="app_leschapitres_index", methods={"GET"})
     */
    public function index(LeschapitresRepository $leschapitresRepository): Response
    {
        return $this->render('leschapitres/index.html.twig', [
            'leschapitres' => $leschapitresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/formations", name="app_formations", methods={"GET"})
     */
    public function formations(LeschapitresRepository $LeschapitresRepository): Response
    {
    

        return $this->render('modules/formations.html.twig', [
            'chapitres' => $LeschapitresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/showformations", name="app_formationshow", methods={"GET"})
     */
    public function formationshow(FormationsRepository $formationsRepository): Response
    {
    

        return $this->render('modules/formationshow.html.twig', [
            'formations' => $formationsRepository->findAll(),
        ]);
    }


     /**
     * @Route("/blocsformations/{id}", name="app_blocsformations", methods={"GET"})
     */
    public function blocsformations(BlocsRepository $blocsRepository, $id): Response
    {
    

        return $this->render('modules/blocsformations.html.twig', [
            'blocs' => $blocsRepository->findBy(['formations'=>$id]),
        ]);
    }


         /**
     * @Route("/modulesblocs/{id}", name="app_modulesblocs", methods={"GET"})
     */
    public function modulesblocs(LesmodulesRepository $lesmodulesRepository, $id): Response
    {
    

        return $this->render('modules/modulesblocs.html.twig', [
            'modules' => $lesmodulesRepository->findBy(['blocs'=>$id]),
        ]);
    }

    /**
     * @Route("/moduleschapitres/{id}", name="app_moduleschapitres", methods={"GET"})
     */
    public function moduleschapitres(LesmodulesRepository $lesmodulesRepository, $id): Response
    {
    

        return $this->render('modules/moduleschapitres.html.twig', [
            'modules' => $lesmodulesRepository->findBy(['formations'=>$id]),
        ]);
    }

    /**
     * @Route("/modulesblocs/show/{id}", name="app_leschapitres_show", methods={"GET"})
     */
    public function show(Leschapitres $leschapitre): Response
    {

        $timer = $this->getDoctrine()->getRepository(Times::class)->findOneBy(['user'=> $this->getUser()]) ;            


        return $this->render('modules/show.html.twig', [
            'module' => $leschapitre,
            'timer' => $timer,
        ]);
    }


    /**
     * @Route("/new", name="app_leschapitres_new", methods={"GET", "POST"})
     */
    public function new(Request $request, LeschapitresRepository $leschapitresRepository): Response
    {
        $leschapitre = new Leschapitres();
        $form = $this->createForm(LeschapitresType::class, $leschapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           // Je récupère les videos transmises
           $videos = $form->get('medias')->getData();
        
           $files = $form->get('files')->getData();
        
           // Je boucle sur les videos
           foreach($videos as $video){
               // Je génère un nouveau nom de fichier
               $fichier = md5(uniqid()) . '.' . $video->guessExtension();

               // Je copie le fichier dans le dossier uploads
               $video->move(
                   $this->getParameter('videos_directory'),
                   $fichier
               );

               // Je stocke la video dans la BDD (nom du fichier)
               $media= new Medias();
               $media->setName($fichier);
               $media->setNom($fichier);
               $leschapitre->addMedia($media);

           }

    
            // Je boucle sur les documents
            foreach($files as $file){
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

               // Je génère un nouveau nom de fichier
               $fichier = $originalFilename . '.' . $file->guessExtension();

               // Je copie le fichier dans le dossier uploads
               $file->move(
                   $this->getParameter('videos_directory'),
                   $fichier
               );

               // Je stocke le document dans la BDD (nom du fichier)
               $file= new Files();
               $file->setName($fichier);
               $file->setNom($fichier);
               $leschapitre->addFile($file);

           }

           $date = new \DateTimeImmutable('now');
           $leschapitre->setCreatedBy($this->getUser()->getEmail());
           $leschapitre->setUsers($this->getUser());
           $leschapitre->setCreatedAt($date);
           $leschapitresRepository->add($leschapitre);
           return $this->redirectToRoute('app_leschapitres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('leschapitres/new.html.twig', [
            'leschapitre' => $leschapitre,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="app_leschapitres_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Leschapitres $leschapitre, LeschapitresRepository $leschapitresRepository): Response
    {
        $form = $this->createForm(LeschapitresType::class, $leschapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $leschapitresRepository->add($leschapitre);
            return $this->redirectToRoute('app_leschapitres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('leschapitres/edit.html.twig', [
            'leschapitre' => $leschapitre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_leschapitres_delete", methods={"POST"})
     */
    public function delete(Request $request, Leschapitres $leschapitre, LeschapitresRepository $leschapitresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leschapitre->getId(), $request->request->get('_token'))) {
            $leschapitresRepository->remove($leschapitre);
        }

        return $this->redirectToRoute('app_leschapitres_index', [], Response::HTTP_SEE_OTHER);
    }


 
}
