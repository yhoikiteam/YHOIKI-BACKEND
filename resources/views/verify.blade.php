{{-- @dd($user) --}}
email belu ter verifikasi

silahkan verrifikasi email
<form action="{{ route('verification.store') }}" method="post">
    @csrf
    <input type="number" name="token" value="">
    <button type="submit">Verifikasi Email</button>
</form>

<form action="{{ route('verification.resend', ) }}" method="post">
    @csrf
    <input type="hidden" name="token" value="">
    <button type="submit">Kirim Code</button>
</form>

<form action="/logout" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>