<?php

namespace P4\MuseumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use P4\MuseumBundle\Form\TicketownerType;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         ->add('price', IntegerType::class)
         ->add('validitydate', DateType::class, array(
                 'widget' => 'single_text',
                 'years' => range(date('Y'), date('Y')+1),
                 'months' => range(date('m'), 12),
                 'days' => range(date('d'), 31),
               ))
         ->add('type', ChoiceType::class, array('choices' => array('Demi-journée' =>'Demi-journée',
                                                                   'Journée entière' => 'Journée entière')))
         ->add('ticketowner', TicketownerType::class)
         ->add('reduction', CheckboxType::class, array ('required' => false));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'P4\MuseumBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'p4_museumbundle_ticket';
    }


}