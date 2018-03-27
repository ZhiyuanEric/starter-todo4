<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Task
 *
 * @author Owner
 */
class Task extends Entity {

    //put your code here
    private $task;
    private $priority;
    private $size;
    private $group;
    private $deadline;
    private $status;
    private $flag;

    public function __get($key) {
        return $this->$key;
    }

    public function setTask($value) {
        if (empty($value)) {
            throw new InvalidArgumentException('Task must have value');
        }
        if (strlen($value) > 64) {
            throw new InvalidArgumentException('Task must be within limit');
        }
        $this->task = $value;
        return $this;
    }

    public function setPriority($value) {
        if (empty($value)) {
            throw new InvalidArgumentException('Priority must have a value');
        }
        if ($value > 3 || $value < 1) {
            throw new InvalidArgumentException('Priority must be between 1 and 3');
        }
        $this->priority = $value;
        return $this;
    }

    public function setSize($value) {
        if (empty($value)) {
            throw new InvalidArgumentException('Size must have value');
        }
        if ($value > 3 || $value < 1) {
            throw new InvalidArgumentException('Size must be between 1 and 3');
        }
        $this->size = $value;
        return $this;
    }

    public function setGroup($value) {
        if (empty($value)) {
            throw new InvalidArgumentException('Group must have value');
        }
        if ($value > 4 || $value < 1) {
            throw new InvalidArgumentException('Group must be between 1 and 4');
        }
        $this->group = $value;
        return $this;
    }

    public function setDeadline($value) {
        $this->deadline = $value;
        return $this;
    }

    public function setStatus($value) {
        $this->status = $value;
        return $this;
    }

    public function setFlag($value) {
        $this->flag = $value;
        return $this;
    }

}
