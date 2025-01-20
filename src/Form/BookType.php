<?php

namespace App\Form;

use App\Entity\Knyga;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pavadinimas', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Pavadinimas negali būti tuščias']),
                ]
            ])
            ->add('autorius', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Autorius negali būti tuščias']),
                ]
            ])
            ->add('isleidimo_metai', IntegerType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Išleidimo metai negali būti tušti']),
                ]
            ])
            ->add('ISBN', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'ISBN negali būti tuščias']),
                    new Length([
                        'min' => 13,
                        'max' => 13,
                        'exactMessage' => 'ISBN turi būti 13 simbolių ilgio'
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]{13}$/',
                        'message' => 'ISBN turi būti sudarytas tik iš skaičių'
                    ])
                ]
            ])
            ->add('apie', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Aprašymas negali būti tuščias']),
                ]
            ])
            ->add('nuotrauka', TextType::class, [
                'required' => false
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