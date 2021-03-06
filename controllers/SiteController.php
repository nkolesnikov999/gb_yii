<?php

namespace app\controllers;

use app\models\Emails;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\Product;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            // Закеширована страница Контакты
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['contact'],
                'duration' => 60,
                'variations' => [
                    \Yii::$app->language,
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
    
    public function actionRus()
    {
        Yii::$app->language = 'ru';
        return $this->render('index');
    }

    public function actionEng()
    {
        Yii::$app->language = 'en';
        return $this->render('index');
    }

    public function actionProducts()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->orderBy('name'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('products', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //Закеширована цена в детаил продуктов
        $model = $this->findModel($id);
        $cache = \Yii::$app->cache;
        //$cache->flush();

        $keyPrice = 'price' . $id;
        $price = $cache->get($keyPrice);
        if (!$price) {
            $cache->set($keyPrice, $model->price, 60);
        } else {
            $model->price = $price;
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new RegisterForm();
        $emailModel = new Emails();
        $model->on(RegisterForm::EVENT_REGISTER, [$emailModel, 'saveEmail']);

        if ($model->load(Yii::$app->request->post()) && $model->register()) {

            return $this->goBack();
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('register', ['model' => $model]);
        }

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
