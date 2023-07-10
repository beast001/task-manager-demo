<?php

namespace App\Http\Livewire;

use App\Models\TaskItem;
use App\Models\Project;
use Livewire\Component;

class Tasks extends Component
{   //initialize constants
    public $task;
    public $project_id='';
    public $message =0;

    public string $taskText = '';
    public string $projectText = '';

    public function mount()
    {
        //on page load read all projects from the db and populate the dropdown select menue
        $this->selectProjects();


    }


    public function render()
    {
        return view('livewire.tasks');
    }

    //add task to a particuler project
    public function addTask()
    {   
        
        if ($this->taskText == '')
        {
            $this->message='Task name cannot be empty';
            return;
        }
        
        $task = new TaskItem();
        $task->task = $this->taskText;
        $task->projects_id= $this->project_id;
        $task->completed = false;
        $task->save();
        
        $this->message=0;
        $this->taskTest = '';
        $this->selectTasks();

    }

    public function addProject()
    {   if ($this->projectText == '')
        {
            $this->message='Project name cannot be empty';
            return;
        }
        $project = new Project;
        $project->name =  $this->projectText;
        $project->completed = false;
        $project->save();

        $this->message=0;
        $this->projectText = '';
        $this->project_id = $project->id;
        $this->selectProjects();
        $this->selectTasks();
    }

    //select task based on projects 
    public function selectTasks()
    {   $id = $this->project_id;
        $this->tasks = TaskItem::where('projects_id',$id)->orderby('priority', 'ASC')->get();
        
    }
    //select projects and order them in desc order
    public function selectProjects()
    {
        $this->projects = Project::orderby('created_at', 'DESC')->get();

    }

    //mark a task as completed of not completed based on the prev state
    public function changeTask($id)
    {
        $task = TaskItem::where('id', $id)->first();

        if(!$task){
            return;
        }

        $task->completed = !$task->completed;
        $task->save();
        $this->selectTasks();
    }

    //Delete a task form db

    public function deleteTask($id)
    {
        $task = TaskItem::find($id);
        if (!$task){
            return;
        }
        $task->delete();
        $this->selectTasks();
    }

    //update the priority of task in a peticular project
    public function updatePriorityOrder($items)
    {
        foreach($items as $item)
        {
            TaskItem::find($item['value'])->update(['priority'=>$item['order']]);
        }

        $this->selectTasks();

    }
}
