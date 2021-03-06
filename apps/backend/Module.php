<?php
namespace App\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Events\Manager as EventsManager;
use App\Backend\Tags\MyTags;
use App\Backend\Plugins\SecurityPlugin;
use App\Backend\Plugins\NotFoundPlugin;

class Module
{

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {
        $loader = new Loader();
        
        $loader->registerNamespaces(array(
            'App\Backend\Controllers' => __DIR__ . '/controllers/',
            'App\Backend\Tags' => __DIR__ . '/tags/',
            'App\Backend\Plugins' => __DIR__ . '/plugins/'
        ));
        
        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di            
     */
    public function registerServices($di)
    {
        /**
         * Read configuration
         */
        $config = include __DIR__ . "/config/config.php";
        
        // Registering a dispatcher
        $di->set('dispatcher', function ()
        {
            $eventsManager = new EventsManager();
            
            /**
             * Check if the user is allowed to access certain action using the SecurityPlugin
             */
            $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin());
            
            /**
             * Handle exceptions and not-found exceptions using NotFoundPlugin
             */
            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin());
            
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("App\Backend\Controllers");
            // $dispatcher->setModuleName($moduleName)
            $dispatcher->setEventsManager($eventsManager);
            
            return $dispatcher;
        });
        
        $di['myTag'] = function ()
        {
            return new MyTags();
        };
        
        /**
         * Setting up the view component
         */
        $di['view'] = function ()
        {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');
            $view->registerEngines(array(
                // ".volt" => 'volt'
                ".phtml" => 'volt'
            ));
            return $view;
        };
        
        /**
         * Setting up volt
         */
        $di->set('volt', function ($view, $di)
        {
            
            $volt = new VoltEngine($view, $di);
            
            $volt->setOptions(array(
                "compiledPath" => APP_PATH . "cache/volt/"
            ));
            
            $compiler = $volt->getCompiler();
            $compiler->addFunction('is_a', 'is_a');
            
            return $volt;
        }, true);        
    }
}
