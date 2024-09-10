@extends('layout')

@section('main-content')

    <div>
        <div class="float-start">
            <h4 class="pb-3">Minhas Tarefas</h4>
        </div>
        <div class="d-flex float-end">
            <!-- Barra de busca -->
            <form id="search-form" method="GET" class="d-flex" style="display: inline">
                <input type="text" name="search" id="search-input" class="form-control me-2" placeholder="Buscar tarefas" value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-primary me-2">Buscar</button>
            </form>
            <a href="{{ route('task.create') }}" class="btn btn-info" style="color: white">
                <i class="fa fa-plus-circle"></i> Criar Tarefa
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- Div que será atualizada dinamicamente -->
    <div id="task-list">
        @foreach ($tasks as $task)
            <div class="card mt-3">
                <div class="card-header">
                    @if ($task->status === 'pendente')
                        {{ $task->title }}
                    @else
                        <del>{{ $task->title }}</del>
                    @endif
                    <span class="badge text-bg-warning">
                        {{ $task->created_at ? $task->created_at->diffForHumans() : 'desconhecido' }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="card-text">
                        <div class="float-start">
                            @if ($task->status === 'pendente')
                                {{ $task->description }}
                            @else
                                <del>{{ $task->description }}</del>
                            @endif
                            <br/>

                            @if ($task->status === 'pendente')
                                <span class="badge rounded-pill text-bg-info">pendente</span>
                            @else
                                <span class="badge rounded-pill text-bg-success" style="background-color: green; color: white;">concluída</span>
                            @endif
                            <small>Último Update - {{ $task->updated_at ? $task->updated_at->diffForHumans() : 'desconhecido' }}</small>
                        </div>

                        <div class="float-end">
                            <a href="{{ route('task.edit', $task->id) }}" class="btn btn-sucess" style="background-color: green; color: white;">
                                <i class="fa fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('task.destroy', $task->id) }}" style="display: inline;" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta tarefa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Deletar
                                </button>
                            </form>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        @endforeach

        @if (count($tasks) === 0)
            <div class="alert alert-danger p-2">
                Nenhuma tarefa Encontrada!
                <br/>
                <br/>
                <a href="{{ route('task.create') }}" class="btn btn-info" style="color: white;">
                    <i class="fa fa-plus-circle"></i> Criar Tarefa
                </a>
            </div>
        @endif
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const searchUrl = "{{ route('task.index') }}"; // Atribua a URL da rota a uma variável

            // Intercepta o envio do formulário de busca
            $('#search-form').on('submit', function(e) {
                e.preventDefault(); // Previne o envio padrão do formulário

                // Pega o valor do campo de busca
                let searchQuery = $('#search-input').val();

                // Faz uma requisição Ajax para buscar as tarefas
                $.ajax({
                    url: searchUrl, // URL da rota que lida com a busca
                    type: 'GET',
                    data: { search: searchQuery }, // Envia o termo de busca como parâmetro
                    success: function(response) {
                        // Atualiza a div que contém a lista de tarefas com o conteúdo retornado
                        $('#task-list').html($(response).find('#task-list').html());
                    },
                    error: function(xhr) {
                        console.log('Erro ao buscar tarefas: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
