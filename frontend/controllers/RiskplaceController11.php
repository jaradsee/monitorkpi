<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Riskplace;
use frontend\models\RiskplaceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Adddep;
use frontend\models\AdddepSearch;
use yii\base\Model;
/**
 * RiskplaceController implements the CRUD actions for Riskplace model.
 */
class RiskplaceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Riskplace models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RiskplaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Riskplace model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Riskplace model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelPlace = new Riskplace();
        $modelDep = new Adddep();

        if ($modelPlace->load(Yii::$app->request->post()) && 
           $modelDep->load(Yii::$app->request->post()) &&
       Model::validateMultiple([$modelPlace,$modelDep]))
        {
            if($modelDep->save()){
          $modelPlace->PLACE_ID = $modelDep->ADDDEP_ID;
          $modelPlace->save();
        }   
        return $this->redirect(['view', 'id' => $modelPlace->PLACE_ID]);
        
            }
            else {
            return $this->render('create', [
            'model' => $modelPlace,
            'modelDep'=>$modelDep
        ]);
        }
    }

    /**
     * Updates an existing Riskplace model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
   public function actionUpdate($id)
{
    $model = $this->findModel($id);
    $modelDep = $this->findModelDep($model->ADDDEP_ID);

    if (
    $model->load(Yii::$app->request->post()) &&
    $modelDep->load(Yii::$app->request->post()) &&
    Model::validateMultiple([$model,$modelDep])
    ) {
        if($modelDep->save()){
          $model->save();
        }
        return $this->redirect(['view', 'id' => $model->PLACE_ID]);
    } else {
        return $this->render('update', [
          'model' => $model,
          'modelDep'=>$modelDep
        ]);
    }
}



    /**
     * Deletes an existing Riskplace model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Riskplace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Riskplace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Riskplace::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
    }
}
