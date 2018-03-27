<?php

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TaskListTest extends TestCase {

    private $CI;
    //private $task;

    function setUp() {
        $this->CI = &get_instance();
        $this->CI->load->model('task');
        //$this->task = new Task();
    }

    function testCompletedTasks() {
        $completed = 0;
        $size = $this->CI->tasks->size();
        $data = $this->CI->tasks->all();
        foreach ($data as $task) {
            if (!empty($task->status) && $task->status == 2) {
                $completed++;
            }
        }
        $this->assertTrue($completed < $size / 2);
    }

}
