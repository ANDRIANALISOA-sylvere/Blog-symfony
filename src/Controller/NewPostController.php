<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewPostController extends AbstractController
{
    #[Route('/new/post', name: 'app_new_post')]
    public function index(Request $request, #[Autowire('%photo_dir%')] string $photoDir, EntityManagerInterface $manager): Response
    {
        $post = new Post();
        $user = $this->getUser();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($user);
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setUpdatedAt(new \DateTimeImmutable());
            $post = $form->getData();

            if ($photo = $form['image']->getData()) {
                $filename = uniqid() . '.' . $photo->guessExtension();
                $photo->move($photoDir, $filename);

                $post->setImage($filename);
            }

            if ($photos = $form['images']->getData()) {
                $fileArray = [];

                foreach ($photos as $key => $photo) {
                    $file = uniqid() . '.' . $photo->guessExtension();
                    $photo->move($photoDir, $file);
                    $fileArray[] = $file;
                }
                $post->setImage($file);
            }
            $this->addFlash(
                'success',
                'Votre article a été posté avec succès'
            );

            $manager->persist($post);
            $manager->flush();

            return $this->redirectToRoute("app_user_home_page_about",[
                "id"=>$post->getId(),
            ]);
        }
        return $this->render('new_post/index.html.twig', [
            'post' => $form->createView(),
        ]);
    }
}
