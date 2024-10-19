<?php

namespace App\Providers\Mzrt;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class MzrtServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $providerPath = app_path('Providers/Mzrt/Modules');
        $directories = File::directories($providerPath);

        foreach ($directories as $directory) {
            $providerFiles = File::files($directory);

            foreach ($providerFiles as $file) {
                $className = $this->getClassNameFromFile($file);
                if ($className) {
                    $this->app->register($className);
                }
            }
        }
    }

    private function getClassNameFromFile($file): ?string
    {
        $namespace = 'App\\Providers\\Mzrt\\Modules\\' . basename(dirname($file)) . '\\';
        $className = $namespace . pathinfo($file, PATHINFO_FILENAME);

        if (class_exists($className)) {
            return $className;
        }

        return null;
    }

    public function boot(): void
    {
        //
    }
}
