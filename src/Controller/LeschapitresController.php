<?php

namespace App\Controller;

use App\Entity\Leschapitres;
use App\Entity\Files;
use App\Entity\Lesmodules;
use App\Entity\Couvertures;
use App\Entity\Medias;
use App\Form\LeschapitresType;
use App\Repository\LeschapitresRepository;
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
           $couvertures = $form->get('couvertures')->getData();
           $files = $form->get('files')->getData();
           $nomFile = $_POST["nomFile"];
           $nomVideo = $_POST["nomVideo"];
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
               $media->setNom($nomVideo);
               $leschapitre->addMedia($media);

           }

            // Je boucle sur les couvertures
            foreach($couvertures as $couverture){
               // Je génère un nouveau nom de fichier
               $fichier = md5(uniqid()) . '.' . $couverture->guessExtension();

               // Je copie le fichier dans le dossier uploads
               $couverture->move(
                   $this->getParameter('videos_directory'),
                   $fichier
               );

               // Je stocke la photo dans la BDD (nom du fichier)
               $image= new Couvertures();
               $image->setName($fichier);
               $leschapitre->addCouverture($image);

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
               $file->setNom($nomFile);
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
     * @Route("/{id}", name="app_leschapitres_show", methods={"GET"})
     */
    public function show(Leschapitres $leschapitre): Response
    {
        return $this->render('leschapitres/show.html.twig', [
            'leschapitre' => $leschapitre,
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
