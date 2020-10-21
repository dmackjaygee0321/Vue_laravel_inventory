<template>
<div>
        <form style="padding: 30px; text-align: center;" @submit.prevent="addcategory()">
        <h3>Add Category</h3> 
        
  <div class="form-group row" style="padding-top: 50px; max-width: 500px; text-align: center; margin: 0 auto;">
    <label for="staticEmail" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" v-model="newdata.cname"  required>
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
      <legend style="text-align: center;">View Categories</legend>
          
            <table class="table" id="mytable">
              <thead>
                <tr style="text-align: center;">
                  <th>#</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
            <tr v-for="data in datas" :key="data.id" style="text-align: center;">
                <td>{{ data.id }}</td>
                <td>{{ data.category }}</td>
                <td>{{ data.description }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <Button class="btn btn-primary" @click="showedit(data.id)">Edit
                        </Button>
                        <button class="btn btn-danger" @click="deletecat(data.id)">Delete</button>
                    </div>
                </td>
            </tr>

              </tbody>
              
            </table>
        </section>
</div>
</fieldset>


   <form  @submit.prevent="editcat()">
       <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <input type="text" class="form-control product_name" placeholder="Category Name" v-model="editdata.category" required>
              </div>

              <div class="form-group">
                  <input type="text" class="form-control product_name"  placeholder="Description" v-model="editdata.description" required>
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
                  category: "",
                  description: ""
                },
                datas: [],
                id: 0
            }
        },
      methods:
      {
          addcategory()
          {
                    this.axios.post('http://localhost:8000/api/addcategory', this.newdata)
                    .then(response => (
                      this.message(response)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)      
          },
            message(response)
            {
                        alert(response.data);
                        
                        if(response.data == "The Category successfully added")
                        {
                            this.display();
                            this.newdata.cname = "";
                            this.newdata.desc = "";
                            //this.$router.push({path : '/category'});
                        }
            },
            display()
            {
              this.axios
                .get('http://localhost:8000/api/categories')
                .then(response => {
                    this.datas = response.data;
                });
            },
            deletecat(id) {
                this.axios
                    .delete(`http://localhost:8000/api/deletecategory/${id}`)
                    .then(response => {
                        this.message(response);
                        this.display();
                    });
            },
            showedit(id) {
                this.id = id;
                for(let x=0;x < this.datas.length;x++)
                {
                    if(id == this.datas[x].id)
                    {
                        this.editdata.category  = this.datas[x].category;
                        this.editdata.description  = this.datas[x].description;
                    }
                }
                $('#EditModal').modal('show');
            },
            editcat() {
                 this.axios
                    .post(`http://localhost:8000/api/updatecategory/${this.id}`,this.editdata)
                    .then(response => {
                        this.message(response);
                        this.display();
                        if(response.data != "Category is already exist")
                        $('#EditModal').modal('hide');
                    });
            }
      },
      created()
      {
          this.display();
      }
    }
</script>