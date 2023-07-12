{{-- menu-is-opening menu-open --}}
{{-- <li class="nav-item @if (request()->is('obras*') || request()->is('materials*') || request()->is('material_obras*')) menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Obras <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('obras.index') }}" class="nav-link {{ request()->is('obras*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Obras</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('materials.index') }}"
                class="nav-link {{ request()->is('materials*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Materiales</p>
            </a>
        </li>
    </ul>
</li> --}}

<li class="nav-item">
    <a href="{{ route('obras.index') }}"
        class="nav-link {{ request()->is('obras*') || request()->is('solicitud_obras*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Obras</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('personals.index') }}" class="nav-link {{ request()->is('personals*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Personal</p>
    </a>
</li>
