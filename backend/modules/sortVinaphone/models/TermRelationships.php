<?php

namespace backend\modules\sortVinaphone\models;

use Yii;

/**
 * This is the model class for table "tbl_term_relationships".
 *
 * @property string $object_id
 * @property string $term_taxonomy_id
 * @property integer $term_order
 */
class TermRelationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_term_relationships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'term_taxonomy_id'], 'required'],
            [['object_id', 'term_taxonomy_id', 'term_order'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'object_id' => 'Object ID',
            'term_taxonomy_id' => 'Term Taxonomy ID',
            'term_order' => 'Term Order',
        ];
    }
}
