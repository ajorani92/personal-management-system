<?php

namespace App\Form\Modules\Schedules;

use App\Controller\Utils\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Modules\Schedules\MyScheduleType;

class MyScheduleTypeType extends AbstractType {

    /**
     * @var Application
     */
    private $app;

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add('name', null, [
                'label' => $this->app->translator->translate('forms.MyScheduleTypeType.labels.name')
            ])
            ->add('submit', SubmitType::class,[
                'label' => $this->app->translator->translate('forms.general.submit')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => MyScheduleType::class,
        ]);
    }
}
