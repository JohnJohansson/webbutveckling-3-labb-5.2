<?php
// a test file to see that the diffrent crud metodes worked
include("includes/config.php");

$s = new course();

$s->updateCourse(3, "fderf", "aaaa", "as", "sa");

echo "<pre>";
var_dump($s->getCourses());
echo "</pre>";