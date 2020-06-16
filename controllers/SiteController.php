<?php

namespace app\controllers;

use app\components\LoanTools;
use app\models\CreditForm;
use app\models\Loan;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTakeLoan()
    {
        $model = new Loan();

        if($model->load(Yii::$app->request->post())) {
            $payments = LoanTools::getLoanTable($model->sum, $model->percent, $model->period);
            $model->payments = json_encode($payments);
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('take-loan', [
            'model' => $model
        ]);
    }

    /**
     * Displays loans page.
     *
     * @return string
     */
    public function actionLoans()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Loan::find()->orderBy(['created_at' => SORT_DESC])
        ]);

        return $this->render('loans', [
            'dataProvider' => $dataProvider
        ]);
    }


    /**
     * Displays single loan page.
     *
     * @return string
     */
    public function actionView($id)
    {
        $model = Loan::findOne($id);
        if(!$model) {
            throw new NotFoundHttpException('Что-то потерялось. Начните с главной.');
        }

        return $this->render('loan', [
            'model' => $model
        ]);
    }
}
