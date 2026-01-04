<?php

namespace App\Controller;

use App\Entity\Taxi;
use App\Repository\TaxiRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TaxiController extends AbstractController   
{ 
      

    #[Route('/', name: 'home')]
    public function index(TaxiRepository $taxi): Response
    {
        $taxis = $taxi->findAll();
        return $this->render('taxi/index.html.twig', ['taxis' => $taxis]);
    }

    #[Route('/taxi/new', name: 'taxi_new')]
    public function new(): Response
    {
        return $this->render('taxi/new.html.twig');
    }

    #[Route('/taxi/create', name: 'taxi_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $taxi = new Taxi();

        $taxi->setPlaque($request->request->get('plaque'));
        $taxi->setChauffeur($request->request->get('chauffeur'));
        $taxi->setZone($request->request->get('zone'));
        $taxi->setDisponible((bool)$request->request->get('disponible'));

        $dateString = $request->request->get('date_mise_circulation');
        if ($dateString) {
            $date = new \DateTime($dateString);
            $taxi->setDateMiseCirculation($date);
        }

        $entityManager->persist($taxi); 
        $entityManager->flush();

        $this->addFlash('success', 'Taxi created successfully!');
        return $this->redirectToRoute('home');
    }


    #[Route('/taxi/{id}', name: 'taxi_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(TaxiRepository $taxi, $id): Response
    {
        $taxi = $taxi->find($id);
        return $this->render('taxi/show.html.twig', [
            'taxi' => $taxi,
        ]);
    }

    #[Route('/taxi/{id}/edit', name: 'taxi_edit', requirements: ['id' => '\d+'])]
    public function edit(Taxi $taxi): Response
    {
        return $this->render('taxi/edit.html.twig', [
            'taxi' => $taxi,
        ]);
    }

    #[Route('/taxi/{id}/update', name: 'taxi_update', methods: ['POST'])]
    public function update(Request $request, Taxi $taxi, EntityManagerInterface $entityManager): Response
    {
        $taxi->setPlaque($request->request->get('plaque'));
        $taxi->setChauffeur($request->request->get('chauffeur'));
        $taxi->setZone($request->request->get('zone'));
        $taxi->setDisponible((bool)$request->request->get('disponible'));

        $dateString = $request->request->get('date_mise_circulation');
        if ($dateString) {
            $date = new \DateTime($dateString);
            $taxi->setDateMiseCirculation($date);
        }

        $entityManager->flush();

        $this->addFlash('success', 'Taxi updated successfully!');
        return $this->redirectToRoute('home');
    }

    #[Route('/taxi/{id}/delete', name: 'taxi_delete', methods: ['POST'])]
    public function delete(Taxi $taxi, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($taxi); 
        $entityManager->flush();

        $this->addFlash('success', 'Taxi deleted successfully!');
        return $this->redirectToRoute('home');
    }
}
