<?php

namespace App\Form;

use App\Entity\Banda;
use App\Entity\Mensaje;
use App\Entity\Modo;
use App\Entity\User;
use App\Repository\MensajeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MensajeType extends AbstractType
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fechaHora', DateTimeType::class, [
                'label' => 'Fecha y hora:'
            ])
            ->add('banda_id', EntityType::class, [
                'class' => Banda::class,
                'choice_label' => 'distancia',
                'label' => 'Banda:'
            ])
            ->add('modo_id', EntityType::class, [
                'class' => Modo::class,
                'choice_label' => 'nombre',
                'label' => 'Modo:'
            ])
            ->add('id_user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'choices' => $this->userRepository->findByExampleField(),
                'label' => 'Usuario:'
            ])
            ->add('Registrarse', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mensaje::class,
        ]);
    }
}
