<?php

namespace App\Controller;

use App\Entity\Couvertures;
use App\Entity\Files;
use App\Entity\Modules;
use App\Entity\Medias;
use App\Form\ModulesType;
use App\Repository\ModulesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IntervenantsRepository;

/**
 * @Route("/modules")
 */
class ModulesController extends AbstractController
{
    /**
     * @Route("/", name="app_modules_index", methods={"GET"})
     */
    public function index(ModulesRepository $modulesRepository): Response
    {
        return $this->render('modules/index.html.twig', [
            'modules' => $modulesRepository->findAll(),
        ]);
    }

     /**
     * @Route("/formations", name="app_formations", methods={"GET"})
     */
    public function formations(ModulesRepository $modulesRepository): Response
    {
        return $this->render('modules/formations.html.twig', [
            'modules' => $modulesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_modules_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ModulesRepository $modulesRepository): Response
    {
        $module = new Modules();
        $form = $this->createForm(ModulesType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Je récupère les videos transmises
            $videos = $form->get('medias')->getData();
            $couvertures = $form->get('couvertures')->getData();
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
                $module->addMedia($media);

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
                $module->addCouverture($image);

            }


             // Je boucle sur les documents
             foreach($files as $file){
                // Je génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $file->guessExtension();

                // Je copie le fichier dans le dossier uploads
                $file->move(
                    $this->getParameter('videos_directory'),
                    $fichier
                );

                // Je stocke le document dans la BDD (nom du fichier)
                $file= new Files();
                $file->setName($fichier);
                $module->addFile($file);

            }

            $date = new \DateTimeImmutable('now');
            $module->setCreatedBy($this->getUser()->getEmail());
            $module->setUsers($this->getUser());
            $module->setCreatedAt($date);
            $modulesRepository->add($module);
            return $this->redirectToRoute('app_modules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modules/new.html.twig', [
            'module' => $module,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_modules_show", methods={"GET"})
     */
    public function show(Modules $module): Response
    {
        return $this->render('modules/show.html.twig', [
            'module' => $module,
        
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_modules_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Modules $module, ModulesRepository $modulesRepository): Response
    {
        $form = $this->createForm(ModulesType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modulesRepository->add($module);
            return $this->redirectToRoute('app_modules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modules/edit.html.twig', [
            'module' => $module,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_modules_delete", methods={"POST"})
     */
    public function delete(Request $request, Modules $module, ModulesRepository $modulesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$module->getId(), $request->request->get('_token'))) {
            $modulesRepository->remove($module);
        }

        return $this->redirectToRoute('app_modules_index', [], Response::HTTP_SEE_OTHER);
    }
}
