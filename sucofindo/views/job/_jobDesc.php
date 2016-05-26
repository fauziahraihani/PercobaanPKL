
<?php
use app\controllers\SiteController; 
echo SiteController::connect();
?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 100px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-lqy6{text-align:right;vertical-align:top}
.tg .tg-9hbo{font-weight:bold;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}

.enjoy-css {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  border: none;
  font: normal normal bold 16px/2 Verdana, Geneva, sans-serif;
  color: black;
  text-align: center;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  letter-spacing: 1px;
  word-spacing: 1px;
}
</style>

<div class="enjoy-css">
JOB DESCRIPTION
<br>
PT. SUCOFINDO
<br>
<br>

</div>
<?php 
    $jobTitle = Yii::$app->request->get('jobTitle');
?>


<div>
Job Title = 
<?php echo $jobTitle ?>
<br>
<br>
</div>

<br>

<table align="center" class="tg">
  <tr align="center">
    <th class="tg-9hbo">No.</th>
    <th class="tg-9hbo">Job Description</th>
  </tr>
<?php 
      $jobTitle = Yii::$app->request->get('jobTitle');
      $query = "SELECT jobdesc FROM job WHERE jobTitle = '".$jobTitle."';";
      
      $result = pg_query($query); 
      	$i = 1;
      	while($row = pg_fetch_assoc($result)) { ?>
  <tr>
    <td align="center" class="tg-lqy6"><?php echo $i++; ?></td>
    <td align="center" class="tg-yw4l"><?php echo $row['jobdesc'];?></td>
  </tr>

  <?php } ?>
</table>