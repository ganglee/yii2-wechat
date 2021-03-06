<?php

namespace callmez\wechat\modules\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use callmez\wechat\models\Fans;
use callmez\wechat\models\CustomMessage;
use callmez\wechat\modules\admin\models\FansSearch;
use callmez\wechat\modules\admin\components\Controller;
use callmez\wechat\modules\admin\models\MessageHistorySearch;

/**
 * FansController implements the CRUD actions for Fans model.
 */
class FansController extends Controller
{
    /**
     * Lists all Fans models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FansSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['wid' => $this->getWechat()->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Fans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 粉丝发送消息
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionMessage($id)
    {
        $fans = $this->findModel($id);
        $searchModel = new MessageHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC]
        ];
        $dataProvider->query->andWhere([
            'open_id' => $fans->open_id,
            'wid' => $this->getWechat()->id,
        ]);
        $model = new CustomMessage();
        return $this->render('message', [
            'fans' => $fans,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Fans model.
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
     * Finds the Fans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $query = Fans::find()
            ->andWhere([
                'id' => $id,
                'wid' => $this->getWechat()->id
            ]);
        if (($model = $query->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
