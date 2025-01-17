<?php

namespace App\Form;

use App\Entity\Combat;
use App\Entity\Pokemon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CombatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pokemon1', EntityType::class, [
                'class' => Pokemon::class,
                'choice_label' => 'nom',
                'label' => 'Choisissez votre Pokémon',
                'attr' => ['class'=>"py-3 px-4 block w-full border-gray-200 rounded-lg text-sm 
                focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 
                disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 
                dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"],
                'label_attr'=> [
                    'class' => 'block text-sm mb-2 dark:text-white']
            ])
            ->add('fight',SubmitType::class,[
                'attr' => ['class' => "w-full py-3 px-4 inline-flex justify-center items-center 
                gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 
                text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 
                disabled:pointer-events-none"]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Combat::class,
        ]);
    }
}
