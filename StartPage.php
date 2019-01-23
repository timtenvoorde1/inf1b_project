<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<!--
STARTPAGE WEBAPP
17-12-2018
-->
<html lang="nl">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Start Pagina</title>
    </head>
    <body>
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <a href="StartPage.php">
                        <img src="img/stenden.png" alt="NHL_STENDEN"> 
                    </a>
                </div>
                <div id="headertxt">
                    <div class="home">
                        <ul>
                            <li><a href="startpage.php">Home</a></li>
                        </ul>
                    </div>
                    <div class="login">
                        <ul>
                            <li><a href="logout.php" >Uitloggen</a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="StartPage.php">NL</a></li>
                            <li class=""><a href="en/StartPage_en.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
            </div> 
            <div id="middlebox">
                <div id="tilecontainer">
                    <div class="calender">
                        <?php
                        class Calendar {

                            /**
                             * * Constructor
                             * */
                            public function __construct() {
                                $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
                            }

                            /*                             * ******************* PROPERTY ******************* */

                            private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
                            private $currentYear = 0;
                            private $currentMonth = 0;
                            private $currentDay = 0;
                            private $currentDate = null;
                            private $daysInMonth = 0;
                            private $naviHref = null;

                            /*                             * ******************* PUBLIC ********************* */

                            /**
                             * * Print out the calendar
                             * */
                            public function show() {
                                $year = null;
                                $month = null;
                                if (null == $year && isset($_GET['year'])) {
                                    $year = htmlentities($_GET['year'], ENT_QUOTES);
                                } elseif (null == $year) {
                                    $year = date("Y", time());
                                }
                                if ((!is_numeric($year)) || ($year == "")) {
                                    $year = date("Y", time());
                                }
                                if (null == $month && isset($_GET['month'])) {
                                    $month = htmlentities($_GET['month'], ENT_QUOTES);
                                } elseif (null == $month) {
                                    $month = date("m", time());
                                }
                                if ((!is_numeric($month)) || ($month == "")) {
                                    $month = date("m", time());
                                }
                                $this->currentYear = $year;
                                $this->currentMonth = $month;
                                $this->daysInMonth = $this->_daysInMonth($month, $year);
                                $content = '<div id="calendar">' . "\r\n" . '<div class="calendar_box">' . "\r\n" . $this->_createNavi() . "\r\n" . '</div>' . "\r\n" . '<div class="calendar_content">' . "\r\n" . '<div class="calendar_label">' . "\r\n" . $this->_createLabels() . '</div>' . "\r\n";
                                $content .= '<div class="calendar_clear"></div>' . "\r\n";
                                $content .= '<div class="calendar_dates">' . "\r\n";
                                $weeksInMonth = $this->_weeksInMonth($month, $year);
                                // Create weeks in a month
                                for ($i = 0; $i < $weeksInMonth; $i++) {
                                    // Create days in a week
                                    for ($j = 1; $j <= 7; $j++) {
                                        $content .= $this->_showDay($i * 7 + $j);
                                    }
                                }
                                $content .= '</div>' . "\r\n";
                                $content .= '<div class="calendar_clear"></div>' . "\r\n";
                                $content .= '</div>' . "\r\n";
                                $content .= '</div>' . "\r\n";
                                return $content;
                            }

                            /*                             * ******************* PRIVATE ********************* */

                            /**
                             * * Create the calendar days
                             * */
                            private function _showDay($cellNumber) {
                                if ($this->currentDay == 0) {
                                    $firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));
                                    if (intval($cellNumber) == intval($firstDayOfTheWeek)) {
                                        $this->currentDay = 1;
                                    }
                                }
                                if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {
                                    $this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));
                                    $cellContent = $this->currentDay;
                                    $this->currentDay++;
                                } else {
                                    $this->currentDate = null;
                                    $cellContent = null;
                                }
                                $today_day = date("d");
                                $today_mon = date("m");
                                $today_yea = date("Y");
                                $class_day = ($cellContent == $today_day && $this->currentMonth == $today_mon && $this->currentYear == $today_yea ? "calendar_today" : "calendar_days");
                                return '<div class="' . $class_day . '">' . $cellContent . '</div>' . "\r\n";
                            }

                            /**
                             * * Create navigation
                             * */
                            private function _createNavi() {
                                $nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;
                                $nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;
                                $preMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;
                                $preYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;
                                return '<div class="calendar_header">' . "\r\n" . '<a class="calendar_prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&amp;year=' . $preYear . '">Prev</a>' . "\r\n" . '<span class="calendar_title">' . date('Y M', strtotime($this->currentYear . '-' . $this->currentMonth . '-1')) . '</span>' . "\r\n" . '<a class="calendar_next" href="' . $this->naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&amp;year=' . $nextYear . '">Next</a>' . "\r\n" . '</div>';
                            }

                            /**
                             * * Create calendar week labels
                             * */
                            private function _createLabels() {
                                $content = '';
                                foreach ($this->dayLabels as $index => $label) {
                                    $content .= '<div class="calendar_names">' . $label . '</div>' . "\r\n";
                                }
                                return $content;
                            }

                            /**
                             * * Calculate number of weeks in a particular month
                             * */
                            private function _weeksInMonth($month = null, $year = null) {
                                if (null == ($year)) {
                                    $year = date("Y", time());
                                }
                                if (null == ($month)) {
                                    $month = date("m", time());
                                }
                                // Find number of days in this month
                                $daysInMonths = $this->_daysInMonth($month, $year);
                                $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);
                                $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));
                                $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));
                                if ($monthEndingDay < $monthStartDay) {
                                    $numOfweeks++;
                                }
                                return $numOfweeks;
                            }

                            /**
                             * * Calculate number of days in a particular month
                             * */
                            private function _daysInMonth($month = null, $year = null) {
                                if (null == ($year))
                                    $year = date("Y", time());
                                if (null == ($month))
                                    $month = date("m", time());
                                return date('t', strtotime($year . '-' . $month . '-01'));
                            }

                        }

                        $calendar = new Calendar();
                        echo $calendar->show();
                        ?>
                    </div>

                    <div class="tile">
                        <a href="kalender.php"> 
                            <img src="img/calendar.png" alt="Calendar" class="imgmain">
                            <p class="ptile">Kalender</p>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="evaluatie.php">
                            <img src="img/feedback3.png" alt="Evaluatie" class="imgmain">
                            <div class="ptile">Evaluatie</div>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="shownotulen.php">
                            <img src="img/notulen.png" alt="Notulen" class="imgmain">
                            <div class="ptile">Notulen</div>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="uploadgroepen.php">
                            <img src="img/group-vector-icon-png-4.png" alt="Groepen" class="imgmain">
                            <div class="ptile">Groepen</div>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="Tips.php">
                            <img src="img/tips.png" alt="Tips" class="imgmain">
                            <div class="ptile">Tipdoos</div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="footer" >
                <div id="footercontainer" >
                    <div id="footersearch">
                        <div id="search">
                            <input type="text" placeholder="Zoeken..." class="zoektext">
                        </div>
                    </div>
                    <div id="footerinfo">
                        <div class="vl"></div>
                        <div class="footertext" >
                            <a href="Contact.php" >
                                <p class="textfooter"> Contact </p>
                            </a>
                        </div>
                        <div class="footertext" >
                            <a href="disclaimer.php">
                                <p class="textfooter"> Disclaimer </p>
                            </a>
                        </div>
                        <div class="footertext" >
                            <p class="textfooter"> &copy; NHL Stenden </p>
                        </div>
                    </div>
                </div>
                <div id="footercopyright"> <h3> Alle rechten voorbehouden &copy; NHL Stenden 2018-2019 </h3>
                </div>
            </div>
        </div>
    </body>
</html>