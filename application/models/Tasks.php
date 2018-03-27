<?php

class Tasks extends XML_Model {

    
    private $CI;

    public function __construct() {
        parent::__construct(APPPATH . '../data/tasks.xml', 'id');
         $this->CI = &get_instance(); // retrieve the CI instance
    }

    function getCategorizedTasks() {
        // extract the undone tasks
        foreach ($this->all() as $task) {
            if ($task->status != 2)
                $undone[] = $task;
        }
        // substitute the category name, for sorting
        foreach ($undone as $task)
            $task->group = $this->CI->app->group($task->group); // use CI to get at the app model

        // order them by category
        usort($undone, "orderByCategory");
        // convert the array of task objects into an array of associative objects       
        foreach ($undone as $task)
            $converted[] = (array) $task;
        return $converted;
    }

    // provide form validation rules
    public function rules() {
        $config = array(
                ['field' => 'task', 'label' => 'TODO task', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
                ['field' => 'priority', 'label' => 'Priority', 'rules' => 'integer|less_than[4]'],
                ['field' => 'size', 'label' => 'Task size', 'rules' => 'integer|less_than[4]'],
                ['field' => 'group', 'label' => 'Task group', 'rules' => 'integer|less_than[5]'],
        );
        return $config;
    }
    
    public function load() {
		if (($tasks = simplexml_load_file($this->_origin)) !== FALSE)
		{
			foreach ($tasks as $task) {
				$record = new stdClass();
				$record->id = (int) $task->id;
				$record->task = (string) $task->desc;
				$record->priority = (int) $task->priority;
				$record->size = (int) $task->size;
				$record->group = (int) $task->group;
				$record->deadline = (string) $task->deadline;
				$record->status = (int) $task->status;
				$record->flag = (int) $task->flag;

				$this->_data[$record->id] = $record;
			}
		}

		// rebuild the keys table
		$this->reindex();
        
    }

    public function store() {
		/*
			fputcsv($handle, $this->_fields);
			foreach ($this->_data as $key => $record)
				fputcsv($handle, array_values((array) $record));
			fclose($handle);
		}
		// --------------------
		*/
		$xmlDoc = new DOMDocument( "1.0");
            $xmlDoc->preserveWhiteSpace = false;
            $xmlDoc->formatOutput = true;
            $this->xml = simplexml_load_file(realpath($this->_origin));
        $data = $xmlDoc->createElement($this->xml->getName());
        foreach($this->_data as $key => $value)
        {
            $task  = $xmlDoc->createElement($this->xml->children()->getName());
            foreach ($value as $itemkey => $record ) {
                    if($itemkey === "task") {
                        $itemkey = "desc";
                        $item = $xmlDoc->createElement($itemkey, htmlspecialchars($record));
                        $task->appendChild($item);
                    } else {
                        $item = $xmlDoc->createElement($itemkey, htmlspecialchars($record));
                        $task->appendChild($item);
                    }
                }
                $data->appendChild($task);
            }
            $xmlDoc->appendChild($data);
            $xmlDoc->saveXML($xmlDoc);
            $xmlDoc->save($this->_origin);
    }
    
}

function orderByCategory($a, $b) {
    if ($a->group < $b->group)
        return -1;
    elseif ($a->group > $b->group)
        return 1;
    else
        return 0;
}
