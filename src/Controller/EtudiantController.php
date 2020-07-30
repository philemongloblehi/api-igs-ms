<?php

namespace App\Controller;

use App\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/api/etudiants", name="api_create_etudiant", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function createEtudiant(): JsonResponse
   {
       $etudiant = new Etudiant();

       $etudiant->setNom('Kini');
       $etudiant->setPrenoms('Hermann');
       $etudiant->setAge(20);
       $etudiant->setEmail('kini@gmail.com');
       $etudiant->setTelephone('+225 00 00 00 00');

       $entityManager = $this->getDoctrine()->getManager();

       $entityManager->persist($etudiant);
       $entityManager->flush();

       return new JsonResponse($etudiant, Response::HTTP_CREATED);
   }

    /**
     * @Route("/api/etudiants", name="api_list_etudiant", methods={"GET"})
     *
     * @return JsonResponse
     */
   public function listEtudiants(): JsonResponse
   {
        $repository = $this->getDoctrine()->getRepository(Etudiant::class);

        $etudiants = $repository->findAll();

        return new JsonResponse($etudiants, Response::HTTP_OK);
   }

    /**
     * @Route("/api/etudiants/{id}", name="api_details_etudiant", methods={"GET"})
     *
     * @param $id
     * @return JsonResponse
     */
   public function detailEtudiant(int $id): JsonResponse
   {
       $repository = $this->getDoctrine()->getRepository(Etudiant::class);

       $etudiant = $repository->find($id);

       if (empty($etudiant)) {
           return new JsonResponse(['Erreur' => 'Cet etudiant n\'existe pas !'], Response::HTTP_NOT_FOUND);
       }

       return new JsonResponse($etudiant, Response::HTTP_OK);
   }

    /**
     * @Route("/api/etudiants/{id}", name="api_update_etudiant", methods={"PUT"})
     *
     * @param int $id
     * @return JsonResponse
     */
   public function updateEtudiant(int $id): JsonResponse
   {
       $repository = $this->getDoctrine()->getRepository(Etudiant::class);

       $etudiant = $repository->find($id);

       if (empty($etudiant)) {
           return new JsonResponse(['Erreur' => 'Cet etudiant n\'existe pas !'], Response::HTTP_NOT_FOUND);
       }

       $etudiant->setTelephone('+225 79 08 10 50');
       $etudiant->setEmail('philemongloblehi@gmail.com');

       $entityManager = $this->getDoctrine()->getManager();

       $entityManager->flush();

       return new JsonResponse($etudiant, Response::HTTP_OK);
   }

    /**
     * @Route("/api/etudiants/{id}", name="api_remove_etudiant", methods={"DELETE"})
     *
     * @param int $id
     * @return JsonResponse
     */
   public function removeEtudiant(int $id): JsonResponse
   {
       $repository = $this->getDoctrine()->getRepository(Etudiant::class);

       $etudiant = $repository->find($id);

       if (empty($etudiant)) {
           return new JsonResponse(['Erreur' => 'Cet etudiant n\'existe pas !'], Response::HTTP_NOT_FOUND);
       }

       $entityManager = $this->getDoctrine()->getManager();

       $entityManager->remove($etudiant);

       $entityManager->flush();

       return new JsonResponse('', Response::HTTP_NO_CONTENT);
   }
}
