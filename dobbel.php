
    <form class="" action="" method="post">
      <input type="submit" name="gok" value="gok">
    </form>
    <?php
    $userID = "665";
    $score = "";
    $aWorp = array(0,0,0,0,0);
    
  
    for ($i=0 ;  $i <5   ; $i++)
    			{$random_numb = rand(1,6);
    			create_image($random_numb, $i);
    			print "<img src=".$random_numb.".png?".date("U")." >  " ;
    			//de complete worp is nodig in een array tbv score analyse
    			//maak de array
    			$aWorp[$i] = $random_numb;
    			}
          
          //  print_r($aWorp);
          //tel de ogen van de worp
          $aScore = analyse($aWorp);//tel de ogen van de worp
          pokerOrNot($aScore);//tell it like it is
print_r  ($aWorp);
          function analyse($aWorp){
    $aScore = array (0,0,0,0,0,0,0);//initialiseer de array met alle waarden op 0
    for ($i = 1 ; $i <= 6 ; $i++){//outer loop
  		for ($j = 0 ; $j <5 ; $j++){//inner loop
              if ($aWorp[$j] == $i){
                  $aScore[$i]++;
              }}}
    return $aScore; //$aScore is een lokale variabele.
	//via de return krijg je de array $aScore  'buiten de functie'
}

function pokerOrNot($aScore) {
  global $score;
rsort($aScore);
print_r(array_values($aScore));

if ($aScore[0] == 2 && $aScore[1] < 2) {
  echo "one pair";
  $score = "one_pair";
}
if ($aScore[0] == 2 && $aScore[1] == 2) {
  echo "two pair";
  $score = "two_pair";
}
if ($aScore[0] == 3 && $aScore[1] < 2) {
  echo "3 of a kind";
  $score = "3_of_a_kind";
}
if ($aScore[0] == 3 && $aScore[1] == 2) {
  echo "full house";
  $score = "full_house";
}
if ($aScore[0] == 4) {
  echo "carré";
  $score = "carré";
}
if ($aScore[0] == 5) {
  echo "poker";
  $score = "poker";
}


}
    function  create_image($random_numb){
    //$random_numb = rand(1,6);
     echo "$random_numb";
             $im = @imagecreate(200, 200) or die("Cannot Initialize new GD image stream");
             $background_color = imagecolorallocate($im, 255, 255, 0);   // yellow

                              // red
             $blue = imagecolorallocate($im, 0, 0, 255);                 // blue

             if($random_numb == 1 OR $random_numb==3 OR $random_numb==5) {
               imagefilledarc($im, 100, 100, 40, 40, 0, 360, $blue, IMG_ARC_PIE); //4
             }
             if($random_numb ==2 OR $random_numb==3) {
               imagefilledarc($im, 30, 50, 40, 40, 0, 360, $blue, IMG_ARC_PIE); //1
               imagefilledarc($im, 170, 150, 40, 40, 0, 360, $blue, IMG_ARC_PIE);//7
             }
             if($random_numb == 4 OR $random_numb ==5  OR $random_numb == 6) {
              imagefilledarc($im, 30, 50, 40, 40, 0, 360, $blue, IMG_ARC_PIE); //1
              imagefilledarc($im, 170, 50, 40, 40, 0, 360, $blue, IMG_ARC_PIE); //2
              imagefilledarc($im, 30, 150, 40, 40, 0, 360, $blue, IMG_ARC_PIE);//6
              imagefilledarc($im, 170, 150, 40, 40, 0, 360, $blue, IMG_ARC_PIE);//7
             }
             if ($random_numb == 6) {
              imagefilledarc($im, 30, 100, 40, 40, 0, 360, $blue, IMG_ARC_PIE);//3
              imagefilledarc($im, 170, 100, 40, 40, 0, 360, $blue, IMG_ARC_PIE);//5
             }


             imagepng($im,$random_numb . ".png");

             imagedestroy($im);
     }
     
     $worp = implode($aWorp);
     $time = date("Y-m-d H:i:s");
     echo $worp;
     $sql ="INSERT INTO data (User_ID, Worp, Score, aTime)
            VALUES ('$userID', '$worp', '$score', '$time')";
            
     if ($dbhandle -> query($sql) === TRUE) {
       echo "<br>update succes<br>";
     //  echo $sql;//debug
     }else {
       echo "<br> Error:" . $sql . "<br>" .$dbhandle->error;
     }
     
       $dbhandle -> close(); //save resources

     
?>

