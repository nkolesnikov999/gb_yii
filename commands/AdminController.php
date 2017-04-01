<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Emails;
use app\models\Currency;
use app\models\Product;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */

    public $message = "I glad to see you!!!";
    public $path = "commands/price.txt";


    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    /**
     * This command sends emails to users from table Emails.
     */

    public function actionMail()
    {
        $users = Emails::find()->all();

        foreach($users as $user)
        {
            $text = "Hi " . $user->username . "\n" . $this->message;

            Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom('nk@nkpro.net')
                ->setSubject('TEST')
                ->setTextBody($text)
                ->send();
            echo "Email to " . $user->username . " was sent\n";
        }
    }

    /**
     * This command updates prices in table Products.
     */

    public function actionPrice()
    {
        $content = file_get_contents($this->path);
        $stringArray = explode("\n", $content);
        foreach($stringArray as $raw) {
            $priceArray = explode(";", $raw);
            if(count($priceArray) >= 2) 
            {
                Product::updatePrices($priceArray);
            }
        }
        echo "The end\n";
    }

    /**
     * This command saves Exchange Rates in table Currency.
     */

    public function actionCurrency()
    {
        $file = file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp');

        if($file)
        {
            $parse = new \SimpleXMLElement($file);

            foreach($parse->Valute as $key => $value) {
                $data['code'] = (string) $value->CharCode;
                $data['value'] = (string) $value->Value;
                Currency::updateData($data);
            }
            echo "Data was saved \n";
        } else {
            echo "Data isn't available \n";
        }   
    }

    public function options($actionID)
    {
        return [
            'message',
            'path',
        ];
    }

    public function optionAliases()
    {
        return ['m' => 'message',
                'p' => 'path'];
    }
}
