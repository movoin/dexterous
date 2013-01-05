<?php
/**
 * This is the template for generating a model class file.
 * The following variables are available in this template:
 * - $className: the class name
 * - $tableName: the table name
 * - $columns: a list of table column schema objects
 * - $rules: a list of validation rules (string)
 * - $labels: a list of labels (column name => label)
 * - $relations: a  list of relations (string)
 */
?>
<?php echo "<?php\n"; ?>
/**
 * This is the model class for table "<?php echo $tableName; ?>".
 *
 * The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
 */
class <?php echo $className; ?> extends DexModel
{
    /**
     * Returns the static model of the specified AR class.
     * @return <?php echo $className; ?> the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '<?php echo $tableName; ?>';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
<?php foreach($rules as $rule): ?>
            <?php echo $rule.",\n"; ?>
<?php endforeach; ?>


            array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
<?php foreach($relations as $name=>$relation): ?>
            <?php echo "'$name' => $relation,\n"; ?>
<?php endforeach; ?>
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
<?php foreach($labels as $column=>$label): ?>
            <?php echo "'$column' => '$label',\n"; ?>
<?php endforeach; ?>
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

<?php
foreach($columns as $name=>$column)
{
    if($column->type==='string')
    {
        echo "        \$criteria->compare('$name', \$this->$name, true);\n";
    }
    else
    {
        echo "        \$criteria->compare('$name', \$this->$name);\n";
    }
}
?>

        return new CActiveDataProvider('<?php echo $className; ?>', array(
            'criteria' => $criteria,
        ));
    }
}
