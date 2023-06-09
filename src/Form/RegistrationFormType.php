<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('ville', ChoiceType::class, [
                'label' => 'Ville',
                'choices' => [
                    'Rabat' => 'Rabat',
                    'Salé' => 'Salé',
                    'Casablanca' => 'Casablanca',
                    'Méknès' => 'Méknès',
                    'Fés' => 'Fés',
                    'Tanger' => 'Tanger',
                    'Tétouan' => 'Tétouan',
                ],
                'placeholder' => 'Select a city', // optional
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'Autre' => 'Autre',
                ],
                'placeholder' => 'Select a gender', // optional
            ])
            ->add('phone')
            ->add('codeINPE')
            ->add('specialite', ChoiceType::class, [
                'label' => 'Spécialité',
                'choices' => [
                    'Addictologie' => 'Addictologie',
                    'Allergologie' => 'Allergologie',
                    'Anatomie et cytologie pathologiques' => 'Anatomie et cytologie pathologiques',
                    'Anatomopathologie' => 'Anatomopathologie',
                    'Anesthésie-réanimation' => 'Anesthésie-réanimation',
                    'Anesthésiologie' => 'Anesthésiologie',
                    'Biochimie médicale' => 'Biochimie médicale',
                    'Biologie médicale' => 'Biologie médicale',
                    'Cardiologie' => 'Cardiologie',
                    'Chirurgie cardiaque' => 'Chirurgie cardiaque',
                    'Chirurgie colorectale' => 'Chirurgie colorectale',
                    'Chirurgie du rachis' => 'Chirurgie du rachis',
                    'Chirurgie générale' => 'Chirurgie générale',
                    'Chirurgie générale oncologique' => 'Chirurgie générale oncologique',
                    'Chirurgie générale pédiatrique' => 'Chirurgie générale pédiatrique',
                    'Chirurgie maxillo-faciale' => 'Chirurgie maxillo-faciale',
                    'Chirurgie orl' => 'Chirurgie orl',
                    'Chirurgie orthopédique' => 'Chirurgie orthopédique',
                    'Chirurgie orthopédique et traumatologie' => 'Chirurgie orthopédique et traumatologie',
                ],
                'placeholder' => 'Select a specialty', // optional
            ])
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
