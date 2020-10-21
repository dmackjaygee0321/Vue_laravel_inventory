<template>
    <div><nav class="navbar navbar-expand-md navbar-light" style="background-color: #949CA3;">
    <router-link to="/home" class="navbar-brand">
        <img src="data/stock.png" height="28" alt="CoolBrand" style="padding-right: 10px">Inventory
    </router-link>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ml-auto">
             <router-link to="/inventory" class="nav-item nav-link">Inventory</router-link>
             <router-link to="/product" class="nav-item nav-link">Product</router-link>
             <router-link to="/category" class="nav-item nav-link">Category</router-link>
             <a class="nav-item nav-link" href="#" @click="logout()">logout</a>
        </div>
    </div>
</nav>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
     methods:
     {
         logout()
         {
             window.location.href = "/logout";
         }
     }       
    }
    </script>