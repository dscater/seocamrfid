<li class="nav-item">
    <a href="{{ route('personals.index') }}" class="nav-link {{ request()->is('personals*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Personal</p>
    </a>
</li>

{{-- menu-is-opening menu-open --}}
<li class="nav-item @if (request()->is('obras*') || request()->is('materials*') || request()->is('material_obras*')) menu-is-opening menu-open active @endif">
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
</li>

{{-- menu-is-opening menu-open --}}
<li class="nav-item @if (request()->is('herramientas*') || request()->is('monitoreo_herramientas*')) menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-list"></i>
        <p>Herramientas <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('herramientas.index') }}" class="nav-link {{ request()->is('herramientas*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Herramientas</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('monitoreo_herramientas.index') }}"
                class="nav-link {{ request()->is('monitoreo_herramientas*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Monitoreo</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Reportes</p>
    </a>
</li>
