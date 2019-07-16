<?php

namespace app\controllers;

use app\models\LogModel;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\helpers\ArrayHelper;

use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Product;
use app\models\LogsModel;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
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

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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

    /**
     * 提供接口专用测试.
     *
     * @return json
     */
    public function actionData()
    {
        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        return json_encode($arr);

    }

    public function actionData2()
    {
        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        return json_encode($arr);

    }

    /**
     * 提供接口专用测试.
     *
     * @return json
     */
    public function actionGetinfo()
    {
        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        return json_encode($arr);

    }

    /**
     * 提供接口专用测试.
     *
     * @return json
     */
    public function actionGetname()
    {
        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        return json_encode($arr);

    }

    /**
     * 提供接口专用测试.
     *
     * @return json
     */
    public function actionGetsome()
    {
        $arr = array(
            'Name'=>'希亚',
            'Age'=>20
        );
        $jsonencode = json_encode($arr);
        return $jsonencode;

    }

    public function actionGetspecial()
    {
        // the name and value must be enclosed in double quotes
        // single quotes are not valid
        $json = "{ 'bar': 'baz' }";
        $data = json_decode($json); // null
        var_dump($data);

    }

    public function actionSession()
    {
//        session_start();
        $_SESSION['name'] = 'jgl';
        var_dump(session_name());
        echo "<br>";
        var_dump(session_id());
        echo "<br>";
        var_dump(session_get_cookie_params());
        echo "<pre>";

        var_dump(session_get_cookie_params());
        exit();
    }

    public function actionGetinfo2()
    {
        session_start();
//        $_SESSION['name'] = 'jgl';
        var_dump(session_name());
        echo "<br>";
        var_dump(session_id());
//        echo "<br>";
//        var_dump(session_get_cookie_params());
//        echo "<pre>";

//        var_dump(session_get_cookie_params());
        exit();
    }
    public function actionQueryproduct()
    {
        // the following will retrieve the user 'CeBe' from the database
        // $products = Product::find()->where(['id' => 1])->one();
        $keywords = Yii::$app->request->get('keywords');



        $model = Product::find()
        ->where("name like :keywords")
        ->addParams([':keywords'=>'%'.$keywords.'%'])
        ->asArray()
        ->all();

        $type = '未分类';
        if(count($model)>0){
            $type = $model[0]['type'];
        }
        Yii::$app->db->createCommand()->insert('logs',['name'=>$keywords,'type'=>$type])->execute();

        $data = array(
            'code' => 0,
            'message' => '',
            'result' => $model
        );

        $json = json_encode($data);
        return $json;
    }
    public function actionQuerybyid()
    {
        // the following will retrieve the user 'CeBe' from the database
        // $products = Product::find()->where(['id' => 1])->one();
        $id = Yii::$app->request->get('id');

        $model = Product::find()
        ->where(['id' => $id])
        ->asArray()
        ->one();
        $data = array(
            'code' => 0,
            'message' => '',
            'result' => $model
        );

        $json = json_encode($data);
        return $json;
    }  
    public function actionAddproduct()
    {
        // the following will retrieve the user 'CeBe' from the database
        // $products = Product::find()->where(['id' => 1])->one();
        $name = Yii::$app->request->get('name');
        $type = Yii::$app->request->get('type');

	    Yii::$app->db->createCommand()->insert('products',['name'=>$name,'type'=>$type])->execute();

        $data = array(
            'code' => 0,
            'message' => '',
            'result' => new \stdClass 
        );

        $json = json_encode($data);
        return $json;
    }
    public function actionGetproduct()
    {

        $model = LogsModel::find()
            ->orderBy('id DESC')
            ->limit(5)
            ->asArray()
            ->all();

        $data = array(
            'code' => 0,
            'message' => '',
            'result' => $model
        );

        $json = json_encode($data);
        return $json;
    }
    public function actionGetdata()
    {

        $data = Yii::$app->request->post();

        $obj= array(
            'code' => 0,
            'message' => '',
            'result' => $data
        );

        $json = json_encode($obj);
        return $json;
    }
}
