<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
              'label' =>'Titre'
            ])
            ->add('description',TextareaType::class)
            ->add('surface')
            ->add('rooms', null, [
              'label'=>'Pieces'
            ])
            ->add('bedrooms', null, [
              'label' =>'chambres'
            ])
            ->add('floor', null, [
             'label' => 'Etages'
            ])
            ->add('price', null, [
             'label' => 'Prix'
            ])
            ->add('heat',ChoiceType::class,[
            'choices' =>$this->getChoices()
            ])
            ->add('options', EntityType::class,[
              'class'=> Option::class,
              'required'=> false,
              'choice_label'=> 'name',
              'multiple' => true
            ])
            ->add('imageFile', FileType::class,[
              'required'=> false
            ])
            ->add('city', null, [
              'label'=> 'Ville'
            ])
            ->add('adress', null, [
              'label' => 'Adresse'
            ])
            ->add('postal_code', null, [
              'label' =>'Code Postal'
            ])
            ->add('sold',null, [
              'label'=> 'Vendu'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
    private function getChoices()
         {
           $choices= Property::HEAT;
           $output= [];
           foreach($choices as $key=>$v)
           {
            $output[$v]=$key;
           }
           return $output;
         }
}
