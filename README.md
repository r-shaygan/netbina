# Netbina Task Manager
This web application helps users to organize and share tasks among their group
## Tech Stack

***Client:*** TailwindCSS

***Server:*** Laravel

## Display assigned tasks
users can see all tasks that assigned to them as a table by link below

```http
GET /tasks
```
Tasks can have one of the following three states:
- accepted: represented by check icon on table
- delayed: if a task has this status its row will display red
- pending: represented by PENDING... on table

by clicking on detail icons on table , users can see their task's detail and change its status if it is on pending status.

![Screenshot (88)](https://user-images.githubusercontent.com/86359224/208222754-44ed061a-c1e8-4aa3-a43d-35df126f54fc.png)


## Display task's details
users can see details of their specific task by link below.

```http
GET /tasks/{$id}
```

this action is constrained by TaskPolicy
```php
    public function isAssignedUser(User $user,Task $task): bool
    {
        return $task->assigned === $user->id;
    }
```

![Screenshot (89)](https://user-images.githubusercontent.com/86359224/208224157-1a19c0b5-ac91-4709-9bdc-24e7658ca17f.png)
if tasks have pending state user can accept it or assign it to another user.

![Screenshot (90)](https://user-images.githubusercontent.com/86359224/208224242-343199e3-efdd-4a7d-bb04-bf1efd6eb06b.png)

all tasks detail can be viewed but just pending tasks can be accepted or assigned to another user.
that means if a task is accepted or delayed cannot be assigned.
this action is constrained by TaskPolicy

```php 

    public function canAssign(User $user,Task $task)
    {
        return $task->isPending() && $this->isAssignedUser($user,$task);
    }
    
       public function canAccept(User $user,Task $task): bool
    {
        return $this->isAssignedUser($user,$task) && $task->isPending();
    }

```

## create a new task
user can create a new task by following link
```http
GET /tasks/create
```
The deadline  can be at least 30 minutes later.
TaskRequest:
```php
 public function rules()
    {
        return [
            'title'=>'required|min:3|max:100',
            'description'=>'required|min:3|max:500',
            'deadline'=>'required|date|after:+30 minute',
            'assigned'=>['exists:users,id',Rule::requiredIf(fn()=>$this->route()->getName()=='tasks.store')]
        ];
    }

```
## Display own tasks
user can see tasks that create by themselves by link below
```http
GET /tasks/own
```
user can see all own tasks details but can edit and remove just pending task.
this action is constraied by TaskPlicy
```php
    public function canModify(User $user,Task $task)
    {
        return $this->isOwner($user,$task) && $task->isPending();
    }

    public function isOwner(User $user,Task $task)
    {
        return $task->owner==$user->id;
    }

```
accepted or delayed tasks:
![Screenshot (92)](https://user-images.githubusercontent.com/86359224/208226651-db967bdd-d038-433f-818f-e304b6b994d8.png)

pending tasks:
![Screenshot (91)](https://user-images.githubusercontent.com/86359224/208226681-36c1dd15-6efa-4687-a4c6-549bceaab936.png)


