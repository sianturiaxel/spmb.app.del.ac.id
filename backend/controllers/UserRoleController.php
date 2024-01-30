<?php

namespace backend\controllers;



use backend\models\UserRole;
use backend\models\Users;
use backend\models\Role;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserRoleController implements the CRUD actions for UserRole model.
 */
class UserRoleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all UserRole models.
     *
     * @return string
     */

    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => UserRole::find(),
            'sort' => [
                'defaultOrder' => ['user_id' => SORT_DESC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single UserRole model.
     * @param int $user_id User ID
     * @param int $role_id Role ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $role_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $role_id),
        ]);
    }

    /**
     * Creates a new UserRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserRole();
        $user = Users::find()->asArray()->all();
        $role = Role::find()->asArray()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'user_id' => $model->user_id, 'role_id' => $model->role_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
            'role' => $role,
        ]);
    }

    /**
     * Updates an existing UserRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $user_id User ID
     * @param int $role_id Role ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $role_id)
    {
        $model = $this->findModel($user_id, $role_id);
        $user = Users::find()->asArray()->all();
        $role = Role::find()->asArray()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'role_id' => $model->role_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'role' => $role,
        ]);
    }

    /**
     * Deletes an existing UserRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $user_id User ID
     * @param int $role_id Role ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $role_id)
    {
        $this->findModel($user_id, $role_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_id User ID
     * @param int $role_id Role ID
     * @return UserRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $role_id)
    {
        if (($model = UserRole::findOne(['user_id' => $user_id, 'role_id' => $role_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
