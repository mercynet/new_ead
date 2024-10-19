<?php

namespace App\Strategies\Courses\Lessons\Display\Types\Text;

use App\Models\Courses\Lesson;
use App\Strategies\Lessons\Display\LessonDisplayStrategy;

class TextLessonDisplayStrategy implements LessonDisplayStrategy
{
    public function render(Lesson $lesson): string
    {
        return view('lessons.text', ['lesson' => $lesson])->render();
    }
}
