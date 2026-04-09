<?php

namespace App\Controller\Admin;

use App\Entity\Editor;
use App\Form\EditorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/editor')]
class EditorController extends AbstractController
{
    #[Route('', name: 'app_admin_editor_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('admin/editor/index.html.twig', [
            'controller_name' => 'EditorController',
        ]);
    }

    #[IsGranted('ROLE_AJOUT')]
    #[Route('/{id}/edit', name: 'app_admin_editor_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[Route('/new', name: 'app_admin_editor_new', methods: ['GET', 'POST'])]
    public function new(?Editor $editor,Request $request, EntityManagerInterface $manager): Response
    {
        if ($editor) {
            $this->denyAccessUnlessGranted('ROLE_EDITION');
        }

        $editor = new Editor();
        $form = $this->createForm(EditorType::class, $editor);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($editor);
            $manager->flush();

            return $this->redirectToRoute('app_admin_editor_new');
        }

        return $this->render('admin/editor/new.html.twig', [
            'form' => $form
        ]);
    }
}
