<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="/img/logoStarbhakForApp.png" alt="" style="width: 2.8rem;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: capitalize;">Buku
                Tamu</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1" style="overflow-y: auto;overflow-x: hidden">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @can('view_roles', 'add_roles', 'edit_roles', 'delete_roles')
            {{-- Roles --}}
            <li class="menu-item {{ Request::is('roles*') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                    <div data-i18n="Analytics">Roles</div>
                </a>
            </li>
        @endcan

        @can('view_users', 'add_users', 'edit_users', 'delete_users')
            <!-- Users -->
            <li class="menu-item {{ Request::is('users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Analytics">Users</div>
                </a>
            </li>
        @endcan

        @can('view_guru', 'add_guru', 'edit_guru', 'delete_guru')
            <li class="menu-item {{ Request::is('guru*') ? 'active' : '' }}">
                <a href="{{ route('guru.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Analytics">Data Guru</div>
                </a>
            </li>
        @endcan

        @can('view_buku_tamu', 'add_buku_tamu', 'edit_buku_tamu', 'delete_buku_tamu', 'buku_tamu_ekspor')
            <li class="menu-item {{ Request::is('buku-tamu*') ? 'active' : '' }}">
                <a href="{{ route('buku-tamu.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-book'></i>
                    <div data-i18n="Analytics">Buku Tamu</div>
                </a>
            </li>
        @endcan

    </ul>
</aside>
