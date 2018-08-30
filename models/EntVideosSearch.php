<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EntVideos;

/**
 * EntVideosSearch represents the model behind the search form of `app\models\EntVideos`.
 */
class EntVideosSearch extends EntVideos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_video', 'id_concurso', 'b_habilitado'], 'integer'],
            [['txt_nombre', 'txt_url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EntVideos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_video' => $this->id_video,
            'id_concurso' => $this->id_concurso,
            'b_habilitado' => $this->b_habilitado,
        ]);

        $query->andFilterWhere(['like', 'txt_nombre', $this->txt_nombre])
            ->andFilterWhere(['like', 'txt_url', $this->txt_url]);

        return $dataProvider;
    }
}
