<template>
<div>
<fieldset style="margin-top: 20px">
  <div class="table-responsive">
    <section id="payment">
      <legend style="text-align: center;">Inventory</legend>
          
            <table class="table" id="mytable">
              <thead>
                <tr style="text-align: center;">
                  <th>#</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Quantity</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
            <tr v-for="data in pdata" :key="data.id" style="text-align: center;">
                <td>{{ data.id }}</td>
                <td>{{ data.product }}</td>
                <td>{{ data.category }}</td>
                <td>{{ data.quantity }}</td>
                <td>{{ data.description }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <Button class="btn btn-primary" @click="show(data.id)">Inventory
                        </Button>
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
              <h5 class="modal-title" id="exampleModalLabel">Inventory</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Product: {{editdata.product}}</label>
              </div>
              
              <div class="form-group">
                <label>Category: {{editdata.category}}</label>
              </div>
                <label>Quantity</label>
                  <input type="number" class="form-control product_name"  placeholder="Description" v-model="editdata.quantity" required>
              <div class="form-group">
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
                pdata: [],
                id: 0,
                editdata:{
                  product : "",
                  category : "",
                  quantity: 0
                }
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
            displayproducts()
            {
              this.axios
                .get('http://localhost:8000/api/products')
                .then(response => {
                    this.pdata = response.data;
                });
            },
            show(id)
            {
                this.id = id;
                for(let x=0;x < this.pdata.length;x++)
                {
                    if(id == this.pdata[x].id)
                    {
                        this.editdata.category  = this.pdata[x].category;
                        this.editdata.product  = this.pdata[x].product;
                        this.editdata.quantity  = this.pdata[x].quantity;
                    }
                }
                $('#EditModal').modal('show');
            },
            edit()
            {
                 this.axios
                    .post(`http://localhost:8000/api/inventory/${this.id}`,this.editdata)
                    .then(response => {
                        this.message(response);
                        this.displayproducts();
                        $('#EditModal').modal('hide');
                    });
            }
      },
      created()
      {
          this.displayproducts();
      }
    }
</script>