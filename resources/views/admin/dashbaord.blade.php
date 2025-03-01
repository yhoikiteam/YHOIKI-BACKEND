{{-- @dd($user) --}}
<form action="/logout" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>