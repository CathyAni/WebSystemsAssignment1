<?php

declare(strict_types=1);

namespace Training\Service;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class CourseService 
{

    public static function generateCourseUid(){
        return uniqid(time());
    }
   
}
