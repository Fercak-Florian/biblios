<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdministrationController extends AbstractController
{
    #[Route('/administration', name: 'app_administration')]
    public function index(): Response
    {
        return $this->render('admin/administration/index.html.twig');
    }
}
