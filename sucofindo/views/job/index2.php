<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;
use app\controllers\SiteController;
use app\controllers\JobController;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Job Description');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job">

<?php $jobTitle = "" ?>
    <form method="POST">
    <p>
        <label for="jobs"> Job Title </label>
        
        <input type="text"  id="jobs" class ="input" name="jobs" placeholder="Insert job title"  required autofocus> 
            
        <input id="submit" type="submit" value="Submit" class = "btn btn-success">


    </p>
    </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                echo SiteController::connect(); 
                
                $jobTitle = $_POST["jobs"];
                

                $query = "SELECT jobdesc FROM job WHERE jobtitle = '".$jobTitle."';";
                
                $result = pg_query($query);

                if (pg_num_rows($result)!=0){
                    echo "<br>"; 
                    echo "<h3>Job Description ".$jobTitle." </h3> <br>";
                    echo "<table class='table table-striped table-bordered'>"; 
                    echo "<thead>";
                    echo "<th>#</th>";
                    echo "<th>Job Description</th>";
                    echo "</thead>";
                    echo "<tbody>"; 
                       
                        $count=0;
                        while($value = pg_fetch_array($result)){
                            $count++;
                            echo "<td align='left'>".$count."</td>";
                            echo "<td align='left'>".$value['jobdesc']."</td>";
                            echo "</tr>";
                           }
                        
                    echo "</tbody>";  
                    echo "</table>";
               
            }
            else {
                    echo "<h3>Job Description ".$jobTitle." tidak ditemukan</h3> <br>";
            }


            }

            echo Html::a(Yii::t('app', 'Print'), ['print', 'jobTitle' => $jobTitle ], ['class' => 'btn btn-success']);

        ?>



</div>

