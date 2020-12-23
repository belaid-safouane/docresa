<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdminType extends AbstractType
{
    private function getconfiguration($label,$placeholder,$options = [] ){
        return array_merge ([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
   }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname',TextType::class ,['label' => 'Prénom','attr' => ['class' => 'validate']], $this->getconfiguration('Prénom','entrer votre Prénom') )
        ->add('lastname',TextType::class ,['label' => 'Nom','attr' => ['class' => 'validate']], $this->getconfiguration('Nom','entrer votre nom'))
        ->add('email',TextType::class ,['label' => 'Email','attr' => ['class' => 'validate']], $this->getconfiguration('Email','entrer votre email'))
        ->add('hash',PasswordType::class ,['label' => 'Password','attr' => ['class' => 'validate']], $this->getconfiguration('Mot de passe','entrer votre password'))
        ->add('passwordConfirm',PasswordType::class ,['label' => 'Confirmer mot de passe','attr' => ['class' => 'validate']], $this->getconfiguration('confirmation du mot de passe','veuillez confirmer votre mot de passe'))
        ->add('telephone',TextType::class ,['label' => 'Téléphone','attr' => ['class' => 'validate']], $this->getconfiguration('Numéro de téléphone','entrer votre Numéro de téléphone'))            
        ->add('imageFile',FileType::class, [
            'label' => false,
            'attr' => ['class' => 'upload']
        ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}