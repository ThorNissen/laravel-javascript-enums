<?php

namespace Psydoc\LaravelJavascriptEnums\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelJavascriptEnumsProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-javascript-enums.php' => config_path('laravel-javascript-enums.php'),
        ], 'laravel-javascript-enums-config');
        
        $this->registerEnumViewDirective();
    }

    private function registerEnumViewDirective()
    {
        Blade::directive('enums', function () {
            $enums = $this->getEnums();

            $formattedEnums = [];

            foreach ($enums as $enum) {
                $explodedClassPath = explode('\\', $enum);

                $enum = config('laravel-javascript-enums.class_prefix').$enum;
                
                if (config('laravel-javascript-enums.is_ben_sampo')) {
                    $formattedEnums[end($explodedClassPath)] = $enum::asArray();
                } else {
                    $formattedEnums[end($explodedClassPath)] = $this->formatCases($enum::cases());
                }
            }

            $formattedEnums = json_encode($formattedEnums);
            
            return "<script>window.enums = $formattedEnums;</script>";
        });
    }

    private function formatCases($cases) 
    {
        $enum = [];
        foreach ($cases as $case) {
            $enum[$case->name] = $case->value;
        }
        
        return $enum;
    }

    private function getEnums() {
        $out = [];
        $path = config('laravel-javascript-enums.path');
        $excluded = $this->getExcluded();
        
        if (!is_dir($path)) {
            return [];
        }

        $results = scandir($path);

        foreach ($results as $result) {
            if ($result === '.' || $result === '..' || in_array($result, $excluded)) {
                continue;
            }

            $filename = $result;

            if (is_dir($filename)) {
                $out = array_merge($out, $this->getEnums($filename));
            } else {
                $out[] = substr($filename, 0, -4);
            }
        }

        return $out;
    }

    private function getExcluded()
    {
        $excluded = config('laravel-javascript-enums.excluded');
        
        $formattedExcluded = [];
        foreach ($excluded as $exclude) {
            $exploded = explode('\\', $exclude);
            $formattedExcluded[] = end($exploded) . '.php';
        }

        return $formattedExcluded;
    }
}
