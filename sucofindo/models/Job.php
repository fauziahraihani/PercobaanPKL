<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property string $idjob
 * @property string $jobtitle
 * @property string $jobdesc
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjob'], 'required'],
            [['idjob'], 'string', 'max' => 25],
            [['jobtitle', 'jobdesc'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idjob' => Yii::t('app', 'Idjob'),
            'jobtitle' => Yii::t('app', 'Jobtitle'),
            'jobdesc' => Yii::t('app', 'Jobdesc'),
        ];
    }
}
