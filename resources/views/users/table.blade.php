@if($users->count())
<table class="table">
    <thead class=" text-warning">
    <tr>
        <th>
            Nome
        </th>
        <th>
            Login
        </th>
        <th>
            Setor
        </th>
        <th>
            Criado em
        </th>
        <th class="text-right">
            &nbsp;
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {{ $user->username }}
            </td>
            <td>
                {{ $user->grupoUsuario()->first()->nome }}
            </td>
            <td>
                {{ date('d/m/Y', strtotime($user->created_at)) }}
            </td>
            <td class="td-actions text-right">
                <a class="btn btn-success" href="{{ route('user.edit', ['user' => $user->id]) }}">
                    <i class="material-icons">edit</i>
                    <div class="ripple-container"></div>
                    {{ __('Alterar funcionário') }}
                </a>
                <form method="POST"
                      action="{{ route('user.destroy', ['user' => $user->id]) }}"
                      style="display: inline-block">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja deletar este funcionário?')">
                            <i class="material-icons">delete</i>
                            <div class="ripple-container"></div>
                            {{ __('Excluir funcionário') }}
                        </button>
                    </div>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
    <div class="alert alert-danger mt-4">
        Nada encontrado...
    </div>
@endif
