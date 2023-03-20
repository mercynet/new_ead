<?php

namespace App\Enums\Lessons;

use App\Enums\ToArray;

enum VideoType
{
    use ToArray;

    case youtube;
    case vimeo;
    case internal_player;
    case aws_s3;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::youtube => trans('lessons.enums.video.types.youtube'),
            self::vimeo => trans('lessons.enums.video.types.vimeo'),
            self::aws_s3 => trans('lessons.enums.video.types.aws_s3'),
            default => trans('lessons.enums.video.types.internal_player')
        };
    }
}
