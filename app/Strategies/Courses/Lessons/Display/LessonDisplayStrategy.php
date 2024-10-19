<?php

namespace App\Strategies\Lessons\Display;

use App\Models\Courses\Lesson;

interface LessonDisplayStrategy
{
    public function render(Lesson $lesson): string;
}
