<?php

namespace Chronos\Base;

use Chronos\Utils\Inflector;

class App extends BaseObject
{
    public function import($type, $file)
    {
        $paths = [
            "Model" => [
                "folder" => "Models",
                "alias" => "_model"
            ],
            "Controller" => [
                "folder" => "Controllers",
                "alias" => "_controller"
            ]
        ];

        $nameFile = Inflector::camelize($file . $paths[$type]['alias']);
        $appConfig = $this->getConfig();
        $pathCore = $appConfig['CHRONOS_PATH']."/".$paths[$type]['folder']."/{$nameFile}.php";
        $pathApp = $appConfig['APP_PATH']."/".$paths[$type]['folder']."/{$nameFile}.php";

        pr($pathCore);
        pr($pathApp);

        $path = (file_exists($pathApp)) ? $pathApp : $pathCore;

        pr($path);

        $statusImport = false;
         if (file_exists($path)) {
            require_once $path;
            $statusImport = true;
         }

        return $path;
    }

    public function dispatchMethod($method, $params = [])
    {
        if (is_callable([$this, $method])) {
            return call_user_func_array([&$this, $method], $params);
        }
        $name = $this->name; //down($this->name);
        $this->redirect("http://localhost:8056/public/?url=error/missingMethod/{$name}/{$method}/");
    }

    public function redirect($url)
    {
        header('Location: '.$url);
    }
}
