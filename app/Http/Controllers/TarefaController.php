<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Verifica se há uma busca
        $search = $request->query('search');
        
        if ($search) {
            // Filtra as tarefas pelo título ou descrição
            $tasks = Tarefa::where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orderBy('id', 'desc')
                ->get();
        } else {
            // Exibe todas as tarefas se não houver busca
            $tasks = Tarefa::orderBy('id', 'desc')->get();
        }

        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = [
            [
                'label' => 'pendente',
                'value' => 'pendente'
            ],
            [
                'label' => 'concluída',
                'value' => 'concluída'
            ]
        ];
        return view('create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $task = new Tarefa();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        
        return redirect()->route('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Tarefa::findOrFail($id);
        $statuses = [
            [
                'label' => 'pendente',
                'value' => 'pendente'
            ],
            [
                'label' => 'concluída',
                'value' => 'concluída'
            ]
        ];
        return view('edit', compact('statuses', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Tarefa::findOrFail($id);
        $request->validate([
            'title' => 'required'
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Tarefa::findOrFail($id);
        $task->delete();
        return redirect()->route('index');
    }
}
