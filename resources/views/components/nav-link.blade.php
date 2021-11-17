@props(['route', 'icon', 'active'])

<li class="sidebar-item @if (request()->routeIs($active)) active @endif">
    <a href={{ route($route) }} class='sidebar-link'>
        <i data-feather={{ $icon }} width="20"></i>
        <span>{{ $slot }}</span>
    </a>
</li>
