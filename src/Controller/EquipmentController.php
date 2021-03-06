<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\Calculator;

/**
 * @Route("/equipment")
 */
class EquipmentController extends AbstractController
{
    /**
     * @Route("/", name="equipment_index", methods={"GET"})
     */
    public function index(EquipmentRepository $equipmentRepository): Response
    {
        return $this->render('equipment/index.html.twig', [
            'equipment' => $equipmentRepository->findAll(),
        ]);
    }
    /**
     * @Route("/simple/tractor", name="simple_equipment_tractor", methods={"GET"})
     * @Route("/simple/harvester", name="simple_equipment_harvester", methods={"GET"})
     * @Route("/simple/trailer", name="simple_equipment_trailer", methods={"GET"})
     */
    public function simpleEquipment(SessionInterface $session, Request $request, Calculator $calculator): Response
    {
        $size = $request->query->get('size');
        $age = $request->query->get('age');
        $color = $request->query->get('color');
        $usage = $request->query->get('usage');

        if ($age != null) {
            $session->set('age', $age);
        }
        if ($size != null) {
            $session->set('size', $size);
        }
        if ($color != null) {
            $session->set('color', $color);
        }
        if ($usage != null) {
            $session->set('usage', $usage);
        }

        $results = $calculator->estimate();
        $resultMin = $results['min'] ?? 0;
        $resultMax = $results['max'] ?? 1000000;

        return $this->render('equipment/simple.html.twig', [
            'size' => $session->get('size'),
            'age' => $session->get('age'),
            'color' => $session->get('color'),
            'usage' => $session->get('usage'),
            'resultMin' => $resultMin,
            'resultMax' => $resultMax,
            'currentPage' => 'equipment_index'
        ]);
    }

    /**
     * @Route("/new", name="equipment_new", methods={"GET","POST"})
     */
    public function new(Request $request, Calculator $calculator): Response
    {
        $equipment = new Equipment();
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estimate = $calculator->fineEstimate($equipment);
            $equipment->setUseCost($estimate);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipment);
            $entityManager->flush();

            return $this->redirectToRoute('equipment_index');
        }

        return $this->render('equipment/new.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView(),
            'currentPage' => 'equipment_new'
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_show", methods={"GET"})
     */
    public function show(Equipment $equipment): Response
    {
        return $this->render('equipment/show.html.twig', [
            'equipment' => $equipment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="equipment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Equipment $equipment): Response
    {
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipment_index');
        }

        return $this->render('equipment/edit.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Equipment $equipment): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($equipment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('equipment_index');
    }
}
