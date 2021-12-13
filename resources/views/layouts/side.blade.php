<!-- Add all your menu design and name here -->

<div class="col-md-1">
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
        <!-- Onlu use this link for testing purpose / otherwise display none -->
        <li class="nav-item">
            <router-link :to="{name:'test.component'}" class="nav-link">
                Test
            </router-link>
        </li>
    </ul>
</div>