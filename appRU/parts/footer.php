<?php
/**
 * Created by PhpStorm.
 * User: GSalmela
 * Date: 2018-10-02
 * Time: 12:02 PM
 */


$thisPage = str_ireplace(array('-', '.php'), array(' ', ''), basename($_SERVER['PHP_SELF']) );


echo '


<div class="footerBar">
        <ul>
            <li class="'.($thisPage == 'programs' ? 'active' : '').'">
                <a href="programs.php?user='.$user.'">';
                if($thisPage=='programs'){
                    echo '<img style="width: 36px;margin: 0 auto;" src="../../assets/images/App/foot-sun.png" alt="" srcset="">';
                }else{
                    echo '<img style="width: 36px;margin: 0 auto;" src="../../assets/images/App/foot-grey.png" alt="" srcset="">';
                }
                echo '
                    <p>Programs</p>
                </a>
            </li>
            <li class="'.($thisPage == 'contact instructor' ? 'active' : '').'">
                <a href="contact-instructor.php?user='.$user.'&instructor=1&page='.$page.'">
                    <i class="fas fa-question"></i>
                    <p>Ask question</p>
                </a>
            </li>
            <li class="'.($thisPage == 'events' ? 'active' : '').'">
                <a href="events.php?user='.$user.'">
                    <i class="far fa-calendar-alt"></i>
                    <p>My events</p>
                </a>
            </li>
            <li class="'.($thisPage == 'user' ? 'active' : '').'">
                <a href="user.php?user='.$user.'">
                    <i class="fas fa-user"></i>
                    <p>My profile</p>
                </a>
            </li>
        </ul>
    </div>';




?>