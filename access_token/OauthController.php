<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2017/2/13
 * Time: 10:07
 */

namespace app\controllers;

use Yii;
use app\helpers\Common;
use app\helpers\Image;
use app\models\City;
use app\models\Province;
use app\models\User;
use app\models\UserProfile;
use yii\helpers\Url;
use yii\web\Controller;

class OauthController extends Controller
{
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback']
            ]
        ];
    }

    /*
     * 第三方登录
     * 1、已登录，账号不一致，清除cookie，跳☞绑定页
     * 2、已登录，账号一直，则登录
     * 3、亿登录，未绑定第三方，则直接绑定，跳至用户中心绑定也没
     * 4、未登录，以存在手机号及第三方id直接登录
     * 5、未登录，存在第三方id，手机号没绑定及不存在二者情况，跳至绑定页
     *
     * QQ图片未经测试，微信图片储存avatar
     * **/
    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        $clientId = $client->getId();
        $cookie = Yii::$app->request->cookies;

        $where = [];
        $type = '';
        if ($clientId == 1) {
            $where['qq_open_id'] = $attributes['openid'];
            $type = 'qq_open_id';
        } elseif ($clientId == 2) {
            $where['wx_union_id'] = $attributes['unionid'];
            $type = 'wx_union_id';
        }

        if (empty($where)) {
            return $this->redirect(Url::to(['/ucenter/passport/login']));
        }


        $userInfo = User::findOne($where);
        $cookieUserId = $cookie->getValue('users');
        if ($cookieUserId) {
            if (!empty($userInfo)) {
                if ($userInfo['id'] === $cookieUserId) {
                    return $this->redirect(Url::to(['/ucenter/default/index']));
                } else {
                    setcookie("users", null, time() - 1000, "/", DOMAIN);
                    return $this->redirect(Url::to(['/ucenter/passport/login', $type => $where[$type], 'uid' => $userInfo['id']]));
                }
            } else {
                $userModel = User::findOne($cookieUserId);
                if ($clientId == 1) {
                    $userModel->qq_open_id = $attributes['openid'];
                } elseif ($clientId == 2) {
                    $userModel->wx_union_id = $attributes['unionid'];
                    $userProfile = new UserProfile();
                    $userProfile->updateWechatNickname($cookieUserId, $attributes['nickname']);
                }
                $userModel->save();
                return $this->redirect(Url::to(['/ucenter/account/bind']));
            }
        } else {
            if (!empty($userInfo) && $userInfo['phone']) {
                \Yii::$app->user->login($userInfo);
                Common::setLoginCookie($userInfo['id']);

                return $this->redirect(Url::to(['/ucenter/default/index']));
            }elseif(!empty($userInfo) && !$userInfo['phone']){
                return $this->redirect(Url::to(['/ucenter/passport/login', $type => $where[$type], 'uid' => $userInfo['id']]));
            } else {
                $model = new User();
                $model->nick_name = $attributes['nickname'] . '_' . rand(1000, 9999);
                $model->generateToken();
                $model->status = User::STATUS_NORMAL;
                $model->role = User::ROLE_NORMAL;
                $model->source = Common::isMobile() ? User::SOURCE_WAMP : User::SOURCE_PC;
                if ($clientId == 1) {
                    $model->qq_open_id = $attributes['openid'];
                } elseif ($clientId == 2) {
                    $model->wx_union_id = $attributes['unionid'];
                }
                $model->created_at = time();
                //qq头像
                if (isset($attributes['avatar']) && !empty($attributes['avatar'])) {
                    $newName = Image::generateName() . '.jpg';
                    $filePath = Image::getImageFullPath($newName, Image::TYPE_AVATAR, 'org');//原图路径
                    $dir = dirname($filePath);
                    !is_dir($dir) && mkdir($dir, 0777, true);
                    file_put_contents($filePath, file_get_contents($attributes['avatar']));
                    Image::createIconImage($filePath, Image::TYPE_QRCODE, $newName);
                    $model->avatar = $newName;
                }elseif (isset($attributes['headimgurl']) && $attributes['headimgurl']) {
                    $model->avatar = $attributes['headimgurl'];
                }

                if ($model->save()) {
                    $userProfile = new UserProfile();
                    $userProfile->user_id = $model['id'];
                    if (isset($attributes['province']) && isset($attributes['city']) && !empty($attributes['province']) && !empty($attributes['city'])) {
                        $province = Province::findOne(['name' => $attributes['province']]);
                        $city = City::findOne(['name' => $attributes['city']]);
                        if ($province && $city) {
                            $userProfile->province = $province['id'];
                            $userProfile->city = $city['id'];
                        }
                    }

                    if ($clientId == 2) {
                        $userProfile->sex = (isset($attributes['sex']) && $attributes['sex'] ) ? $attributes['sex'] : 0;
                        $userProfile->wx_account = $attributes['nickname'];
                    }

                    if (isset($attributes['gender']) && !empty($attributes['gender'])) {
                        $userProfile->sex = $attributes['gender'] == '女' ? UserProfile::SEX_FEMALE : UserProfile::SEX_MALE;
                    }

                    $userProfile->save();
                    \Yii::$app->user->login($model);
                    Common::setLoginCookie($model['id']);

                    return $this->redirect(Url::to(['/ucenter/passport/login', $type => $where[$type], 'uid' => $model['id']]));
                }
            }
        }
    }
}