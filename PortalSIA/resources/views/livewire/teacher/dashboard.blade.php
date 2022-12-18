<div>
    {{ Cache::has('user-is-online' . Auth::id()) ? "True" : "False" }}
</div>
