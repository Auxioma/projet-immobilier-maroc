<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Agencies;
use App\Form\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AgenciesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('address', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('city', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('postalCode', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('country', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('agencyType')
            ->add('phoneNumber', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('users', RegistrationFormType::class, [
                'label' => false,
                'data_class' => User::class,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agencies::class,
        ]);
    }
}
