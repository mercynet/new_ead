<?php

namespace App\Strategies\Lessons\Display;

use App\Strategies\Courses\Lessons\Display\Types\Text\TextLessonDisplayStrategy;
use App\Strategies\Courses\Lessons\Display\Types\Video\VimeoVideoLessonDisplayStrategy;
use App\Strategies\Courses\Lessons\Display\Types\Video\YouTubeVideoLessonDisplayStrategy;
use App\Strategies\Lessons\Display\LessonDisplayStrategy;

class LessonDisplayStrategyFactory
{
    public static function make(string $type): LessonDisplayStrategy
    {
        return match ($type) {
            'text' => new TextLessonDisplayStrategy(),
            'video_youtube' => new YouTubeVideoLessonDisplayStrategy(),
            'video_vimeo' => new VimeoVideoLessonDisplayStrategy(),
            default => throw new \InvalidArgumentException("Invalid lesson type"),
        };
    }
}
