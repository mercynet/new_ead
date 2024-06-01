<?php

namespace App\Rules;

use App\Exceptions\FileException;
use Closure;
use Exception;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use InvalidArgumentException;

class Base64FileRule implements DataAwareRule, ValidationRule
{
    protected array $data = [];

    protected array $allowedMimeTypes = [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/x-icon',
        'image/svg',
        'image/webp',
        'application/pdf',
        'text/plain',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.ms-excel',
        'application/vnd.oasis.opendocument.text',
        'application/xml',
        'text/csv',
        'application/zip',
        'application/x-rar-compressed',
        'video/mpeg',
        'video/mp4',
        'video/x-flv',
        'application/x-mpegURL',
        'video/MP2T',
        'video/3gpp',
        'video/quicktime',
        'video/x-msvideo',
        'video/x-ms-wmv',
        'video/webm',
        'video/avi',
        'application/octet-stream',
    ];

    public function __construct(private readonly int $filesize = 16, ?array $allowedMimeTypes = null)
    {
        $this->allowedMimeTypes ??= $allowedMimeTypes;
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     *
     * @throws Exception
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $file = finfo_open();
        $dataFile = $this->fileIndex($this->data);
        $mimeType = finfo_buffer($file, base64_decode($this->data[$dataFile]), FILEINFO_MIME_TYPE);
        if (empty($mimeType) || ! in_array($mimeType, $this->allowedMimeTypes)) {
            $fail(FileException::invalidMimetype()->getMessage());
        }
        $file = convertBase64File2File($this->data[$dataFile]);
        if (filesize($file) > $this->filesize * 1024 * 1024) {
            $fail(FileException::invalidFilesize()->getMessage());
        }
    }

    /**
     * Returns the corresponding index value based on the provided file type.
     *
     * @return string The corresponding index value.
     *
     * @throws Exception
     */
    public function fileIndex(array $data): string
    {
        $fileTypes = ['file' => 'file', 'avatar' => 'avatar', 'image' => 'image'];
        foreach ($fileTypes as $key => $value) {
            if (! empty($data[$key])) {
                return $value;
            }
        }

        throw new InvalidArgumentException('Invalid file type');
    }

    /**
     * Set the data for the rule.
     *
     * @param  array  $data The data to be set for the rule.
     * @return Base64FileRule|static The instance of the class after setting the data.
     */
    public function setData(array $data): Base64FileRule|static
    {
        $this->data = $data;

        return $this;
    }
}
