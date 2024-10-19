<?php

namespace App\Strategies\Courses\Lessons\Display\Types\Video;

use App\Models\Courses\Lesson;

class YouTubeVideoLessonDisplayStrategy implements VideoLessonDisplayStrategy
{
    public function render(Lesson $lesson): string
    {
        // Implement YouTube video rendering logic
        return view('lessons.video.youtube', ['lesson' => $lesson])->render();
    }
}
