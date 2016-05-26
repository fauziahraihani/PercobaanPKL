<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;
use app\controllers\SiteController;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Job');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-out-index3">

<?php $job= "" ?>
    <form method="POST">
    <p>
        <label for="jobTitle"> Job Title </label>
        <input id ="jobTitle "type="text" value="Submit" name="jobTitle" placeholder="Insert Job Title">
        <input id="submit" type="submit" value="Submit" class = "btn btn-success">

    </p>
    </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                echo SiteController::connect(); 
                
                $tahun = $_POST["year"];
                

                $query = "SELECT EXTRACT(MONTH FROM Tgl_Bayar) AS Bulan, SUM(jumlahbayar) AS Pembayaran
                        FROM PEMBAYARAN_OUT
                        WHERE status_bayar = 'Lunas' AND EXTRACT(year FROM tgl_bayar) = '".$tahun."'
                        GROUP BY EXTRACT(MONTH FROM Tgl_Bayar);";
                
                $result = pg_query($query);

                if (pg_num_rows($result)!=0){
                    echo "<br>"; 
                    echo "<h3>Rekapitulasi Pembayaran Keluar Tahun ".$tahun." </h3> <br>";
                    echo "<table class='table table-striped table-bordered'>"; 
                    echo "<thead>";
                    echo "<th>#</th>";
                    echo "<th>Bulan</th>";
                    echo "<th>Jumlah Pembayaran</th>";
                    echo "</thead>";
                    echo "<tbody>"; 
                       
                        $count=0;
                        while($value = pg_fetch_array($result)){
                            $count++;
                            echo "<td align='left'>".$count."</td>";

                            if($value['bulan'] == 1) {
                                echo "<td align='left'>Januari</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                                                         
                            } else if($value['bulan'] == 2) {
                                echo "<td align='left'>Februari</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                                 
                            }else if($value['bulan'] == 3) {
                                echo "<td align='left'>Maret</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                               
                            }else if($value['bulan'] == 4) {
                                echo "<td align='left'>April</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                               
                            } else if($value['bulan'] == 5) {
                                echo "<td align='left'>Mei</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                               
                            } else if($value['bulan'] == 6) {
                                echo "<td align='left'>Juni</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                               
                            } else if($value['bulan'] == 7) {
                                echo "<td align='left'>Juli</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                                
                            } else if($value['bulan'] == 8) {
                                echo "<td align='left'>Agustus</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                                
                            } else if($value['bulan'] == 9) {
                                echo "<td align='left'>September</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                                
                            } else if($value['bulan'] == 10) {
                                echo "<td align='left'>Oktober</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                                
                            } else if($value['bulan'] == 11) {
                                echo "<td align='left'>November</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                                
                            } else if($value['bulan'] == 12) {
                                echo "<td align='left'>Desember</td>";
                                echo "<td align='left'>".$value['pembayaran']."</td>";
                                
                            }
                              echo "</tr>";
                           }
                        
                    echo "</tbody>";  
                    echo "</table>";
               
            }
            else {
                    echo "<h3>Rekapitulasi Pembayaran Keluar Tahun ".$tahun." tidak ditemukan</h3> <br>";
                }

            }
        ?>



</div>

