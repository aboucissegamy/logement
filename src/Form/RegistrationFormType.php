<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'attr'=> [
                    'class'=>'form-control'
                ],
                'label'=>'E-mail'


            ])
            ->add('lastname', TextType::class,[
                'attr'=> [
                    'class'=>'form-control'
                ],
                'label'=>'Nom'

            ])
            ->add('firstname',TextType::class,[
                'attr'=> [
                    'class'=>'form-control'
                ],
                'label'=>'Prenom'

            ])
            ->add('address',TextType::class,[
                'attr'=> [
                    'class'=>'form-control'
                ],
                'label'=>'adresse'

            ])
            ->add('zipcode',TextType::class,[
                'attr'=> [
                    'class'=>'form-control'
                ],
                'label'=>'Code-postal'

            ])
            ->add('city',TextType::class,[
                'attr'=> [
                    'class'=>'form-control'
                ],
                'label'=>'Ville'

            ])
            ->add('rgpdconsent', CheckboxType::class, [ //RGPDConsent si le user est d'accord que ses informations soit gardées
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label'=>'j\'accepte que mes informations soient enregistrées en m\'inscrivant sur ce site '
            ])
            ->add('plainPassword', PasswordType::class, [
                // au lieu d'être placé directement sur l'objet,
                // ceci est lu et encodé dans le contrôleur
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                            'class'=>'form-control'
            ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label'=>'Mot de Passe'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
