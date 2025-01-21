<?php

namespace App\Form;

use App\Entity\Knyga;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /* Validation for Book fields */
        $builder
            ->add('pavadinimas', TextType::class, [
                'label' => 'Pavadinimas',
                'attr' => [
                    'placeholder' => 'Įveskite knygos pavadinimą'
                ]
            ])
            ->add('autorius', TextType::class, [
                'label' => 'Autorius',
                'attr' => [
                    'placeholder' => 'Įveskite autoriaus vardą'
                ]
            ])
            ->add('isleidimo_metai', IntegerType::class, [
                'label' => 'Išleidimo metai',
                'attr' => [
                    'placeholder' => 'Įveskite išleidimo metus'
                ]
            ])
            ->add('ISBN', TextType::class, [
                'label' => 'ISBN',
                'attr' => [
                    'placeholder' => 'Įveskite 13 skaitmenų ISBN'
                ]
            ])
            ->add('apie', TextareaType::class, [
                'label' => 'Aprašymas',
                'attr' => [
                    'placeholder' => 'Įveskite knygos aprašymą',
                    'rows' => 5
                ]
            ])
            ->add('nuotrauka', FileType::class, [
                'label' => 'Viršelio nuotrauka',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, JPG, PNG)',
                    ])
                ],
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Knyga::class,
        ]);
    }
}