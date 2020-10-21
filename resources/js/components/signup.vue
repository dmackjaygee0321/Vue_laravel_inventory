<template>
    <div>   

        <form style="padding: 30px; text-align: center;" @submit.prevent="addaccount">
            
        <h1>Sign Up</h1> 
        
  <div class="form-group row" style="padding-top: 50px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" placeholder="email@example.com" v-model="account.email" required>
    </div>
  </div>     
  <div class="form-group row" style="padding-top: 30px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="uname123" v-model="account.uname" required>
    </div>
  </div>
  <div class="form-group row"   style="padding-top: 30px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" v-model="account.password" required>
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
                account: {},
                data: []
            }
        },
        methods: {
            
            addaccount() {
                    this.axios.post('http://localhost:8000/api/addaccount', this.account)
                    .then(response => (
                      this.message(response)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)                    
            },
            message(response)
            {
                        alert(response.data);
                        if(response.data == "The Account successfully added")
                        {
                            this.$router.push({path : '/login'});
                        }
            }
        }
    }
</script>