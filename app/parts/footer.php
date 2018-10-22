<?php
/**
 * Created by PhpStorm.
 * User: GSalmela
 * Date: 2018-10-02
 * Time: 12:02 PM
 */

$page = str_ireplace(array('-', '.php'), array(' ', ''), basename($_SERVER['PHP_SELF']) );
echo <<<FOOTER

<a href="programs.php?user=$user">programs</a>
<a href="contact-instructor.php?user=$user&instructor=1&page=$page">ask question</a>
<a href="events.php?user=$user">my events</a>
<a href="user.php?user=$user">my profile</a>
FOOTER;


?>