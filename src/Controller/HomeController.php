<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\GalleryRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/{order}", name="home")
     * @param EntityRepository|GalleryRepository $galleryRepository
     * @param string|null                        $order
     *
     * @return Response
     */
    public function index(GalleryRepository $galleryRepository, ?string $order = ''): Response
    {
        $galleries = $galleryRepository->findAllSortedByPhotosCount(strtoupper($order));

        return $this->render('homepage.html.twig', [
            'galleries' => $galleries,
        ]);
    }
}
