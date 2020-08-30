<?php
include("config/error.php");

include("includes/head.php");
if (!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
    header("location:index.php");

    echo "<script>window.location='index.php'</script>";

}


$ussserid = (isset($_REQUEST['ussserid'])) ? $_REQUEST['ussserid'] : $_SESSION['profileid'];
//Level 1 width = 4 gives space for 4 Sponsees
$level1Width = 4;
// All other levels width = 2 gives space for 2 Sponsees
$levelWidth = 2;

// Level height is based on maximum number of downliners per level
$level0height = 1;
$level1height = 1;
$level2height = 2;
$level3height = 4;
$level4height = 8;
$level5height = 16;
$level6height = 32;
$level7height = 64;
$level8height = 128;
$level9height = 256;
$level10height = 512;
$level11height = 1024;
$level12height = 2048;
$level13height = 4096;


$level0 = array();
$level1 = array();
$level2 = array();    // equals level1height by levelwidth
$level3 = array();    // equals level2height by levelwidth
$level4 = array();    // equals level3height by levelwidth
$level5 = array();
$level6 = array();
$level7 = array();
$level8 = array();
$level9 = array();
$level10 = array();
$level11 = array();
$level12 = array();
$level13 = array();


$level1Sponsees = array();
$level2Sponsees = array();
$level3Sponsees = array();
$level4Sponsees = array();
$level5Sponsees = array();
$level6Sponsees = array();
$level7Sponsees = array();
$level8Sponsees = array();
$level9Sponsees = array();
$level10Sponsees = array();
$level11Sponsees = array();
$level12Sponsees = array();


//$sliced_array = array();// for trial

$level1Profiles = array();
$level2Profiles = array();
$level3Profiles = array();
$level4Profiles = array();
$level5Profiles = array();
$level6Profiles = array();
$level7Profiles = array();
$level8Profiles = array();
$level9Profiles = array();
$level10Profiles = array();
$level11Profiles = array();
$level12Profiles = array();
$level13Profiles = array();


$select = mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid'");                   //ussserid = Profile ID of the current user at Level 0
$u_num = mysql_num_rows($select);
if ($u_num > 0) {
    while ($fetch = mysql_fetch_array($select)) {
        $level0[0] = $fetch['user_fname'] . " [" . $fetch['user_profileid'] . "]";

    }
}

// function populates with index of array elements
function populateWithIndex($width, $height, &$array)
{
    for ($i = 1; $i <= $height; $i++) {
        for ($j = 0; $j <= $width; $j++) {
            $array[$i][$j] = $i . $j;
        }
    }
}

//level 1
populateWithIndex(4, 1, $level1);
populateWithIndex(2, 2, $level2);
$level1[1][0] = $level0[0];
$level1Profiles[1][0] = $ussserid;

/* use $_GET request on selector using  id = 'level' */
$getLevel = (int)$_GET['level'];
/* for security purpose, in case someone tries anything greater than the maximum height */
$getLevel = $getLevel > 13 ? 13 : $getLevel;

/* This block of code populates empty boxes with indexes when necessary */
if (isset($getLevel)) {
    $exponent = 1;
    $base = 2;
    for ($height = 2; $height < $getLevel; $height++) {
        $nextLevel = $height + 1;
        populateWithIndex($levelWidth, pow($base, $exponent), ${'level' . $height});
        populateWithIndex($levelWidth, pow($base, $exponent + 1), ${'level' . $nextLevel});
        $exponent++;
    }
}


