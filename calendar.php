<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Linear Calendar</title>
        <style type="text/css" media="all">
            body {
            font-family:"Calibri";            
            }
            table {
            border-collapse:collapse;
            border:1px #000 solid;
            }
            td {
            height: 52px;
            vertical-align:top;
            text-align:center;
            width:30px;
            }
            .day6, .day7 {
            background:#ECECEC;
            }
            .monthName {
            text-align:left;
            vertical-align:middle;
            }
            .monthName div {
            padding-left:10px;
            }
        </style>
    </head>

    <body>
        <?php
            $dDaysOnPage = 37;
            $dDay = 1;
            if ($_REQUEST['y'] <> "") { $dYear = $_REQUEST['y']; } else { $dYear = date("Y"); }
        ?>
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
                <th><?php echo $dYear; ?></th>
                <?php
                    for($i = 1; $i <= 5; ++$i) {
                ?>
                <th>Mo</th>
                <th>Tu</th>
                <th>We</th>
                <th>Th</th>
                <th>Fr</th>
                <th>Sa</th>
                <th>Su</th>
                <?php
                    }
                ?>
                <th>Mo</th>
                <th>Tu</th>
            </tr>
            <?php
                function FriendlyDayOfWeek($dayNum) {
                // converts the sunday to 7
                // This function can be removed in php 5 by - date("N"),
                // just remove function calls below and replace by swapping date("w" for date("N"
                if ($dayNum == 0){ return 7; } else { return $dayNum; }
                }
                
                function InsertBlankTd($numberOfTdsToAdd) {
                    for($i=1;$i<=$numberOfTdsToAdd;$i++) {
                        $tdString .= "<td></td>";
                    }
                    return $tdString;
                }
                
                function display($dYear, $dDay, $daysInMonth, $dDaysOnPage, $ll, $ul) {
                    for ($mC=$ll;$mC<=$ul;$mC++) {
                        $currentDT = mktime(0,0,0,$mC,$dDay,$dYear);
                        echo "<tr><td class='monthName'><div>".date("M",$currentDT)."</div></td>";
                        $daysInMonth = date("t",$currentDT);
                
                        echo InsertBlankTd(FriendlyDayOfWeek(date("w",$currentDT))-1);
                
                        for ($i=1;$i<=$daysInMonth;$i++) {
                            $exactDT = mktime(0,0,0,$mC,$i,$dYear);
                            echo "<td class='days day".FriendlyDayOfWeek(date("w",$exactDT))."'>".$i."</td>";
                        }
                
                        echo InsertBlankTd($dDaysOnPage - $daysInMonth - FriendlyDayOfWeek(date("w",$currentDT))+1);
                        echo "</tr>";
                    }
                }
                display($dYear, $dDay, $daysInMonth, $dDaysOnPage, 6, 12);
                echo "<tr><td colspan='38' style='height: 30px; vertical-align: middle'>".$dYear." - ".($dYear + 1)." Calendar</td></tr>";
                display($dYear + 1, $dDay, $daysInMonth, $dDaysOnPage, 1, 6);
                
            ?>
            <tr>
                <th><?php echo $dYear + 1; ?></th>
                <?php
                    for($i = 1; $i <= 5; ++$i) {
                ?>
                <th>Mo</th>
                <th>Tu</th>
                <th>We</th>
                <th>Th</th>
                <th>Fr</th>
                <th>Sa</th>
                <th>Su</th>
                <?php
                    }
                ?>
                <th>Mo</th>
                <th>Tu</th>
            </tr>
        </table>
    </body>
</html>
