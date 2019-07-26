<?php

/**
 * Class User
 * @package models
 */
class User extends CActiveRecord {

    /**
     * Table
     *
     * @return string
     */
    public function tableName() {
        return 'users';
    }

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules() {
        return array(
            array('name, password', 'required'),
            array('email', 'email'),
            array('name, email, password', 'length', 'max' => 250),
            // Allowed attributes to be search()
            array('id, name, email', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Search in users table
     *
     * @return MSActiveDataProvider
     */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name);
        $criteria->compare('email', $this->email);
        return new MSActiveDataProvider($this, array(
            'criteria'   => $criteria,
        ));
    }

}