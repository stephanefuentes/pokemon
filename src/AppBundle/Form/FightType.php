<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use AppBundle\Entity\Fight;
use AppBundle\Entity\Pokemon;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FightType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pokemon1', EntityType::class, [
                'class' => Pokemon::class,
                'multiple' => false,
                'expanded' => true,
                // utilise une fonction pour que le label soit composé du nom du pokemon
                'choice_label' =>  function ($pokemon) {
                    return $pokemon->getName();
                },
                'label' => 'Votre Pokemon'
        ])
        ->add('pokemon2', EntityType::class, [
                'class' => Pokemon::class,
                'multiple' => false,
                'required' => false,
                'placeholder' => 'Au hasard',
                'expanded' => true,
                // utilise une fonction pour que le label soit composé du nom du pokemon
                'choice_label' =>  function ($pokemon) {
                    return $pokemon->getName();
                },
                'label' => 'Pokemon de votre rival'
        ])
        ->add('submit', SubmitType::class, array('label' => 'Démarrer combat'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Fight'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pokemon';
    }



}
