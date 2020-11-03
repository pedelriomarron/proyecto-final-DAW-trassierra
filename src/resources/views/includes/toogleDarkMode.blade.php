<form id="darkmode" action="{{ route('themes') }}" method="POST">
    @csrf
    @method('PUT')
    <label class="switch" for="checkbox" title="Change color scheme to dark mode">
        <input type="checkbox" name="theme" id="checkbox" onclick="dosomething()" @if(session('theme')==='dark' ) checked @else @endif />
        <div class="slider round"></div>
        <div class="toggle-moon">🌙</div>
        <div class="toggle-sun">☀️</div>
    </label>
</form>