/*This function gives the colour per each level */
/*sunflower-levels color definitions are found later in the entire code*/
function levelColorSelector($level, $index)
{
    $css_style = "default-level";
    switch ($level) {

        case 0:
            if ($index == 0) {
                $css_style = "sunflower-level0";
            } else {
                $css_style = "sunflower-level0";
            }
            break;

        case 1:
            if ($index == 0) {
                $css_style = "sunflower-level0";
            } else {
                $css_style = "sunflower-level1";
            }
            break;

        case 2:
            if ($index == 0) {
                $css_style = "sunflower-level1";
            } else {
                $css_style = "sunflower-level2";
            }
            break;

        case 3:
            if ($index == 0) {
                $css_style = "sunflower-level2";
            } else {
                $css_style = "sunflower-level3";
            }
            break;

        case 4:
            if ($index == 0) {
                $css_style = "sunflower-level3";
            } else {
                $css_style = "sunflower-level4";
            }
            break;

        case 5:
            if ($index == 0) {
                $css_style = "sunflower-level4";
            } else {
                $css_style = "sunflower-level5";
            }
            break;

        case 6:
            if ($index == 0) {
                $css_style = "sunflower-level5";
            } else {
                $css_style = "sunflower-level6";
            }
            break;

        case 7:
            if ($index == 0) {
                $css_style = "sunflower-level6";
            } else {
                $css_style = "sunflower-level7";
            }
            break;

        case 8:
            if ($index == 0) {
                $css_style = "sunflower-level7";
            } else {
                $css_style = "sunflower-level8";
            }
            break;

        case 9:
            if ($index == 0) {
                $css_style = "sunflower-level8";
            } else {
                $css_style = "sunflower-level9";
            }
            break;

        case 10:
            if ($index == 0) {
                $css_style = "sunflower-level9";
            } else {
                $css_style = "sunflower-level10";
            }
            break;

        case 11:
            if ($index == 0) {
                $css_style = "sunflower-level10";
            } else {
                $css_style = "sunflower-level11";
            }
            break;

        case 12:
            if ($index == 0) {
                $css_style = "sunflower-level11";
            } else {
                $css_style = "sunflower-level12";
            }
            break;

        case 13:
            if ($index == 0) {
                $css_style = "sunflower-level12";
            } else {
                $css_style = "sunflower-level13";
            }
            break;

        //case default:

    }

    return $css_style;
}

