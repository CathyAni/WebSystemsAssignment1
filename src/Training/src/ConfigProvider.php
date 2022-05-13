<?php

declare(strict_types=1);

namespace Training;

use Mezzio\Application;
use Training\Handler\GetAllTrainingHandler;
use Training\Handler\GetAllTrainingHandlerFactory;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Training\Handler\ActivateCourseCountHandler;
use Training\Handler\ActivateCourseCountHandlerFactory;
use Training\Handler\CountTotalTrainingHandler;
use Training\Handler\CountTotalTrainingHandlerFactory;
use Training\Handler\GetProgrammesHandler;
use Training\Handler\GetProgrammesHandlerFactory;
use Training\Handler\RoomCourseActivityHandler;
use Training\Handler\RoomCourseActivityHandlerFactory;
use Training\Handler\SubmitAssignmentStatusHandler;
use Training\Handler\SubmitAssignmentStatusHandlerFactory;
use Training\Handler\TakenCoursesHandler;
use Training\Handler\TakenCoursesHandlerFactory;
use Training\Handler\TrainingAllHandler;
use Training\Handler\TrainingAllHandlerFactory;
use Training\Handler\TrainingRewardHandler;
use Training\Handler\TrainingRewardHandlerFactory;
use Training\Handler\TrainingViewHandler;
use Training\Handler\TrainingViewHandlerFactory;
use Training\Handler\UserTrainingHandler;
use Training\Handler\UserTrainingHandlerFactory;
use Training\Handler\ViewMilestoneResourceHandler;
use Training\Handler\ViewMilestoneResourceHandlerFactory;
use Training\Service\ClassRoomService;
use Training\Service\ClassRoomServiceFactory;
use Training\Service\TrainingService;
use Training\Service\TrainingServiceFactory;
use Training\Service\YoutubeApiService;
use Training\Service\YoutubeApiServiceFactory;

/**
 * The configuration provider for the Training module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            "doctrine"=>$this->getDoctrineEntities(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            "delegators"=>[
                Application::class=>[
                    RouteDelegator::class
                ]
            ],
            'invokables' => [
            ],
            'factories'  => [
                GetAllTrainingHandler::class=>GetAllTrainingHandlerFactory::class,
                TakenCoursesHandler::class=>TakenCoursesHandlerFactory::class,
                RoomCourseActivityHandler::class=>RoomCourseActivityHandlerFactory::class,
                GetProgrammesHandler::class=>GetProgrammesHandlerFactory::class,
                ActivateCourseCountHandler::class=>ActivateCourseCountHandlerFactory::class,
                TrainingRewardHandler::class=>TrainingRewardHandlerFactory::class,
                SubmitAssignmentStatusHandler::class=>SubmitAssignmentStatusHandlerFactory::class,
                TrainingAllHandler::class=>TrainingAllHandlerFactory::class,
                TrainingViewHandler::class=>TrainingViewHandlerFactory::class,
                TrainingRewardHandler::class=>TrainingRewardHandlerFactory::class,

                // Count 
                CountTotalTrainingHandler::class=>CountTotalTrainingHandlerFactory::class,

                UserTrainingHandler::class=>UserTrainingHandlerFactory::class,
                ViewMilestoneResourceHandler::class=>ViewMilestoneResourceHandlerFactory::class, 

                // Service 
                ClassRoomService::class=>ClassRoomServiceFactory::class,
                YoutubeApiService::class=>YoutubeApiServiceFactory::class,
                TrainingService::class=>TrainingServiceFactory::class,
            ],
        ];
    }

    public function getDoctrineEntities() : array
    {
        return [
            'driver' => [
                'orm_default' => [
                    'class' => MappingDriverChain::class,
                    'drivers' => [
                        'Training\Entity' => 'training_entity',
                    ],
                ],
                'training_entity' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => [__DIR__ . '/Entity'],
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'training'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
