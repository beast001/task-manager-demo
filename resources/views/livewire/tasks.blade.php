<div>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
              <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                <div class="card-body py-4 px-4 px-md-5">
      
                  <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                    <i class="fas fa-check-square me-1"></i>
                    <u>My Projects</u>
                  </p>

                 @if($message!=0)
                 <div class="alert alert-danger" role="alert">{{$message}} </div>
                 @endif
      
                  <div class="pb-2">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex flex-row align-items-center">
                          <input type="text" wire:model="projectText" wire:keydown.enter="addProject"class="form-control form-control-lg" id="exampleFormControlInput1"
                            placeholder="Add new...">
                        
                          <div>
                            <button type="button" class="btn btn-primary" wire:click="addProject">Add</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                    <hr class="my-4">
                     <div class="d-flex justify-content-end align-items-center mb-4 pt-2 pb-3">
                    <p class="small mb-0 me-2 text-muted">Select Project</p>
                    <select class="select form-control form-control-lg" wire:click="selectTasks" wire:model="project_id">
                      <option value="" disabled>Select Project</option>
                      @foreach($projects as $index=>$project)    
                      <option value="{{$project->id}}">{{$project->name}}</option>
                      @endforeach
                    </select>
                  </div>

                      
                @if($project_id!='')

                <p class="h2 text-center mt-3 mb-4 pb-3 text-primary">
                    My Tasks ({{count($tasks)}})
                  </p>

                
                                
                <div wire:sortable="updatePriorityOrder">
                @foreach($tasks as $index=>$task)    

      
                  
                  <ul class="list-group list-group-horizontal rounded-0" wire:sortable.item="{{$task->id}}" wire:key="task-{{ $task->id }}" wire:sortable.handle>
                      <li
                      class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                      <div class="form-check">
                        <input class="form-check-input me-0" wire:change="changeTask({{$task->id}}) "  type="checkbox" {{$task->completed ? 'checked' : ""}} value="" id="flexCheckChecked3"
                          aria-label="..." />
                      </div>
                    </li>

                    <li class="list-group-item px-3 py-1 d-flex align-items-center border-0 bg-transparent">
                      <div
                        class="py-2 px-3 me-2 border border-warning rounded-3 d-flex align-items-center bg-light">
                        <p class="small mb-0">
                          <a href="#!" data-mdb-toggle="tooltip" title="Due on date">
                            <i class="fas fa-hourglass-half me-2 text-warning"></i>
                          </a>
                          {{$task->priority}}
                        </p>
                      </div>
                    </li>


                    <li
                      class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                      <p class="lead fw-normal mb-0 flex-1 {{$task->completed ? 'text-decoration-line-through' : ''}}">{{$task->task}}</p>
                    </li>

                    <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                      <div class="d-flex flex-row justify-content-end mb-1">
                        
                        <button class="text-danger" data-mdb-toggle="tooltip" wire:click="deleteTask({{$task->id}})" title="Delete task"><i
                            class="fas fa-trash-alt"></i></button>
                        </div>
                    </li>
                  </ul>
                  @endforeach
                </div>
                  

                  <br>

                  <div class="md-form form-group shadow-textarea">
                    <i class="fas fa-pencil-alt prefix"></i>
                    <textarea wire:model="taskText" id="form10" placeholder="Enter task to add to this project" class="md-textarea form-control" rows="3"></textarea>
                    <br>
                    <button type="button" class="btn btn-primary" wire:click="addTask">Add Task</button>
                  </div>

                  @else
                  <p class="h5 text-center mt-3 mb-4 pb-3">
                        Select or add a new project.</p>
            
                @endif

                  
                  <hr class="my-4">
                  <p class="h5 text-center mt-3 mb-4 pb-3">
                    @if (count($projects)==0)
                        You don't have any Project yet.</p>

                    @else
                    There are {{count($projects)}} Projects </p>
                             
                    @endif
                    
                  </p>
      
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> 
</div>
