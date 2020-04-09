<?php


namespace app\controllers;
use yii\web\Controller;

// NOTE: A shared controller that will be available for all other controllers
class AppController extends Controller
{
    // NOTE: setting SEO tags
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        /*
         * NOTE:
         * $this ->view - pass to the current view, from the controller method
         * where setMeta is called
         * */
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }
}

/*
NOTE:
registerMetaTag - set meta tags on a page
*/