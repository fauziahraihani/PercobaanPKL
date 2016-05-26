<?php

namespace app\controllers;

use Yii;
use app\models\Job;
use app\models\JobSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Job models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionIndex2()
    {
        return $this->render('index2');
    }

    /**
     * Displays a single Job model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Job();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idjob]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionPrint()
    {  

        ini_set('memory_limit','3000M');//extending php memory
        $pdf=new mPDF('win-1252','A4','','',15,10,16,10,10,10);//A4 size page in landscape orientation
        date_default_timezone_set("Asia/Bangkok");
        $pdf->SetHeader(date('H:i:s'));
        $pdf->setFooter('{PAGENO}');
        $pdf->useOnlyCoreFonts = true;    // false is default
        $pdf->SetDisplayMode('fullpage');
       
        ob_start();
 
        include "../views/job/_jobDesc.php";//The php page you want to convert to pdf
        
        $html = ob_get_contents();

        ob_end_clean();

        // send the captured HTML from the output buffer to the mPDF class for processing

        $pdf->WriteHTML($html);
        //$mpdf->SetProtection(array(), 'mawiahl', 'password');//for password protecting your pdf

            // return the pdf output as per the destination setting
             $pdf->Output(); 
    }

    public function actionPrint2()
    {
        $content = $this->renderPartial('_reportView');
        $pdf = new mPDF();
        $pdf->WriteHTML('CONGRATSS');
        $pdf->Output(); 

    }

    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idjob]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Job model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