/*The function getSponsee holds the entire algortihm for fetching user details from the database*/
function getSponsee($level)
{
    global $ussserid;           //Variable holds ussserid of the user at level 0
    global $levelWidth;         //Level width represents the maximum sponsees a sponsor can have.

    global $level0;
    global $level1;
    global $level2;
    global $level3;
    global $level4;
    global $level5;
    global $level6;
    global $level7;
    global $level8;
    global $level9;
    global $level10;
    global $level11;
    global $level12;
    global $level13;

    global $level1Sponsees;
    global $level2Sponsees;
    global $level3Sponsees;
    global $level4Sponsees;
    global $level5Sponsees;
    global $level6Sponsees;
    global $level7Sponsees;
    global $level8Sponsees;
    global $level9Sponsees;
    global $level10Sponsees;
    global $level11Sponsees;
    global $level12Sponsees;

    global $level1Profiles;
    global $level2Profiles;
    global $level3Profiles;
    global $level4Profiles;
    global $level5Profiles;
    global $level6Profiles;
    global $level7Profiles;
    global $level8Profiles;
    global $level9Profiles;
    global $level10Profiles;
    global $level11Profiles;
    global $level12Profiles;
    global $level13Profiles;


    $level3height = 4;
    $level4height = 8;
    $level5height = 16;
    $level6height = 32;
    $level7height = 64;
    $level8height = 128;
    $level9height = 256;
    $level10height = 512;
    $level11height = 1024;
    $level12height = 2048;
    $level13height = 4096;


    switch ($level) {
        case 1:
            /*Query finds list(s) of sponsee(s) with sponser id being the sponsor's id in the database*/
            $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' and user_profileid!='$ussserid' order by user_id asc");
            /*Query calculates the sum of rows based on the number of Sponsees of the Sponsor found in the database   */
            $ussserid_num = mysql_num_rows($select_ussserid);
            /*loop content runs when row(s) are found ie $ussserid_num = number of rows found*/
            if ($ussserid_num > 0) {
                $i = 1; //level 1 row
                $j = 1; // level 1 column


                while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                    $level1[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]"; //$level1 array will contain Sponsee's first name and profile id
                    $level1Profiles[$i][$j] = $fetch_ussserid['user_profileid'];

                    $j++;
                }
            }

            /*Offset of 2 fetches the last two Sponsees instead of the first two*/
            $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' and user_profileid!='$ussserid' order by user_id asc limit 2 offset 2");
            $ussserid_num = mysql_num_rows($select_ussserid);

            if ($ussserid_num > 0) {

                $j = 1;  // level 2 row
                $k = 0;  // level 2 column
                while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                    $level2[$j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                    $level1Sponsees[$j] = $fetch_ussserid['user_profileid'];
                    $level2Profiles[$j][$k] = $fetch_ussserid['user_profileid'];
                    $j++;
                }
            }
            break;

        case 2:
            $i = 1; // level 2 row
            $z = 0;
            foreach ($level1Sponsees as $sponsor) {
                $j = 1;  //level 2 column
                $k = 0; //level 3 first column

                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2 ");
                $ussserid_num = mysql_num_rows($select_ussserid);

                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level2[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level3[$j + $z][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level2Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level3Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $level2Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }


                $i++;
                $z += 2;
            }

            break;

        case 3:
            $i = 1;
            $z = 0;

            for ($counter = 1; $counter <= $level3height; $counter++)
                if (!array_key_exists($counter, $level2Sponsees)) {
                    $level2Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level2Sponsees);

            foreach ($level2Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2  ");
                $ussserid_num = mysql_num_rows($select_ussserid);

             if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level3[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level3Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level3Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level4[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level4Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
           }

                $i++;
                $z += 2;

            }

            break;


        case 4:
            $i = 1;
            $z = 0;

            /*This loop iterates through the levelxSponsees array*/
            for ($counter = 1; $counter <= $level4height; $counter++)

                /*This condition checks if an index in the array doesn't exist*/
                if (!array_key_exists($counter, $level3Sponsees)) {

                    /*If an index doesn't exist, add to the end of the array and set it's value to 0*/
                    $level3Sponsees[$counter] = array_fill($counter, 0);
                }

            /*Finally sort the resulting array using key values in ascending order*/
            $myArray = ksort($level3Sponsees);

            foreach ($level3Sponsees as $sponsor) {

                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2 ");
                $ussserid_num = mysql_num_rows($select_ussserid);

                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level4[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level4Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level4Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level5[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level5Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;

                    }
                }


                $i++;
                $z += 2;

            }

            break;


        case 5:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level5height; $counter++)
                if (!array_key_exists($counter, $level4Sponsees)) {
                    $level4Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level4Sponsees);
            foreach ($level4Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2");
                $ussserid_num = mysql_num_rows($select_ussserid);


                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level5[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level5Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level5Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level6[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level6Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;


        case 6:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level6height; $counter++)
                if (!array_key_exists($counter, $level5Sponsees)) {
                    $level5Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level5Sponsees);
            foreach ($level5Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2");
                $ussserid_num = mysql_num_rows($select_ussserid);


                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level6[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level6Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level6Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level7[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level7Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;

        case 7:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level7height; $counter++)
                if (!array_key_exists($counter, $level6Sponsees)) {
                    $level6Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level6Sponsees);
            foreach ($level6Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2");
                $ussserid_num = mysql_num_rows($select_ussserid);


                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level7[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level7Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level7Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level8[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level8Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;

        case 8:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level8height; $counter++)
                if (!array_key_exists($counter, $level7Sponsees)) {
                    $level7Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level7Sponsees);
            foreach ($level7Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2");
                $ussserid_num = mysql_num_rows($select_ussserid);


                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level8[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level8Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level8Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level9[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level9Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;

        case 9:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level9height; $counter++)
                if (!array_key_exists($counter, $level8Sponsees)) {
                    $level8Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level8Sponsees);
            foreach ($level8Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2");
                $ussserid_num = mysql_num_rows($select_ussserid);


                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level9[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level9Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level9Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level10[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level10Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;

        case 10:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level10height; $counter++)
                if (!array_key_exists($counter, $level9Sponsees)) {
                    $level9Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level9Sponsees);
            foreach ($level9Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2");
                $ussserid_num = mysql_num_rows($select_ussserid);


                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level10[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level10Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level10Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level11[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level11Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;

        case 11:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level11height; $counter++)
                if (!array_key_exists($counter, $level10Sponsees)) {
                    $level10Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level10Sponsees);
            foreach ($level10Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2");
                $ussserid_num = mysql_num_rows($select_ussserid);


                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level11[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level11Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level11Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level12[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level12Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;

        case 12:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level12height; $counter++)
                if (!array_key_exists($counter, $level11Sponsees)) {
                    $level11Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level11Sponsees);
            foreach ($level11Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc limit 2");
                $ussserid_num = mysql_num_rows($select_ussserid);


                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level12[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level12Sponsees[$z + $j] = $fetch_ussserid['user_profileid'];
                        $level12Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $level13[$z + $j][$k] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level13Profiles[$z + $j][$k] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;

        case 13:
            $i = 1;
            $z = 0;
            for ($counter = 1; $counter <= $level13height; $counter++)
                if (!array_key_exists($counter, $level12Sponsees)) {
                    $level12Sponsees[$counter] = array_fill($counter, 0);
                }

            $myArray = ksort($level12Sponsees);
            foreach ($level12Sponsees as $sponsor) {
                $j = 1;
                $k = 0;
                $select_ussserid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
                $ussserid_num = mysql_num_rows($select_ussserid);
                if ($ussserid_num > 0) {
                    while ($fetch_ussserid = mysql_fetch_array($select_ussserid)) {
                        $level13[$i][$j] = $fetch_ussserid['user_fname'] . " [" . $fetch_ussserid['user_profileid'] . "]";
                        $level12Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
                        $j++;
                    }
                }

                $i++;
                $z += 2;
            }

            break;
    }
}

/* Function call for first two levels*/
getSponsee(1);
getSponsee(2);


/* This block queries the database per the value of $getLevel.
*  eg If getLevel = 4, getSponsee() gets called 4 times
*/
if (isset($getLevel)) {
    for ($index = 2; $index < $getLevel; $index++) {

        getSponsee($index + 1);
    }
}

?>
<head>
    <script>
        /* This script section gets a query parameter value 'getLevel'
        *  and is appended to the page url to aid level display
        *  using URLSearchParams class
        *  */
        function displayLevel() {
            var getLevel = document.getElementById('levelSelectInput').value;
            /* create a new query params object */
            var queryParams = new URLSearchParams(window.location.search)
            /* set query params value with "getLevel" from level selector in html*/
            queryParams.set("level", getLevel);
            /* attach query parameter to url*/
            history.replaceState(null, null, "?" + queryParams.toString())
            /* Reload page afterwards*/
            location.reload();

        }
    </script>
    <script type="text/javascript">
        /* This block of code ensures the select option doesn't return
        *  to its default value after page reloads.
        *  the setTimeout function prevents the dom from getting the
        *  select value until the page has fully loaded
        * */
        (function () {
            const queryParams = new URLSearchParams(window.location.search)
            const levelParams = queryParams.get('level')
            console.log(levelParams)
            if (levelParams) {
                setTimeout(function () {
                    document.getElementById('levelSelectInput').value = levelParams;
                }, 1000)
            }
        })();
    </script>

    <style>
        td {
            line-height: 0;
            padding: 1rem 0;
        }

        .sunflower-level0 {
            background-color: blue;
        }

        .sunflower-level1 {
            background-color: orange;
        }

        .sunflower-level2 {
            background-color: purple;
        }

        .sunflower-level3 {
            background-color: #EB3F1C;
        }

        .sunflower-level4 {
            background-color: green;
        }

        .sunflower-level5 {
            background-color: black;
        }

        .sunflower-level6 {
            background-color: violet;
        }

        .sunflower-level7 {
            background-color: cyan;
        }

        .sunflower-level8 {
            background-color: pink;
        }

        .sunflower-level9 {
            background-color: indigo;
        }

        .sunflower-level10 {
            background-color: gray;
        }

        .sunflower-level11 {
            background-color: #87CEFA;
        }

        .sunflower-level12 {
            background-color: violet;
        }

        .sunflower-level13 {
            background-color: #FFD700;
        }

        .sunflower p {
            padding-bottom: 5px;
        }

        ul.sunflower {
            display: flex;
            margin: 0;
            margin-left: 12px;
            /*float: left;*/
            display: flex;
            width: 100%;
            padding: 0;
            list-style: none;
            height: 70px;
        }

        .sunflower a {
            width: 95px;
            min-height: 100%;
            text-align: left;
            font-size: 12px;
            text-decoration: none;
            color: white;
            display: block;
            padding: 0.2em 0.6em;
            border: 1px solid white;
        }

        .sunflower a:hover {
            background-color: #EB1CDD;
        }

    </style>

    <style type="text/css">
        .numwraper {
            position: relative;
            width: 65px;
            height: 65px;
        }

        /*.numwraper img {
            width: 100%;
            height: 100%;
        }*/

        .numwraper span {
            position: absolute;
            right: 34%;
            top: 31%;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 12px;
            background-color: #FFF;
            padding: 0px 2px 0px 2px;
            display: block;
        }

        a.tooltipp {
            outline: none;
            opacity: 1;
        }

        a.tooltipp strong {
            line-height: 30px;
        }

        a.tooltipp:hover {
            text-decoration: none;
        }

        a.tooltipp span {
            z-index: 10;
            display: none;
            padding: 14px 20px;
            margin-top: -30px;
            margin-left: 10px;
            width: 280px;
            line-height: 16px;
        }

        a.tooltipp:hover span {
            display: inline;
            position: absolute;
            color: #111;
            border: 1px solid #DCA;
            background: #fffAF0;
        }

        .callout {
            z-index: 20;
            position: absolute;
            top: 30px;
            border: 0;
            left: -12px;
        }

        /*CSS3 extras*/
        a.tooltipp span {
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            -moz-box-shadow: 5px 5px 8px #CCC;
            -webkit-box-shadow: 5px 5px 8px #CCC;
            box-shadow: 5px 5px 8px #CCC;
        }

        .circle {
            display: block;
            width: 60px;
            height: 60px;
            margin: 1em auto;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            -webkit-border-radius: 99em;
            -moz-border-radius: 99em;
            border-radius: 99em;
            border: 4px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
        }

        .level_circle {
            display: block;
            width: 45px;
            height: 45px;
            margin: 1em auto;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            -webkit-border-radius: 99em;
            -moz-border-radius: 99em;
            border-radius: 99em;
            border: 4px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
        }
    </style>

</head>
<body>
<div class="container main">
    <!-- Start Header-->
    <?php include("includes/header.php"); ?>
    <!-- End Header-->

    <!-- Start Navigation -->
    <?php include("includes/menu.php"); ?>
    <!-- End Navigation -->
    <hr/>

    <!-- Profile info -->
    <?php include("includes/profileheader.php"); ?>
    <!-- Profile info end -->

    <hr/>

    <div class="row">
        <?php include("includes/profilemenu.php"); ?>
        <div class="span9">
            <div class="row">
                <div class="span9">
                    <div class="banner" style="padding-right: 0;">
                        <?php ?>
                        <h4 class="navbar-inner"
                            style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">YOUR DROPS</h4>
                        <table width="100%" border="1" cellspacing="0" cellpadding="0"
                               style="background:#F8F8F8; border-collapse:collapse; border:1px #FF6600 solid; ">
                            <tr><?php $img = Getprofileimage($ussserid); ?>
                                <td align="center" valign="bottom" style=" border:1px #FF6600 solid;">
                                    <img src="<?php echo $img; ?>" class="circle"/>
                                    <a href="#" class="forgotlink tooltipp" style="margin-left:50px;">
                                        <?php
                                        $select = mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid'");
                                        $u_num = mysql_num_rows($select);
                                        if ($u_num > 0)
                                        {
                                        while ($fetch = mysql_fetch_array($select))
                                        {
                                        echo $fetch['user_fname'];
                                        ?>
                                        <span style="font-size:12px;"><img class="callout" src="images/callout.gif"/>
                   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;"
                           align="left"><?php echo $fetch['user_fname'] . '\'s'; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:100%;" align="left">
                          Name : <b><?php echo $fetch['user_fname'] . $fetch['user_secondname'] . " " . $fetch['user_lname']; ?> </b>
                      </div>
                      <div style="clear:both;">&nbsp;</div>
                      </div>
                       <div>
					  <div style="width:150px; float: left;"
                           align="left"> Sponsor Name : <b><?php echo $fetch['user_sponsername']; ?> </b>
                      </div>
                           <div style="width:150px; float: left;" align="left"> Contact : <b><?php echo '0'.$fetch['user_phone']; ?> </b>
                      </div>
					  <div style="clear:both;">&nbsp;</div>
                      </div>

                      <div>
					  <div style="float:left; width:150px;"
                           align="left"> Profile Id : <b><?php echo $fetch['user_profileid']; ?></b>
                      </div>

                      <div style="float:left; width:150px;"
                           align="left"> Membership : <b><?php echo Getmembetshipfromprofileid($fetch['user_profileid']); ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>

					   <div>
					 <div style="float:left; width:170px;"
                          align="left"> Refferal Limit : <b><?php echo Getmembetshipcount($fetch['user_profileid']); ?> </b></div>
					  <div style="float:left; width:130px;"
                           align="left"> Reffered Count: <b><?php echo directrefferalcount($fetch['user_profileid']); ?></b></div>

					  </div>

					  </div>
					  </span>


                                    </a>
                                    <?php }
                                    } ?>
                                    <!--Level 0-->
                                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 0</span>
                                </td>
                            </tr>

                            <?php ?>

                            <!--Level 1-->
                            <!-- Since we want level 1 to always show on page load, we make it static-->
                            <tr>
                                <td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 1</span>
                                    <?php
                                    for ($i = 1; $i <= $level0height; $i++) {
                                        echo "<br><ul class='sunflower'>";
                                        for ($j = 0; $j <= $level1Width; $j++) {
                                            echo "<li><a href='sunflower.php?ussserid=" . $level1Profiles[$i][$j] . "' class='" . levelColorSelector(1, $j) . " '>" . $level1[$i][$j] . "</a></li>";
                                            //$level2[$i][$j] = $i.$j;
                                        }
                                        echo "</ul>";
                                    }
                                    echo "<br>";
                                    ?>
                                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 1</span>

                                </td>
                            </tr>

                            <!--Other Levels-->
                            <!--Show other levels dynamically to avoid slow page loading -->
                            <?php for ($index = 1; $index < $getLevel; $index++) : ?>
                                <?php $currentLevel = $index + 1; ?>

                                <tr>
                                    <td>
                                        <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;"><?php echo "level " . $currentLevel ?></span>
                                        <?php
                                        for ($i = 1; $i <= ${'level' . $currentLevel . 'height'}; $i++) {
                                            echo "<br><ul class='sunflower'>";
                                            for ($j = 0; $j <= $levelWidth; $j++) {
                                                echo "<li><a href='sunflower.php?ussserid=" . ${'level' . $currentLevel . 'Profiles'}[$i][$j] . "' class='" . levelColorSelector($index + 1, $j) . "'>" . ${'level' . $currentLevel}[$i][$j] . "</a></li>";
                                                //$level2[$i][$j] = $i.$j;
                                            }
                                            echo "</ul>";
                                        }
                                        echo "<br>";
                                        ?>
                                        <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;"><?php echo "level " . $currentLevel ?></span>
                                    </td>
                                </tr>

                            <?php endfor; ?>


                        </table>

                        <!-- This form section handles the level selector and the button -->
                        <form method="post" name="levelSelector" onsubmit="event.preventDefault(); displayLevel()">
                            <div class="form-group" style="display: inline-flex; margin-top: 10px">
                                <label style="padding-right: 10px; padding-top: 5px; font-size: 15px; font-weight: 600;">Display
                                    Levels</label>
                                <select class="form-control" name="levels"
                                        style="width: auto; height: 28px; margin-right: 10px" id="levelSelectInput">
                                    <option value="2">Level 2</option>
                                    <option value="3">Level 3</option>
                                    <option value="4">Level 4</option>
                                    <option value="5">Level 5</option>
                                    <option value="6">Level 6</option>
                                    <option value="7">Level 7</option>
                                    <option value="8">Level 8</option>
                                    <option value="9">Level 9</option>
                                    <option value="10">Level 10</option>
                                    <option value="11">Level 11</option>
                                    <option value="12">Level 12</option>
                                    <option value="13">Level 13</option>
                                </select>
                                <button class="btn btn-primary next" type="submit" name="submit" style="height: 28px;">
                                    Go
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <br/>
        </div>

    </div>

    <?php include("includes/footer.php"); ?>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>