<?php

use App\Exceptions\InvalidUploadException;
use App\Models\Page;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\File;
use Illuminate\Http\File as HttpFile;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

// App\Helpers\helpers.php

/**
 * Returns the translations array.
 * These locales will be sent to Vue via the Inertia's share method.
 * @param $locale string - The locale whose translations you want to find
 * @return array
 */
function translations(string $locale): array
{
    $translationFiles = File::files(base_path("resources/lang/{$locale}"));

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
if (!function_exists('currentGuardName')) {
    /**
     * @return string|null
     */
    function currentGuardName(): string|null
    {
        return Auth::guard('web')->check() ? 'web' : 'api';
    }
}
if (!function_exists('saveImage')) {
    /**
     * @throws Exception
     */
    function saveImage(string|UploadedFile $file, string $disk = 'public', string $path = ''): string
    {
        if (is_object($file) && $file->getBasename() === null) {
            throw new Exception('Did not match data URI with image data');
        }

        [$fileName, $realFile] = is_string($file) ? setFilename($file, '', true) : setFilename($file->getClientOriginalName(), $file->getClientOriginalExtension());
        $storage = Storage::disk(($disk ?? 'public'));
        is_string($file) ? $storage->put($path . $fileName, $realFile) : $storage->putFileAs($path, $file, $fileName);
        ImageOptimizer::optimize(storage_path("app/public/{$disk}/{$fileName}"));
        return $fileName;
    }
}
if (!function_exists('ddcors')) {

    function ddcors(...$args): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dd(...$args);
    }
}
if (!function_exists('setFilename')) {
    /**
     * @throws Exception
     */
    function setFilename(string $filename, string $type, bool $isBase64 = false): array
    {
        if ($isBase64 === true) {
            if (!preg_match('/^data:image\/(\w+);base64,/', $filename, $type)) {
                throw new Exception('Did not match data URI with image data');
            }
            $type = strtolower($type[1]); // jpg, png, gif
            $filename = substr($filename, strpos($filename, ',') + 1);
            $filename = str_replace(' ', '+', $filename);
            $file = base64_decode($filename);
            if ($file === false) {
                throw new Exception('base64_decode failed');
            }

            return [Str::random() . 'app.' . $type, $file];
        }

        if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png', 'pdf', 'txt', 'doc', 'docx', 'xsl', 'xlsx'])) {
            throw new Exception('Invalid file type');
        }

        return [Str::random() . 'app.' . $type];
    }
}
if (!function_exists('prepareUpload')) {
    /**
     * @throws InvalidUploadException
     */
    function prepareUpload(string|UploadedFile $file, string $path, ?Model $model = null, string $folder = ''): string
    {
        if (!is_string($file) && (!($file instanceof UploadedFile) || empty($file?->getBasename()))) {
            throw new \InvalidArgumentException('Invalid image');
        }
        try {
            $relativePath = saveImage($file, $path, $folder);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw InvalidUploadException::onSave();
        }
        $newFile = str_replace('public/', '', $relativePath);
        if (isset($model) && !empty($model->image_path)) {
            $absolutePath = public_path($model->image_path);
            File::delete($absolutePath);
        }

        return str_replace('storage/', '', $newFile);
    }
}
if (!function_exists('sanitizeFileName')) {

    function sanitizeFileName(?string $filename): ?string
    {
        if (!$filename) {
            return null;
        }

        return str_replace(config('app.url') . '/storage/', '', $filename);
    }
}
if (!function_exists('getStorageImage')) {

    /**
     * @param $image
     * @return string
     */
    function getStorageImage($image): string
    {
        if (!empty($image) && !Str::contains($image, 'storage/blank.png')) {
            return asset("storage/{$image}");
        }

        return asset('storage/blank.png');
    }
}
if (!function_exists('generatePageRoutes')) {

    function generatePageRoutes(): SupportCollection
    {
        return !App::runningInConsole() && Schema::hasTable('pages') ? Cache::remember('pages', 60, function () {
            return Page::select('slug')->get()->pluck('slug');
        }) : collect();
    }
}
if (!function_exists('params')) {
    function params(array|string $name): Collection|string|null
    {
        $param = is_string($name) ? ParamService::getFirst(['name' => $name]) : ParamService::getAll(['name' => $name]);
        if ($param instanceof Collection) {
            $params = $param->pluckMany(['name', 'params']);

            return $params->map(function ($param) {
                $toArray = [];
                $toArray[$param['name']] = $param['params'][0]['countries'][0]['param']['value'];
                return $toArray;
            });
        }
        if (!$param || !$param?->param || !$param?->param?->value) {
            return null;
        }

        return $param->param->value;
    }
}
if (!function_exists('clearRecursive')) {

    function clearRecursive($recursive): mixed
    {
        foreach ($recursive as $index => $item) {
            if (is_array($item)) {
                $recursive[$index] = clearRecursive($item);
                if (count($recursive[$index]) == 0) {
                    unset($recursive[$index]);
                }
            } elseif (empty($item)) {
                unset($recursive[$index]);
            }
        }

        return $recursive;
    }
}
if (!function_exists('formatCurrency')) {

    function formatCurrency(float $currency, string $currencySymbol = '$', int $currencyDecimal = 2, string $currencyDecimalPoint = ',', string $currencyThousands = '.'): string
    {
        return "{$currencySymbol} " . number_format($currency, (int)$currencyDecimal, $currencyDecimalPoint, $currencyThousands);
    }
}
if (!function_exists('verifyDateDigits')) {

    function verifyDateDigits(string $date): string
    {
        return strlen($date) === 16 ? $date . ':00' : $date;
    }
}
if (!function_exists('authUser')) {
    function authUser(): ?User
    {
        return auth()->user() ?? null;
    }
}
if (!function_exists('isValidDate')) {
    function isValidDate($date): bool
    {
        $formats = ['Y-m-d', 'd/m/Y', 'm/d/Y', 'd-m-Y', 'm-d-Y'];

        foreach ($formats as $format) {
            $d = DateTime::createFromFormat($format, $date);
            if ($d && $d->format($format) == $date) {
                return true;
            }
        }

        return false;
    }
}
if (!function_exists('detectDateFormat')) {
    /**
     * @throws Throwable
     */
    function detectDateFormat(string $date): ?string
    {
        if (!isValidDate($date)) {
            throw new \InvalidArgumentException('Invalid date format');
        }

        // return the appropriate format
        if (str_contains($date, '-')) {
            return 'Y-m-d';
        }

        return 'd/m/Y';
    }
}
if (!function_exists('convertBase64File2File')) {
    function convertBase64File2File(string $file): UploadedFile
    {
        $tempFile = tmpfile();
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];
        file_put_contents($tempFilePath, base64_decode($file));
        $tempFileObject = new HttpFile($tempFilePath);
        $file = new UploadedFile(
            $tempFileObject->getPathname(),
            $tempFileObject->getFilename(),
            $tempFileObject->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );
        app()->terminating(function () use ($tempFile) {
            fclose($tempFile);
        });

        return $file;
    }
}
if (!function_exists('sanitizePhoneNumber')) {
    function sanitizePhoneNumber(string $phoneNumber): string
    {
        return preg_replace('/\D/', '', $phoneNumber);
    }
}
