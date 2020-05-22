<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Type;

class DiscountCodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberOfCodes', IntegerType::class, [
                'required' => true
            ])
            ->add('lengthOfCode', IntegerType::class, [
                'required' => true
            ])
            ->add('generate', SubmitType::class, [
                'label' => 'Generate codes'
            ]);
    }
}
