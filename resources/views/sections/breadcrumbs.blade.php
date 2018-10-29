@if(!empty($breadcrumbs))
<nav class="breadcrumbs">
    <ul>
        @foreach($breadcrumbs as $title => $url)
        <li>
            @if(empty($url))
            <span @if($loop->last)class="current_page"@endif>{{ $title }}</span>
            @else
            <a href="{{ $url }}" @if($loop->last)class="current_page"@endif>{{ $title }}</a>
            @endif
            @if(!$loop->last)
            <span class="divider">&rsaquo;</span>
            @endif
        </li>
        @endforeach
    </ul>
</nav>
@endif