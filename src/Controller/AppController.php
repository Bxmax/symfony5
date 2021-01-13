<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginator): Response
    {
        $articles = $articleRepository->findAll();

        $articles = $paginator->paginate(
            $articles, /* query NOT result */
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('app/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
