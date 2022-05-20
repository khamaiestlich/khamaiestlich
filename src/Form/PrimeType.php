<?php

namespace App\Form;

use App\Entity\Prime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('PRBrute',null,[
                'label' => 'PR brut'
            ])
            ->add('note',null,[
                'label' => 'Note'
            ])
            ->add('PFA',null,[
                'label' => 'PFA'
            ])
            ->add('PM',null,[
                'label' => 'PM'
            ])
            ->add('APFA',null,[
                'label' => 'APFA'
            ])
            ->add('vex',null,[
                'label' => 'variable d\'expeloitation'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prime::class,
        ]);
    }
}
