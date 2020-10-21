<template>
    <div>   

        <form style="padding: 30px; text-align: center;" @submit.prevent="loginaccount">
            
        <h1>Login</h1> 
        
  <div class="form-group row" style="padding-top: 50px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="email@example.com" required v-model="login.email">
    </div>
  </div>
  <div class="form-group row"   style="padding-top: 30px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" required v-model="login.password">
    </div>
  </div>
  <center style="margin-top:50px">
        <button class="form-control" style="max-width: 100px;">Submit</button>
  </center>
</form>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                login: {},
                data: ""
            }
        },
        methods: {
            
            loginaccount()
            {  
                this.axios.post('http://localhost:8000/login', this.login)
                    .then(response => (
                        this.loginmethod(response)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            loginmethod(response)
            {
                    this.data = response.data;
                    if(this.data == "Success")
                    {
                        window.location.href = "home";
                    }
                    else
                    {
                        alert(this.data);
                    }
            }
            
        }
    }
</script>