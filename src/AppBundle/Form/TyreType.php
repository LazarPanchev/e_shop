<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TyreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose a category'
            ])
            ->add('make', TextType::class)
            ->add('model', TextareaType::class)
            ->add('width', NumberType::class,
                ['invalid_message'=>'You must enter a valid number!'])
            ->add('height', NumberType::class,
                ['invalid_message'=>'You must enter a valid number!'])
            ->add('diameter', NumberType::class,
                ['invalid_message'=>'You must enter a valid number!'])
            ->add('price',NumberType::class,
                ['invalid_message'=>'You must enter a valid number!'])
            ->add('quantity', NumberType::class,
                ['invalid_message'=>'You must enter a valid number!'])
            ->add('speedIndex', TextType::class)
            ->add('loadIndex', NumberType::class,
                ['invalid_message'=>'You must enter a valid number!'])
            ->add('image', FileType::class,
                ['data' => null])
            ->add('add', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tyre'
        ));
    }
}
