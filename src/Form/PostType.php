<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'attr'=>[
                    'placeholder'=>'Entrer le titre',
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label mt-3'
                ]
            ])
            ->add('description',TextareaType::class,[
                'attr'=>[
                    'placeholder'=>'Entrer la description',
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                        'class'=>'form-label mt-3'
                    ]
            ])
            ->add('image',FileType::class,[
                'attr'=>[
                    'placeholder'=>"Choisir l'image",
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label mt-3'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
