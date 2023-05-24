<?php

use Illuminate\Support\Facades\File;

// App\Helpers\helpers.php

/**
 * Returns the translations array.
 * These locales will be sent to Vue via the Inertia's share method.
 * @param $locale string - The locale whose translations you want to find
 * @return array
 */
function translations(string $locale): array
{
    $translationFiles = File::files(base_path("resources/lang/${locale}"));

    return collect($translationFiles)
        ->map(fn($file) => [$file->getFilenameWithoutExtension() => require($file)])
        ->collapse()
        ->toArray();
}

if (!function_exists('justNumbers')) {
    function justNumbers(string $string): int
    {
        return preg_replace("/[^a-zA-Z0-9\s]/", "", $string);
    }
}

if (!function_exists('guardNames')) {
    /**
     * @return array
     */
    function guardNames(): array
    {
        $guardNames = array_keys(config('auth.guards'));
        array_pop($guardNames);
        return $guardNames;
    }
}

if (!function_exists('getGuardName')) {
    /**
     * @return string|null
     */
    function getGuardName(): string|null
    {
        return Auth::guard('web')->check() ? 'web' : 'sanctum';
    }
}

