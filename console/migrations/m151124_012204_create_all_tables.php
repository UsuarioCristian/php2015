<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_012204_create_all_tables extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),            
            'name' => $this->string(20)->notNull(),
        ]);

        $this->createTable('product', [
            'id' => $this->primaryKey(),            
            'name' => $this->string(40)->notNull(),
            'category_id' => $this->integer(11),
            'image_path' => $this->string(200),
        ]);

        $this->createTable('commerce', [
            'id' => $this->primaryKey(),            
            'name' => $this->string(40)->notNull(),
            'lat' => $this->double(10),
            'long' => $this->double(10),
            'priority' => $this->boolean()->notNull(),
        ]);

        $this->createTable('employee', [
            'id' => $this->primaryKey(),            
            'name' => $this->string(40)->notNull(),
            'lat' => $this->double(10),
            'long' => $this->double(10),
            //'commerce_id' => $this->integer(11)->notNull(),
            'enable' => $this->boolean()->notNull(),
        ]);

        $this->createTable('route', [
            'id' => $this->primaryKey(),            
            'employee_id' => $this->integer(11)->notNull(),
            'date' => $this->date(),
        ]);

        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'quantity' => $this->integer(10)->notNull(),            
            'commerce_id' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),            
        ]);

        $this->createTable('commerce_product', [                        
            'commerce_id' => $this->integer(11),
            'product_id' => $this->integer(11),
            'stock' => $this->integer(10),
            'sold' => $this->integer(10),
            'PRIMARY KEY(commerce_id, product_id)',            
        ]);

        $this->createTable('route_commerce', [                        
            'route_id' => $this->integer(11),
            'commerce_id' => $this->integer(11),
            'position' => $this->integer(4),
            'PRIMARY KEY(commerce_id, route_id)',            
        ]);

        $this->createTable('commerce_employee', [                        
            'commerce_id' => $this->integer(11),
            'employee_id' => $this->integer(11),
            'PRIMARY KEY(commerce_id, employee_id)',            
        ]);

        $this->createIndex('inx-category_id','category','id');
        $this->addForeignKey('fk-category-product-category_id', 'product', 'category_id', 'category', 'id', 'RESTRICT','CASCADE');

        $this->createIndex('inx-commerce_id','commerce','id');
        //$this->addForeignKey('fk-commerce-employee-commerce_id', 'employee', 'commerce_id', 'commerce', 'id', 'RESTRICT','CASCADE');
        $this->addForeignKey('fk-commerce-oreder-commerce_id', 'order', 'commerce_id', 'commerce', 'id', 'RESTRICT','CASCADE');
        $this->addForeignKey('fk-commerce-commerce_product-commerce_id', 'commerce_product', 'commerce_id', 'commerce', 'id', 'RESTRICT','CASCADE');
        $this->addForeignKey('fk-commerce-route_commerce-commerce_id', 'route_commerce', 'commerce_id', 'commerce', 'id', 'RESTRICT','CASCADE');
        $this->addForeignKey('fk-commerce-commerce_employee-commerce_id', 'commerce_employee', 'commerce_id', 'commerce', 'id', 'RESTRICT','CASCADE');

        $this->createIndex('inx-employee_id','employee','id');
        $this->addForeignKey('fk-employe-route-employee_id', 'route', 'employee_id', 'employee', 'id', 'RESTRICT','CASCADE');
        $this->addForeignKey('fk-employe-commerce_employee-employee_id', 'commerce_employee', 'employee_id', 'employee', 'id', 'RESTRICT','CASCADE');

        $this->createIndex('inx-product_id','product','id');
        $this->addForeignKey('fk-product-order-product_id', 'order', 'product_id', 'product', 'id', 'RESTRICT','CASCADE');
        $this->addForeignKey('fk-product-commerce_product-product_id', 'commerce_product', 'product_id', 'product', 'id', 'RESTRICT','CASCADE');

        $this->createIndex('inx-route_id','route','id');
        $this->addForeignKey('fk-route-route_commerce-route_id', 'route_commerce', 'route_id', 'route', 'id', 'RESTRICT','CASCADE');



    }

    public function down()
    {
        echo "m151124_012204_create_all_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
