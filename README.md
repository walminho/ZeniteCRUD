# Sistema de Gerenciamento de Tarefas

Este é um sistema simples de gerenciamento de tarefas desenvolvido usando Laravel 9, PHP, MySQL e HTML/CSS.

## Funcionalidades

- **Listar Tarefas**: Exibe todas as tarefas cadastradas.
- **Adicionar Tarefa**: Permite a criação de novas tarefas.
- **Editar Tarefa**: Edita tarefas já existentes.
- **Marcar como Concluída**: Muda o status da tarefa para concluída.
- **Excluir Tarefa**: Exclui tarefas cadastradas.

## Tecnologias Utilizadas

- **Back-end**: PHP, Laravel 9
- **Front-end**: HTML, CSS
- **Banco de Dados**: MySQL

## Instalação

### Pré-requisitos

- PHP >= 8.0
- Composer
- MySQL




### Passos para Instalação

1. Clone o repositório:

```bash
https://github.com/walminho/ZeniteCRUD
```
2. Se houver erro com o arquivo autoload de vendor/autoload.php, parecido com

        #### Warning: require(C:\laragon\www\{project-directory}\ZeniteCRUD\public/../vendor/autoload.php): Failed to open stream: No such file or directory in C:\laragon\www\t\ZeniteCRUD\public\index.php on line 34
        #### Fatal error: Uncaught Error: Failed opening required 'C:\laragon\www\{project-directory}\ZeniteCRUD\public/../vendor/autoload.php' (include_path='.;C:/laragon/etc/php/pear') in  C:\laragon\www\t\ZeniteCRUD\public\index.php:34 Stack trace: #0 {main} thrown in C:\laragon\www\t\ZeniteCRUD\public\index.php on line 34

    ### execute

```bash
composer install
```

3. Um segundo erro provável é a renomeação automática do arquivo **.env** para **.env.example**. -- Isto provoca o erro **500 | Server Error**. Se isto ocorrer, renomei **.env.example** para **.env**.

    Pode ser necessário recriar a application key (chave da aplicação) utilisando o artisan. Se isso for solicitado, faça:

    ```php artisan key:generate```
