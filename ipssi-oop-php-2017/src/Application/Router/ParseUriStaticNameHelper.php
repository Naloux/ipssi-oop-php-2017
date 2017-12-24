<?php

declare(strict_types=1);

namespace Application\Router;

use Application\Controller\IndexController;
use Application\Controller\LecturerController;

use Cinema\Controller\FilmController;
use Cinema\Controller\ShowFilmController;

use Conferences\Controller\MeetingController;
use Conferences\Controller\ShowMeetingController;

use Conferences\Controller\CommingMeetingController;
use Conferences\Controller\ShowCommingMeetingController;

use Conferences\Controller\SubscribeController;
use Conferences\Controller\ShowSubscribeController;

use Conferences\Controller\AddMeetingController;
use Conferences\Controller\ShowAddMeetingController;

use Conferences\Controller\DeleteController;
use Conferences\Controller\ShowDeleteController;

use Exception;

use function explode;
use function preg_match;
use function substr;
use function urldecode;

final class ParseUriStaticNameHelper implements ParseUriHelper
{
    /**
     * @param string $requestUri
     * @return string
     * @throws Exception
     */
    public function parseUri(string $requestUri): string
    {
        $requestUri = substr($requestUri, 19);
        if ($requestUri === '/') {
            $requestUri = substr($requestUri, 1);
        }
        if ($requestUri === '/film') {
            return FilmController::class;
        }

        if (preg_match('#/film/.*#', $requestUri)) {
            $requestUriParams = explode('/', $requestUri);
            $_GET['name'] = urldecode($requestUriParams[2]);
            return ShowFilmController::class;
        }

        if (preg_match('#/lecturer/.*#', $requestUri)) {
            $requestUriParams = explode('/', $requestUri);
            $_GET['lecturer'] = urldecode($requestUriParams[2]);
            return LecturerController::class;
        }

        if ($requestUri === '/meeting') {
            return MeetingController::class;
        }
        if (preg_match('#/meeting/.*#', $requestUri)) 
        {
            $requestUriParams = explode('/', $requestUri);
            $_GET['title'] = urldecode($requestUriParams[2]);
            return ShowMeetingController::class;
        }

        if ($requestUri === '/commingMeeting') {
            return CommingMeetingController::class;
        }
        if (preg_match('#/commingMeeting/.*#', $requestUri)) 
        {
            $requestUriParams = explode('/', $requestUri);
            $_GET['title'] = urldecode($requestUriParams[2]);
            return ShowCommingMeetingController::class;
        }

        if ($requestUri === '/subscribe') {
            return SubscribeController::class;
        }
        if (preg_match('#/subscribe/.*#', $requestUri)) 
        {
            $requestUriParams = explode('/', $requestUri);
            $_GET['user_id'] = urldecode($requestUriParams[2]);
            return ShowSubscribeController::class;
        }

        if ($requestUri === '/add-meeting') {
            return AddMeetingController::class;
        }
        if (preg_match('#/add-meeting/.*#', $requestUri)) 
        {
            $requestUriParams = explode('/', $requestUri);
            $_GET['id'] = urldecode($requestUriParams[2]);
            return ShowAddMeetingController::class;
        }

        if ($requestUri === '/delete') {
            return DeleteController::class;
        }
        if (preg_match('#/delete/.*#', $requestUri)) 
        {
            $requestUriParams = explode('/', $requestUri);
            $_GET['title'] = urldecode($requestUriParams[2]);
            return ShowDeleteController::class;
        }


        return IndexController::class;
    }
}

