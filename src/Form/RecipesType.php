<?php

namespace App\Form;

use App\Entity\Ingredients;
use App\Entity\Recipes;
use App\Entity\Steps;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('steps')
            // ->add('rating')
            ->add('picture')
            // ->add('lunchs')
            ->add('ingredients', EntityType::class, [
                "class" => Ingredients::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('steps', EntityType::class, [
                "class" => Steps::class,
                'choice_label' => 'text',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
