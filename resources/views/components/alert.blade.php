<div class="text-red-600">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <li class="dark:text-red-600">{{ $error }}</li>
    @endforeach
    @endif
</div>