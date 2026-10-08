<?php

namespace Wexample\SymfonyMediaDemo\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Wexample\SymfonyForms\Form\AbstractForm;
use Wexample\SymfonyForms\Form\Type\TextInputType;
use Wexample\SymfonyMediaDemo\Entity\DemoArticle;
use Wexample\SymfonyMediaDs\Form\MediaPickerType;

class DemoArticleForm extends AbstractForm
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => DemoArticle::class,
        ]);
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('title', TextInputType::class, [
                self::FIELD_OPTION_NAME_LABEL => true,
            ])
            ->add('cover', MediaPickerType::class, [
                self::FIELD_OPTION_NAME_LABEL => true,
                self::FIELD_OPTION_NAME_REQUIRED => false,
            ])
            ->add('attachments', MediaPickerType::class, [
                self::FIELD_OPTION_NAME_LABEL => true,
                self::FIELD_OPTION_NAME_REQUIRED => false,
                'multiple' => true,
            ]);

        $this->builderAddSubmit($builder);
    }
}
