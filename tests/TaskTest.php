<?php

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaskTest
 *
 * @author Owner
 */
class TaskTest extends TestCase {

    //put your code here
    private $CI;
    private $task;

    function setUp() {
        $this->CI = &get_instance();
        $this->CI->load->model('task');
        $this->task = new Task();
    }

    function testEmptyTask() {
        $this->expectException('InvalidArgumentException');
        $this->task->task = null;
    }

    function testLongTask() {
        $badValue = ' ';
        //str_pad($badValue, 64, ' ');
        for ($i = 0; $i < 64; $i++) {
            $badValue .= ' ';
        }
        $this->expectException('InvalidArgumentException');
        $this->task->task = $badValue;
    }

    function testGoodTask() {
        $this->task->task = 'good';
        $this->assertEquals('good', $this->task->task);
    }

    function testEmptyPriority() {
        $this->expectException('InvalidArgumentException');
        $this->task->priority = null;
    }

    function testHighPriority() {
        $this->expectException('InvalidArgumentException');
        $this->task->priority = 4;
    }

    function testLowPriority() {
        $this->expectException('InvalidArgumentException');
        $this->task->priority = 0;
    }

    function testGoodPriority() {
        $this->task->priority = 1;
        $this->assertEquals(1, $this->task->priority);
    }

    function testEmptySize() {
        $this->expectException('InvalidArgumentException');
        $this->task->size = null;
    }
    
    function testHighSize() {
        $this->expectException('InvalidArgumentException');
        $this->task->size = 4;
    }

    function testLowSize() {
        $this->expectException('InvalidArgumentException');
        $this->task->size = 0;
    }

    function testGoodSize() {
        $this->task->size = 1;
        $this->assertEquals(1, $this->task->size);
    }

    function testEmptyGroup() {
        $this->expectException('InvalidArgumentException');
        $this->task->group = null;
    }
    
    function testHighGroup() {
        $this->expectException('InvalidArgumentException');
        $this->task->group = 5;
    }

    function testLowGroup() {
        $this->expectException('InvalidArgumentException');
        $this->task->group = 0;
    }

    function testGoodGroup() {
        $this->task->group = 1;
        $this->assertEquals(1, $this->task->group);
    }

}
