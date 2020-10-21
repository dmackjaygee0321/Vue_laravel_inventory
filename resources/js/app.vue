<template>
    <div><nav class="navbar navbar-expand-md navbar-light" style="background-color: #949CA3;">
    <router-link to="/" class="navbar-brand">
        <img src="data/stock.png" height="28" alt="CoolBrand" style="padding-right: 10px">Inventory
    </router-link>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ml-auto">
             <router-link to="/login" class="nav-item nav-link">Login</router-link>
             <router-link to="/signup" class="nav-item nav-link">Sign Up</router-link>
        </div>
    </div>
</nav>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {}
</script>