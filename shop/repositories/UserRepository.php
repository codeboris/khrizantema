<?php


namespace shop\repositories;


use RuntimeException;
use shop\entities\User\User;
use yii\db\ActiveRecord;


class UserRepository
{
    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }
    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or',['username' => $value], ['email' => $value]])->one();
    }

    public function get($id): ?User
    {
        return $this->getBy(['id' => $id]);
    }

    public function getByEmailConfirmToken($token):User
    {
        return $this->getBy(['verification_token' => $token]);
    }

    public function getByEmail($email):User
    {
        return $this->getBy(['email' => $email]);
    }

    public function existsByPasswordResetToken(string $token):bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function getByPasswordResetToken($token):User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function save(User $user):void
    {
        if (!$user->save()){
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param array $condition
     * @return array|User|ActiveRecord
     */
    private function getBy(array $condition):?User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()){
            //\Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
            //throw new NotFoundException('Вы не авторизованы. Войдите или зарегистрируйтесь.');
            \Yii::$app->session->setFlash('error', 'Вы не зарегистрированы. Только зарегистрированые пользователи могут отслеживать исполнение заказа.');
            //return $user;
        }

        return $user;
    }

}