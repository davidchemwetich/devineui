<div>
    @if ($favicon)
        <link rel="icon" type="image/jpg/png" href="{{ asset('storage/' . $favicon) }}"/>
    @else
        <!-- No favicon set -->
        <span style="display: none;"></span>
    @endif
</div>
