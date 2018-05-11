<?php

namespace backend\modules\sortMobifone\models;

use Yii;

/**
 * This is the model class for table "tbl_term_taxonomy".
 *
 * @property string $term_taxonomy_id
 * @property string $term_id
 * @property string $taxonomy
 * @property string $description
 * @property string $parent
 * @property string $count
 */
class TermTaxonomyMobi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_term_taxonomy';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['term_id', 'parent', 'count'], 'integer'],
            [['description'], 'required'],
            [['description'], 'string'],
            [['taxonomy'], 'string', 'max' => 32],
            [['term_id', 'taxonomy'], 'unique', 'targetAttribute' => ['term_id', 'taxonomy'], 'message' => 'The combination of Term ID and Taxonomy has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'term_taxonomy_id' => 'Term Taxonomy ID',
            'term_id' => 'Term ID',
            'taxonomy' => 'Taxonomy',
            'description' => 'Description',
            'parent' => 'Parent',
            'count' => 'Count',
        ];
    }
}
