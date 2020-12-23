<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
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
            ->add('firstname',TextType::class , $this->getconfiguration('Prénom','entrer votre Prénom') )
            ->add('lastname',TextType::class , $this->getconfiguration('Nom','entrer votre nom'))
            ->add('email',TextType::class , $this->getconfiguration('Email','entrer votre email'))
            ->add('hash',PasswordType::class , $this->getconfiguration('Mot de passe','entrer votre password'))
            ->add('passwordConfirm',PasswordType::class , $this->getconfiguration('confirmation du mot de passe','veuillez confirmer votre mot de passe'))
            ->add('introduction',TextType::class , $this->getconfiguration('Code postal cabinet','entrer votre Code postal cabinet'))
            ->add('telephone',TextType::class , $this->getconfiguration('Numéro de téléphone','entrer votre Numéro de téléphone'))            
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'title',
                'label' => 'Spécialité',
                'attr' => ['class' => 'chosen-select']
            ])
            ->add('imageFile',FileType::class, [
                'label' => false,
                'attr' => ['class' => 'upload']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
