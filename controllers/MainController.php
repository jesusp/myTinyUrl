<?php

namespace app\controllers;

use Yii;
use app\models\TinyUrl;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MainController implements the CRUD actions for Url model.
 */
class MainController extends Controller
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
     * Creates a new Url model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new TinyUrl();
        $result = false;
        
        if ($model->load(Yii::$app->request->post())) {
            $tinyExist = TinyUrl::find()->where(['url' => $model->url])->one();
            if($tinyExist){
                  $result = "http://".Yii::$app->request->serverName."/".$tinyExist->tiny;
            }else{
                $model->tiny = $this->RandomString(rand (5,10));
                if($model->save()){
                    $result = "http://".Yii::$app->request->serverName."/".$model->tiny;
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
            'result'=>$result
        ]);
        
    }

    public function actionView($id){
         $tinyExist = TinyUrl::find()->where(['tiny' => $id])->one();
         $redirectURL = "/";
         if($tinyExist){
           $redirectURL = $tinyExist->url;
         }
        return $this->redirect($redirectURL);
    }

    function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
    {
        $source = 'abcdefghijklmnopqrstuvwxyz';
        if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if($n==1) $source .= '1234567890';
        if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
        if($length>0){
            $rstr = "";
            $source = str_split($source,1);
            for($i=1; $i<=$length; $i++){
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1,count($source));
                $rstr .= $source[$num-1];
            }
     
        }
        return $rstr;
    }
}
