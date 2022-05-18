<?php

namespace App\Form;

use App\Entity\WorkCertificate;
use App\Entity\Worker;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkCertificateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('worker', EntityType::class, [
                // looks for choices from this entity
                'class' => Worker::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => fn (Worker $worker)=>  $worker->getRef().'-('.$worker->getNom() .'_'. $worker->getPrenom().')',
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkCertificate::class,
        ]);
    }
}
