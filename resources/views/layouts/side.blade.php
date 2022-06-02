<!-- Add all your menu design and name here -->
@if(Auth::check())
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a class="brand-link" href="{{ url('/') }}">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    @else
    <aside class="main-sidebar">
        <a class="brand-link" style="border-bottom: 1px solid lightgrey;color:grey;pointer-events: none;">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
        </a>
    @endif
        @if(Auth::check())
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <router-link :to="{name:'dashboard.detail'}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'product.summary'}" class="nav-link">
                            <i class="nav-icon fas fa-columns"></i>
                            <p>
                                Product
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <!-- Only use this link for testing purpose / otherwise display none -->
                        <router-link :to="{name:'test.component'}" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>Test</p>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
    </aside>
    <!-- <div class="col-md-1">
    <ul class="nav flex-column">
        <li class="nav-item">
            <router-link :to="{name:'dashboard.detail'}" class="nav-link">
                Dashboard
            </router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name:'product.summary'}" class="nav-link">
                Product
            </router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name:'user.summary'}" class="nav-link">
                User
            </router-link>
        </li>
        Onlu use this link for testing purpose / otherwise display none
        <li class="nav-item">
            <router-link :to="{name:'test.component'}" class="nav-link">
                Test
            </router-link>
        </li>
    </ul>
</div> -->