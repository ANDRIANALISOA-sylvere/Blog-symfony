<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'attr'=>[
                    'placeholder'=>'Entrer votre nom',
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label mt-1'
                ],
                'label'=>'Nom',
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Le nom est obligatoire'
                    ])
                ]
            ])
            ->add('lastname',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'attr'=>[
                    'placeholder'=>'Entrer votre prenom',
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label mt-1'
                ],
                'label'=>'Prénom',
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Le prenom est obligatoire'
                    ])
                ]
            ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'placeholder'=>'Entrer votre email',
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label mt-1'
                ],
                'label'=>'Email',
                'constraints'=>[
                    new NotBlank([
                        'message'=>'L\'email est obligatoire'
                    ])
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type'=>PasswordType::class,
                'first_options'=>[
                    'label'=>"Mot de passe",
                    'attr'=>
                    [
                        'placeholder'=>'*****************',
                        'class'=>'form-control'
                    ],
                    'label_attr'=>[
                        'class'=>'form-label mt-3'
                    ]
                ],
                'second_options'=>[
                    'label'=>"Confirmer le mot de passe",
                    'attr'=>
                        [
                            'placeholder'=>'*****************',
                            'class'=>'form-control'
                        ],
                    'label_attr'=>[
                        'class'=>'form-label mt-3'
                    ]
                ],
                'invalid_message'=>"Le mot de passe ne correspond pas",
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe est obligatoire',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'votre mot de passe doit etre supérieur à  {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
