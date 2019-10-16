<?php

namespace App\Form;

use App\Entity\User;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Oh\GoogleMapFormTypeBundle\Form\Type\GoogleMapType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends BaseRegistrationFormType
{

    public function __construct($class)
    {
        parent::__construct(User::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('email', EmailType::class, ['label' => false, 'translation_domain' => 'FOSUserBundle', 'attr' => ['placeholder' => 'form.email'],])
            ->add('username', null, array('label' => false, 'translation_domain' => 'FOSUserBundle', 'attr' => ['placeholder' => 'form.username'],))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'label' => 'form.passwor',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => false, 'attr' => ['placeholder' => 'form.password'],),
                'second_options' => array('label' => false, 'attr' => ['placeholder' => 'form.password_confirmation'],),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('location', LocationType::class,[
                'label' => false,
            ])
        ;
    }
}
