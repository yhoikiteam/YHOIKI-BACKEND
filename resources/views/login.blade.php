@if (session()->has('message'))
    <div role="alert">
        {{ session('message') }}
        <button type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('error'))
    <div role="alert">
        {{ session('error') }}
        <button type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<form action="/login" method="POST">
    @csrf
    <p>email</p>
    <input type="text" name="email">
    <p>password</p>
    <input type="text" name="password">
    <button type="submit"> login </button>
</form>
