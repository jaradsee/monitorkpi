<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Bmitest;
use frontend\models\BmitestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\models\Uploadsf;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use mPDF;

/**
 * BmitestController implements the CRUD actions for Bmitest model.
 */
class BmitestController extends Controller
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
     * Lists all Bmitest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BmitestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bmitest model.
     * @param integer $id
     * @param string $cid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $cid)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $cid),
        ]);
    }
    public function actionGenPdf($id,$cid)
    {
        $pdf_content = $this->renderPartial('view-pdf', [
            'model' => $this->findModel($id,$cid),
        ]);

        $mpdf = new \mPDF('th', 'A4', '0', 'Garuda');
        $mpdf->WriteHTML($pdf_content);
        $mpdf->Output();
        exit;
    }


    /**
     * Creates a new Bmitest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        $model = new Bmitest();

        if ($model->load(Yii::$app->request->post()) ) {

            $this->Uploadsf(false);
            $this->CreateDir($model->ref);


            if($model->save()){

                 return $this->redirect(['view', 'id' => $model->id, 'cid' => $model->cid]);
            }

        } else {
             $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        }

        return $this->render('create', [
            'model' => $model,

        ]);

    }


    /**
     * Updates an existing Bmitest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $cid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $cid)
    {
        $model = $this->findModel($id, $cid);

        list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

          $this->Uploadsf(false);
          $this->CreateDir($model->ref);
            return $this->redirect(['view', 'id' => $model->id, 'cid' => $model->cid]);
        }

        return $this->render('update', [
            'model' => $model,
            'initialPreview'=>$initialPreview,
            'initialPreviewConfig'=>$initialPreviewConfig
        ]);
    }

    /**
     * Deletes an existing Bmitest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $cid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $cid)
    {
        $this->findModel($id, $cid)->delete();
        $this->removeUploadDir($model->ref);
        Uploadsf::deleteAll(['ref'=>$model->ref]);
        $this->removeUploadDir($model->ref);
        Uploadsf::deleteAll(['ref'=>$model->ref]);
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionPdf($id, $cid)

{

    $mpdf = new mPDF('th', 'A4', '0', 'Garuda'); // ขนาด A4 font Garuda
$mpdf->useOnlyCoreFonts = true;$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list// LOAD a stylesheet$stylesheet = file_get_contents('mpdfstyletables.css');

    $mpdf->WriteHTML($this->renderPartial('_reportView')); // หน้า View สำหรับ export

    $mpdf->Output();

    exit();
  }


    /**
     * Finds the Bmitest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $cid
     * @return Bmitest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $cid)
    {
        if (($model = Bmitest::findOne(['id' => $id, 'cid' => $cid, ])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /*|*********************************************************************************|
    |================================ Upload Ajax ====================================|
    |*********************************************************************************|*/

    public function actionUploadAjax(){
           $this->Uploadsf(true);
     }

    private function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = Bmitest::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(Bmitest::getUploadPath().$dir);
    }

    private function Uploadsf($isAjax=false) {
             if (Yii::$app->request->isPost) {
                $images = UploadedFile::getInstancesByName('upload_ajax');
                if ($images) {

                    if($isAjax===true){
                        $ref =Yii::$app->request->post('ref');
                    }else{
                        $Bmitest = Yii::$app->request->post('Bmitest');
                        $ref = $Bmitest['ref'];
                    }

                    $this->CreateDir($ref);

                    foreach ($images as $file){
                        $fileName       = $file->baseName . '.' . $file->extension;
                        $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                        $savePath       = Bmitest::UPLOAD_FOLDER.'/'.$ref.'/'. $realFileName;
                        if($file->saveAs($savePath)){

                            if($this->isImage(Url::base(true).'/'.$savePath)){
                                 $this->createThumbnail($ref,$realFileName);
                            }

                            $model                  = new Uploadsf;
                            $model->ref             = $ref;
                            $model->file_name       = $fileName;
                            $model->real_filename   = $realFileName;
                            $model->save();

                            if($isAjax===true){
                                echo json_encode(['success' => 'true']);
                            }

                        }else{
                            if($isAjax===true){
                                echo json_encode(['success'=>'false','eror'=>$file->error]);
                            }
                        }

                    }
                }
            }
    }

    private function getInitialPreview($ref) {
            $datas = Uploadsf::find()->where(['ref'=>$ref])->all();
            $initialPreview = [];
            $initialPreviewConfig = [];
            foreach ($datas as $key => $value) {
                array_push($initialPreview, $this->getTemplatePreview($value));
                array_push($initialPreviewConfig, [
                    'caption'=> $value->file_name,
                    'width'  => '120px',
                    'url'    => Url::to(['/bmitest/deletefile-ajax']),
                    'key'    => $value->upload_id
                ]);
            }
            return  [$initialPreview,$initialPreviewConfig];
    }

    public function isImage($filePath){
            return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploadsf $model){
            $filePath = Bmitest::getUploadUrl().$model->ref.'/thumbnail/'.$model->real_filename;
            $isImage  = $this->isImage($filePath);
            if($isImage){
                $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
            }else{
                $file =  "<div class='file-preview-other'> " .
                         "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                         "</div>";
            }
            return $file;
    }

    private function createThumbnail($folderName,$fileName,$width=150){
      $uploadPath   = Bmitest::getUploadPath().'/'.$folderName.'/';
      $file         = $uploadPath.$fileName;
      $image        = Yii::$app->image->load($file);
      $image->resize($width);
      $image->save($uploadPath.'thumbnail/'.$fileName);
      return;
    }

    public function actionDeletefileAjax(){

        $model = Uploadsf::findOne(Yii::$app->request->post('key'));
        if($model!==NULL){
            $filename  = Bmitest::getUploadPath().$model->ref.'/'.$model->real_filename;
            $thumbnail = Bmitest::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
            if($model->delete()){
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success'=>true]);
            }else{
                echo json_encode(['success'=>false]);
            }
        }else{
          echo json_encode(['success'=>false]);
        }

    }
  }
