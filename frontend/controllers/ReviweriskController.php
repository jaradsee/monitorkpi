<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Reviwerisk;
use frontend\models\ReviweriskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Priskhead;
use frontend\models\PriskheadSearch;
use yii\base\Model;
/**
 * ReviweriskController implements the CRUD actions for Reviwerisk model.
 */
class ReviweriskController extends Controller
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
     * Lists all Reviwerisk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviweriskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reviwerisk model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
     {
      $model = $this->findModel($id);
      $modelPriskheads = $this->findModelPriskheads($model->reviwerisk_id);
        return $this->render('view', [
            'model' => $model,
            'modelPriskheads'=> $modelPriskheads
        ]);
    }
            
            /*{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reviwerisk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
{
    $modelReviwerisks = new Reviwerisk();
    $modelPriskheads = new Priskhead();

    if($modelReviwerisks->load(Yii::$app->request->post()) &&
       $modelPriskheads->load(Yii::$app->request->post()) &&
       Model::validateMultiple([$modelReviwerisks,$modelPriskheads]))
    {
        if($modelReviwerisks->save()){
          $modelReviwerisks->reviwerisk_id = $modelPriskheads->risk_id;
          $modelReviwerisks->save();
        }
        return $this->redirect(['view', 'id' => $modelReviwerisks->reviwerisk_id]);
    } else {
        return $this->render('create', [
            'model' => $modelReviwerisks,
            'modelPriskheads'=>$modelPriskheads
        ]);
    }
}
    
    /**public function actionCreate()
    {
        $model = new Reviwerisk();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->reviwerisk_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Reviwerisk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */

/**public function actionUpdate($id)
{
    $model = $this->findModel($id);
    $modelPriskheads = $this->findModelPriskheads($model->reviwerisk_id);

    if (
    $model->load(Yii::$app->request->post()) &&
    $modelPriskheads->load(Yii::$app->request->post()) &&
    Model::validateMultiple([$model,$modelPriskheads])
    ) {
        if($modelPriskheads->save()){
          $model->save();
        }
        return $this->redirect(['view', 'id' => $model->reviwerisk_id]);
    } else {
        return $this->render('update', [
          'model' => $model,
          'modelPriskheads'=>$modelPriskheads
        ]);
    }
}
 * */
 
public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && 
                $model->save()) {
            return $this->redirect(['view', 'id' => $model->reviwerisk_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

   /** public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->reviwerisk_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reviwerisk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reviwerisk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Reviwerisk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reviwerisk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModelPriskheads($id)
    {
        if (($model = Priskhead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
