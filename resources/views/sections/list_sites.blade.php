<ul class="sites">
    <li class="first">
        <a href="/brendan" @if(isset($site) && $site['title_short'] == 'BCM')class="current_site"@endif>
            <img src="{{ asset('images/brendan/brendan-murty.jpg') }}" alt="BCM" title="Visit Brendan Murty's website">
            <span>Brendan Murty</span>
        </a>
    </li>
    <li>
        <a href="https://ellacondon.com/">
            <img src="{{ asset('images/ella/ella_condon.jpg') }}" alt="EJC" title="Visit Ella Condon's website">
            <span>Ella Condon</span>
        </a>
    </li>
    <li>
        <a href="/isla" @if(isset($site) && $site['title_short'] == 'IJM')class="current_site"@endif>
            <img src="{{ asset('images/isla/isla-murty.jpg') }}" alt="IJM" title="Visit Isla Murty's website">
            <span>Isla Murty</span>
        </a>
    </li>
    <li>
        <a href="/freya" @if(isset($site) && $site['title_short'] == 'FJM')class="current_site"@endif>
            <img src="{{ asset('images/freya/freya-murty.jpg') }}" alt="FJM" title="Visit Freya Murty's website">
            <span>Freya Murty</span>
        </a>
    </li>
    <li class="last">
        <a href="/gallery" @if(isset($site) && $site['title_short'] == 'GAL')class="current_site"@endif>
            <img src="{{ asset('images/common/gallery.svg') }}" alt="GAL" title="Visit the gallery website">
            <span>Gallery</span>
        </a>
    </li>
</ul>
