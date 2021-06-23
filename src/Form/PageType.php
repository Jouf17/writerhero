<?php

namespace App\Form;

use App\Entity\Page;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', NumberType::class, [
                'label' => 'Numéro de la page',
                'required' => true,
                'attr' => [
                    'readonly' => true
                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'Titre de la page (facultatif, ne sera pas affiché durant la lecture)',
                'required' => false
            ])
            ->add('text', CKEditorType::class, [
                'required' => false
            ])
            ->add('choice_1_text', TextType::class, [
                'label' => 'Choix 1 - Texte',
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
