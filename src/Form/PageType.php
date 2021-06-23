<?php

namespace App\Form;

use App\Entity\Page;
use App\Repository\PageRepository;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $book = $options['book'];
        
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
                'label' => 'Texte',
                'required' => false,
                'config' => [
                    'height' => '500px'
                ]
            ])
            ->add('choice_1_text', TextType::class, [
                'label' => 'Choix 1 - Texte',
                'required' => false
            ])
            ->add('choice_1_target', EntityType::class, [
                'label' => 'Choix 1 - Page cible',
                'class' => Page::class,
                'query_builder' => function (PageRepository $pageRepository) use ($book) {
                    return $pageRepository->findPagesByBook($book);
                },
                'required' => false
            ])
            ->add('choice_2_text', TextType::class, [
                'label' => 'Choix 2 - Texte',
                'required' => false
            ])
            ->add('choice_2_target', EntityType::class, [
                'label' => 'Choix 2 - Page cible',
                'class' => Page::class,
                'query_builder' => function (PageRepository $pageRepository) use ($book) {
                    return $pageRepository->findPagesByBook($book);
                },
                'required' => false
            ])
            ->add('choice_3_text', TextType::class, [
                'label' => 'Choix 3 - Texte',
                'required' => false
            ])
            ->add('choice_3_target', EntityType::class, [
                'label' => 'Choix 3 - Page cible',
                'class' => Page::class,
                'query_builder' => function (PageRepository $pageRepository) use ($book) {
                    return $pageRepository->findPagesByBook($book);
                },
                'required' => false
            ])
            ->add('choice_4_text', TextType::class, [
                'label' => 'Choix 4 - Texte',
                'required' => false
            ])
            ->add('choice_4_target', EntityType::class, [
                'label' => 'Choix 4 - Page cible',
                'class' => Page::class,
                'query_builder' => function (PageRepository $pageRepository) use ($book) {
                    return $pageRepository->findPagesByBook($book);
                },
                'required' => false
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
            'book' => true
        ]);
    }
}
