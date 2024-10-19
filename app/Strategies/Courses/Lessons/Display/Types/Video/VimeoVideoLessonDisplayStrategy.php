<?php

namespace App\Strategies\Courses\Lessons\Display\Types\Video;

use App\Models\Courses\Lesson;

class VimeoVideoLessonDisplayStrategy implements VideoLessonDisplayStrategy
{
    public function render(Lesson $lesson): string
    {
        // Implement Vimeo video rendering logic
        return view('lessons.video.vimeo', ['lesson' => $lesson])->render();
    }
}
