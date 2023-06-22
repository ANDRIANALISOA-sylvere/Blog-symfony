<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserHomePageController extends AbstractController
{
    #[Route('/home', name: 'app_user_home_page')]
    public function index(PostRepository $postrepository,PaginatorInterface $paginator,Request $request): Response
    {
        $post=$paginator->paginate(
            $postrepository->findBy([],['createdAt'=>'DESC']),
            $request->query->getInt('page',1),
            8
        );
        return $this->render('user_home_page/index.html.twig', [
            'posts'=>$post,
        ]);
    }
    #[Route('/post/{id}', name: 'app_user_home_page_about')]
    public function about(PostRepository $postrepository,$id): Response
    {
        $post=$postrepository->findOneBy(['id'=>$id]);
        return $this->render('user_home_page/post.html.twig', [
            'posts'=>$post
        ]);
    }
    #[Route('/mes_article',name:'app_user_page_mes_articles')]
    public function article():Response
    {
        return $this->render('user_home_page/articles.html.twig');
    }
}
?>

