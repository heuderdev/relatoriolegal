{{ Auth::user()->email }}
<br>
<form
    method="POST"
    action="{{ route('tenant-invitations.store') }}"
>
    @csrf

    <input
        type="email"
        name="email"
        required
    >

    <select name="role" required>
        <option value="admin">Administrador</option>
        <option value="manager">Gerente</option>
        <option value="employee">Funcionário</option>
        <option value="client">Cliente</option>
        <option value="member">Membro</option>
    </select>

    <button type="submit">
        Enviar convite
    </button>
</form>
