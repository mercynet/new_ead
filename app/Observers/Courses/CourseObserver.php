<?php

namespace App\Observers\Courses;

use App\Models\Course;

class CourseObserver
{
    public function created(Course $course): void
    {

    }

    public function updated(Course $course): void
    {
    }

    public function deleted(Course $course): void
    {
    }

    public function restored(Course $course): void
    {
    }

    public function forceDeleted(Course $course): void
    {
    }
}
