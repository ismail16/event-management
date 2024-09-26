<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">EVENT Application</a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">EVENT</a>
        </div>
        <ul class="sidebar-menu">
            @if(has_permission('menu.application'))
                <li class="menu-header">Application</li>
                @if(has_permission('application.index'))
                    <li class="nav-item dropdown {{ (Request::is('application') || Request::is('application/*')) ? 'active' : '' }}">
                        <a href="{{ route('application.index') }}" class="nav-link has-dropdown"><i
                                class="fas fa-city"></i>
                            <span>Applications</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('application.create'))
                                <li class="{{ Request::is('application/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('application.create') }}"><i
                                            class="fa fa-plus"></i>
                                        <span>Cardless EMI</span></a>
                                </li>

                                <li class="{{ Request::is('application/card/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('application.card.create') }}"><i
                                            class="fa fa-plus"></i>
                                        <span>Card EMI</span></a>
                                </li>
                            @endif
                            @if(has_permission('application.index'))
                                <li class="{{ Request::is('application') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('application.index') }}"><i
                                            class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

            @endif

            @if(has_permission('menu.administrator'))
                <li class="menu-header">Administrator</li>
                @if(has_permission('users.index'))
                    <li class="nav-item dropdown {{ (Request::is('users') || Request::is('users/*')) ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="nav-link has-dropdown"><i
                                class="fas fa-users"></i> <span>Users</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('users.create'))
                                <li class="{{ Request::is('users/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.create') }}"><i class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif

                            @if(has_permission('users.index'))
                                <li class="{{ Request::is('users') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(has_permission('events.index'))
                    <li class="nav-item dropdown {{ (Request::is('events') || Request::is('events/*')) ? 'active' : '' }}">
                        <a href="{{ route('events.index') }}" class="nav-link has-dropdown"><i
                                class="fas fa-users"></i> <span>events</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('events.create'))
                                <li class="{{ Request::is('events/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('events.create') }}"><i class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif

                            @if(has_permission('events.index'))
                                <li class="{{ Request::is('events') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('events.index') }}"><i class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(has_permission('participants.index'))
                    <li class="nav-item dropdown {{ (Request::is('participants') || Request::is('participants/*')) ? 'active' : '' }}">
                        <a href="{{ route('participants.index') }}" class="nav-link has-dropdown"><i
                                class="fas fa-users"></i> <span>Participants</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('participants.create'))
                                <li class="{{ Request::is('participants/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('participants.create') }}"><i
                                            class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif

                            @if(has_permission('participants.index'))
                                <li class="{{ Request::is('participants') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('participants.index') }}"><i
                                            class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(has_permission('shop.index'))
                    <li class="nav-item dropdown {{ (Request::is('shop') || Request::is('shop/*')) ? 'active' : '' }}">
                        <a href="{{ route('shop.index') }}" class="nav-link has-dropdown"><i
                                class="fas fa-users"></i> <span>Shops</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('shop.create'))
                                <li class="{{ Request::is('shop/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('shop.create') }}"><i class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif

                            @if(has_permission('shop.index'))
                                <li class="{{ Request::is('shop') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('shop.index') }}"><i class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

            @if(has_permission('menu.setup'))
                <li class="menu-header">Setup</li>
                @if(has_permission('brand.index'))
                    <li class="nav-item dropdown {{ (Request::is('brand') || Request::is('brand/*')) ? 'active' : '' }}">
                        <a href="{{ route('brand.index') }}" class="nav-link has-dropdown"><i class="fas fa-city"></i>
                            <span>Brands</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('brand.create'))
                                <li class="{{ Request::is('brand/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('brand.create') }}"><i class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif
                            @if(has_permission('brand.index'))
                                <li class="{{ Request::is('brand') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('brand.index') }}"><i class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(has_permission('division.index'))
                    <li class="nav-item dropdown {{ (Request::is('division') || Request::is('division/*')) ? 'active' : '' }}">
                        <a href="{{ route('division.index') }}" class="nav-link has-dropdown"><i
                                class="fas fa-city"></i>
                            <span>Divisions</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('division.create'))
                                <li class="{{ Request::is('division/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('division.create') }}"><i class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif
                            @if(has_permission('division.index'))
                                <li class="{{ Request::is('division') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('division.index') }}"><i class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(has_permission('district.index'))
                    <li class="nav-item dropdown {{ (Request::is('district') || Request::is('district/*')) ? 'active' : '' }}">
                        <a href="{{ route('district.index') }}" class="nav-link has-dropdown"><i
                                class="fas fa-city"></i>
                            <span>Districts</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('district.create'))
                                <li class="{{ Request::is('district/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('district.create') }}"><i class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif
                            @if(has_permission('district.index'))
                                <li class="{{ Request::is('district') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('district.index') }}"><i class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(has_permission('thana.index'))
                    <li class="nav-item dropdown {{ (Request::is('thana') || Request::is('thana/*')) ? 'active' : '' }}">
                        <a href="{{ route('thana.index') }}" class="nav-link has-dropdown"><i class="fas fa-city"></i>
                            <span>Thana</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('thana.create'))
                                <li class="{{ Request::is('thana/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('thana.create') }}"><i class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif
                            @if(has_permission('thana.index'))
                                <li class="{{ Request::is('thana') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('thana.index') }}"><i class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(has_permission('post.office.index'))
                    <li class="nav-item dropdown {{ (Request::is('post.office') || Request::is('post.office/*')) ? 'active' : '' }}">
                        <a href="{{ route('post.office.index') }}" class="nav-link has-dropdown"><i
                                class="fas fa-city"></i>
                            <span>Post Offices</span></a>
                        <ul class="dropdown-menu">
                            @if(has_permission('post.office.create'))
                                <li class="{{ Request::is('post.office/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('post.office.create') }}"><i
                                            class="fa fa-plus"></i>
                                        <span>New</span></a>
                                </li>
                            @endif
                            @if(has_permission('post.office.index'))
                                <li class="{{ Request::is('post.office') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('post.office.index') }}"><i
                                            class="fas fa-list"></i>
                                        <span>All</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        </ul>
    </aside>
</div>
