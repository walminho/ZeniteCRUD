@extends('layout')

@section('main-content')

        <div>
            <div class="float-start">
                <h4 class="pb-3">Editar Tarefa <span class="badge bg-info">{{ $task->title }}</span></h4>
            </div>
            <div class="float-end">
                <a href="{{ route('index') }}" class="btn btn-info">
                    Todas as Tarefas
                </a>
            </div>
            <div class="clearfix"></div>
        </div>

    <div class="card card-body bg-light p-4">

        <form action="{{ route('task.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea type="text" class="form-control" id="description" name="description" rows="5">{{ $task->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    @foreach ($statuses as $status)
                        <option value="{{ $status['value'] }}" {{ $task->status === $status['value'] ? 'selected' : ''}}>
                            {{ $status['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        
    </div>

        

@endsection