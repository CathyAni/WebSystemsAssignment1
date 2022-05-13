<?php

declare(strict_types=1);

namespace Training;

use Psr\Container\ContainerInterface;
use Training\Handler\ActivateCourseCountHandler;
use Training\Handler\AggregateRewardHandler;
use Training\Handler\CountInProgressTrainingHandler;
use Training\Handler\CountTotalCourseHandler;
use Training\Handler\CountTotalProgramemHandler;
use Training\Handler\CountTotalTrainingHandler;
use Training\Handler\GetAllTrainingHandler;
use Training\Handler\GetProgrammesHandler;
use Training\Handler\RoomHandler;
use Training\Handler\SubmitAssignmentStatusHandler;
use Training\Handler\TakenCoursesHandler;
use Training\Handler\TrainingAllHandler;
use Training\Handler\TrainingIndexHandler;
use Training\Handler\TrainingRewardHandler;
use Training\Handler\TrainingViewHandler;

class RouteDelegator
{

    public function __invoke(ContainerInterface $container, $servicename, callable $callback)
    {
        $app = $callback();
        // $app->route("/training[/action[/{id:\d+}]]", [GetAllTrainingHandler::class], ["GET"], "training.all");
        $app->route("/", [TrainingAllHandler::class], ["GET"], "home");
        $app->route("/training/all", [TrainingAllHandler::class], ["GET"], "training.all");
        $app->route("/training/index", [TrainingIndexHandler::class], ["GET"], "training.index");
        $app->route("/training/view[/{id}]", [TrainingViewHandler::class], ["GET"], "training.view");
        
        
        
        // $app->route("/training/view/[:trainingUid]", [], "");
        // $app->route();

        $app->route("/classroom/{trainingUid}[/action[/{id:\d+}]]", [RoomHandler::class], ["GET"], "training.room");
        $app->route("/classroom/{trainingUid}/getprogrammes", [GetProgrammesHandler::class], ["GET"], "training.get-programmes");
        $app->route("/classroom/{trainingUid}/activate-course-count", [ActivateCourseCountHandler::class], ["GET"], "training.activate-course-count");
        $app->route("/classroom/{trainingUid}/training-reward", [TrainingRewardHandler::class], ["GET"], "training.reward");
        $app->route("/classroom/{trainingUid}/taken-courses", [TakenCoursesHandler::class], ["GET"], "training.taken-courses");
        $app->route("/classroom/{trainingUid}/submitassignmentstatus", [SubmitAssignmentStatusHandler::class], ["GET"], "training.submitassignmentstatus");


        // $app->route("/trainingjson[/action[/{id:\d+}][/page/{page:\d+}]]");
        $app->route("/trainingjson/count-total-training", [CountTotalTrainingHandler::class], ["GET"], "training.count-total-training");
        $app->route("/trainingjson/count-total-course", [CountTotalCourseHandler::class], ["GET"], "training.count-total-course");
        $app->route("/trainingjson/count-total-programmes", [CountTotalProgramemHandler::class], ["GET"], "training.count-total-programmes");
        $app->route("/trainingjson/count-in-progress", [CountInProgressTrainingHandler::class], ["GET"], "training.count-totla-training");
        $app->route("/trainingjson/aggregatereward", [AggregateRewardHandler::class], ["GET"], "training.aggregate-reward");
        // $app->route("/trainingjson/aggregatereward", [AggregateRewardHandler::class], ["GET"], "training.aggregate-reward");
        // https://app.tanimfits.com.ng/trainingjson/aggregatereward



        return $app;
    }
}
