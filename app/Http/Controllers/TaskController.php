<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Notifications\notificaitonTask;
use App\Notifications\notificationTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller 
{
    public function index(Request $req){ 
    // if($req->has('search') && !empty($req->search)){
    // $listTasks=DB::table('tasks')->where('title', 'like' .'%'. $req->search . '%' )->paginate(2);
    // }else{
    // $listTasks=task::all();
    // }
    // return  view("tasks.index",compact('listTasks'));
    $listTasks=Task::all();
    $this->notification();
    return  view("tasks.index",compact('listTasks'));
    }

    public function create(){
        return  view('tasks.create');
    }
     public function store(Request $req)
    {
        $validated = $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,completed',
        ], [
            'title.required' => 'Le champ titre est obligatoire.',
            'description.required' => 'Le champ description est obligatoire.',
            'due_date.required' => 'Le champ date est obligatoire.',
            'status.required' => 'Le champ statut est obligatoire.',
            'status.in' => 'Le statut doit être "pending" ou "completed".',
        ]);
        $newTask = DB::table('tasks')->insert([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
            'user_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if ($newTask) {
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Nouvelle tâche ajoutée avec succès');
        }
        return back()->with('error', 'Une erreur est survenue lors de l’ajout.');
    }
    public function edit($id){
        $taskMod=Task::find($id);
        //dd($taskMod);
        return view('tasks.edit',compact('taskMod'));
    }
    public function update(Request $req,$id){
        $validated = $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,completed',
        ], [
            'title.required' => 'Le champ titre est obligatoire.',
            'description.required' => 'Le champ description est obligatoire.',
            'due_date.required' => 'Le champ date est obligatoire.',
            'status.required' => 'Le champ statut est obligatoire.',
            'status.in' => 'Le statut doit être "pending" ou "completed".',
        ]);
        DB::table('tasks')->where('id',$id)->update([
        'title' => $req->input('title'),
        'description' => $req->description,
        'due_date' => $req->due_date,
        'status' => $req->status,
        'user_id' => auth()->id(),
        'created_at' => now(),
        'updated_at' => now(),
        ]);
        //dd($m);
        return redirect()->route('tasks.index')->with('succee',"l'element est modifier avec succee !!!!");

    }
    public function destroy($id){
    if(isset($id)){
    Task::destroy($id);
    return back()->with('succee','task delete !!');
      }else{
    return back()->with('error','id not found !!');
    }
    }

    public function taskTermine(){
        $taskpending=DB::table('tasks')->where('status','=','pending')->get();
        //dd($taskTermine);
        return view('tasks.tasksPending',compact('taskpending'));
    }

    public function updateStatus($id)
{
    $task=DB::table('tasks')->where('id',$id)->first();
     if(!$task){
        return back()->with('error','task not fount');
     }
    $tasknew=$task->status == 'pending' ? 'completed' : 'pending';
    DB::table('tasks')->where('id',$id)->update([
    'status'=>$tasknew,
    'updated_at' => now(),
    ]);
    return redirect()->route('taskpending')->with('success', 'Statut mis à jour avec succès ✅');
}

   public static function notification(){
        $user = auth()->user();
        $taskPendingNotifiy = Task::where('user_id', $user->id)->where('status','pending')->count();
        if($taskPendingNotifiy > 0){
            Notification::Route('mail',$user->email)->notify(new notificationTask($user,$taskPendingNotifiy));
            return ('notification par emails envoyer avec succee !!!');    
        }
   }

}














