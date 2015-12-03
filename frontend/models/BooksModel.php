<?php



namespace app\models;

use DateTime;
use frontend\models\AuthorModel;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class BooksModel extends \yii\db\ActiveRecord
{
    public $imageFile;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author_id'], 'required'],
            [['date'], 'safe'],
            [['author_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'preview'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'preview' => 'Preview',
            'date' => 'Date',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload()
    {
        if ($this->validate() && $this->imageFile) {
            $dir = \Yii::getAlias('@frontend/web/image');
            $file = md5($this->imageFile->baseName+time()) . '.' . $this->imageFile->extension;
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            $this->imageFile->saveAs($path);
            $this->imageFile = null;

            return $file;
        } else {
            return false;
        }
    }

    public function getAuthor()
    {
        return self::hasOne(AuthorModel::className(), ['id' => 'author_id']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeValidate($insert)) {
            $objDate = DateTime::createFromFormat ('m/d/Y', $this->date);
            $this->date = $objDate->format('Y-m-d h:i:s');
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            if ($file = $this->upload()) {
                $this->preview = $file;
            }

            return true;
        } else {
            return false;
        }
    }
}
