<template>
<div>
        <form style="padding: 30px; text-align: center;" @submit.prevent="addproduct()">
        <h3>Add Product</h3> 
        
  <div class="form-group row" style="padding-top: 50px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="staticEmail" class="col-sm-2 col-form-label">Product</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" v-model="newdata.pname"  required>
    </div>
  </div>     
  <div class="form-group row" style="padding-top: 30px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="staticEmail" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
      <select class="form-control" v-model="newdata.cid">
          <option v-for="data in catdatas" :key="data.id" :value="data.id">
            {{data.category}}
          </option>
      </select>
    </div>
  </div>  
  <div class="form-group row" style="padding-top: 30px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" v-model="newdata.desc"  required>
    </div>
  </div>
  <center style="margin-top:50px">
        <button class="form-control" style="max-width: 100px;">Submit</button>
  </center>
</form>


<fieldset style="padding:100px">
  <div class="table-responsive">
    <section id="payment">
      <legend style="text-align: center;">View Product</legend>
          
            <table class="table" id="mytable">
              <thead>
                <tr style="text-align: center;">
                  <th>#</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
            <tr v-for="data in pdata" :key="data.id" style="text-align: center;">
                <td>{{ data.id }}</td>
                <td>{{ data.product }}</td>
                <td>{{ data.category }}</td>
                <td>{{ data.description }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <Button class="btn btn-primary" @click="show(data.id)">Edit
                        </Button>
                        <button class="btn btn-danger" @click="deleteprod(data.id)">Delete</button>
                    </div>
                </td>
            </tr>

              </tbody>
              
            </table>
        </section>
</div>
</fieldset>


   <form @submit.prevent="edit()">
       <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <input type="text" class="form-control product_name" placeholder="Product Name"  v-model="editdata.product" required>
              </div>
              
              <div class="form-group">
      <select class="form-control" v-model="editdata.cid">
          <option v-for="data in catdatas" :key="data.id" :value="data.id">
            {{data.category}}
          </option>
      </select>
              </div>

              <div class="form-group">
                  <input type="text" class="form-control product_name"  placeholder="Description"  v-model="editdata.description" required>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="id" class="product_id">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </div>
       </div>
  </form>

</div>
</template>


<script>
    export default {
        data() {
            return {
                newdata: {},
                editdata: {
                  product: "",
                  cid: 0,
                  description: ""
                },
                catdatas: [],
                pdata: [],
                id: 0
            }
        },
      methods:
      {
            message(response)
            {
                        alert(response.data);
                        if(response.data == "The Product successfully added")
                        {
                            this.displayproducts();
                            this.newdata.pname = "";
                            this.newdata.desc = "";
                            //this.$router.push({path : '/category'});
                        }
            },
            display()
            {
              this.axios
                .get('http://localhost:8000/api/categories')
                .then(response => {
                    this.catdatas = response.data;
                    if(this.catdatas.length > 0)
                    {
                       this.newdata.cid = this.catdatas[0].id;
                    }
                });
            },
            addproduct()
            {
                  this.axios.post('http://localhost:8000/api/addproduct', this.newdata)
                    .then(response => (
                      this.message(response)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)  
            },
            displayproducts()
            {
              this.axios
                .get('http://localhost:8000/api/products')
                .then(response => {
                    this.pdata = response.data;
                });
            },
            deleteprod(id) {
                this.axios
                    .delete(`http://localhost:8000/api/deleteproduct/${id}`)
                    .then(response => {
                        this.message(response);
                        this.displayproducts();
                    });
            },
            show(id)
            {
                this.id = id;
                for(let x=0;x < this.pdata.length;x++)
                {
                    if(id == this.pdata[x].id)
                    {
                        this.editdata.product  = this.pdata[x].product;
                        this.editdata.cid = this.pdata[x].cid;
                        this.editdata.description  = this.pdata[x].description;
                    }
                }
                $('#EditModal').modal('show');
            },
            edit() {
                 this.axios
                    .post(`http://localhost:8000/api/updateproduct/${this.id}`,this.editdata)
                    .then(response => {
                        this.message(response);
                        this.displayproducts();
                        if(response.data != "Product is already exist")
                        $('#EditModal').modal('hide');
                    });
            }
      },
      created()
      {
          this.display();
          this.displayproducts();
      }
    }
</script>