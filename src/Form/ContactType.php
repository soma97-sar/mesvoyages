<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Description of ContactType
 *
 * @author BEN BAHA
 */
class ContactType  extends AbstractType{
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('email',TextType::class)
            ->add('message',TextareaType::class)    
            ->add('submit', SubmitType::class, [
                'label'=>'Envoyer'
            ])
        ;        
    }       
    public function confingureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=> Contact::class,
        ]);
    }
}

