<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title">List of grade Item</h3>

                 <div class="card-tools">
                <form @submit.prevent="editMode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
                  <input v-model="form.name" type="name" name="name"
                     :class="{ 'is-invalid': form.errors.has('name') }" placeholder="name">
                   <has-error :form="form" field="name"></has-error>
       
                  <button type="submit" class="btn btn-primary"  v-show="!editMode"> Add New</button>
                  <button type="submit" class="btn btn-primary"  v-show="editMode"> Update</button>
                   </form>
                </div>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr  v-for="data in datas" :key='data.id'>
                    <td>{{data.id}}</td>
                    <td>{{data.name}}</td>
                    <td><a  class="btn btn-info" href="#" @click="edit(data)">Edit</a>
                    <td><span class="btn btn-danger" @click="destroy(data.id)">Delete</span></td>
                  </tr>
                  </tbody>

                </table>


                
              </div>
            </div>
        
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data(){
        return {
          editMode:false,
          datas:{},
            form: new Form({
              id : '',
              name: '',
              created_at: '',
            })
        }
      },
      methods: {
        edit(user){
            this.editMode = true,
            this.form.reset()
            this.form.fill(user)
          }, 
        createUser(){
          this.$Progress.start();
            this.form.post('api/grade').then(() => {
                 Fire.$emit('AfterCreate');
            swal({
              title: "Good job!",
              text: "User created Succesfully",
             icon: "success",
             button: "Go back",
               });
            this.$Progress.finish();
            }).catch((error) => {
              swal({
              title: "Admin Only",
             icon: "warning",
             button: "Go back",
               });
              this.$Progress.fail();
            });
           
        },
        updateUser(){
          this.$Progress.start();
             this.form.put('api/grade/'+ this.form.id)
            .then(() => {
              swal("Poof! Your imaginary file has been updated!", {
                icon: "success",
            });
            Fire.$emit('AfterCreate');
            this.$Progress.finish();
            this.form.reset();
            })
            .catch(() => {
              this.$Progress.fail();
            })
        },
        loadgrade(){
          axios.get('api/grade')
          .then((response) => {
            this.datas = response.data
          })
        },
        destroy($id){
              swal({
           title: "Are you sure?",
           text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
           dangerMode: true,
})

    .then((willDelete) => {
     
     if(willDelete){
       this.form.delete('api/grade/'+$id).then( () => {
         swal("Poof! Your imaginary file has been deleted!", {
         icon: "success",
             });
       Fire.$emit('AfterCreate');
       })
     }else{
       swal("Your imaginary file is safe!");
     }
 
});
          }
      },
        created() {
            this.loadgrade();
            Fire.$on('AfterCreate', () => {
               this.loadgrade();
               this.editMode = false;
             })
        },
        mounted() {

          setTimeout(() => {
            $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
          },1000)
                 

  
        }
    }
</script>
