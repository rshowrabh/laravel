<template>

    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Of Users</h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-primary" @click="newModal">Add User</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                role="grid" aria-describedby="example1_info">
                                <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-sort="ascending" aria-label="ID: activate to sort column descending">ID</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Name: activate to sort column ascending">Name</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Email: activate to sort column ascending">Email</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Role version: activate to sort column ascending">Role</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Register At: activate to sort column ascending">Register At</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Action: activate to sort column ascending">Action</th>
                    </tr>
                  </thead>
                                <tbody>
                                  <tr role="row" class="odd" v-for="user in users" :key='user.id'>
                      <td class="sorting_1 dtr-control" tabindex="0">{{user.id}}</td>
                      <td>{{user.name}} </td>
                      <td>{{user.email}}</td>
                      <td style="text-transform:capitalize">{{user.role.name}}</td>
                      <td>{{user.created_at | myDate}}</td>
                      <td><a class="pr-2" href="#" @click="editModal(user)">Edit</a><a href="#"
                          @click="destroy(user.id)">Delete</a></td>
                    </tr>
                    
                                </tbody>
                                <tfoot>
                                    <tr>
                      <th rowspan="1" colspan="1">ID</th>
                      <th rowspan="1" colspan="1">Name</th>
                      <th rowspan="1" colspan="1">Email</th>
                      <th rowspan="1" colspan="1">Type</th>
                      <th rowspan="1" colspan="1">Register At</th>
                      <th rowspan="1" colspan="1">Action</th>
                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                   
                </div>
            </div>
          </div>
            <!-- /.card-body -->
        </div>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-show="!editMode">Add New</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-show="editMode">Update User Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateUser() : create_user()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Name">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="email" name="email" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('email') }" placeholder="email">
                                <has-error :form="form" field="email"></has-error>
                            </div>



                            <div class="form-group">
                                <label>Role</label>
                                <select id="type" v-model="form.role_id" name="role" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('role_id') }">
                                    <option :value="1">Admin</option>
                                    <option :value="2">Tutor</option>
                                    <option :value="3">Student</option>

                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>


                            <div class="form-group">
                                <label>Password</label>
                                <input v-model="form.password" type="password" name="password" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('password') }" placeholder="password">
                                <span v-show="editMode">Leave Blank to unchange</span>
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-show="!editMode" type="submit" class="btn btn-success">Create User</button>
                            <button v-show="editMode" type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


</template>

<script>
    // import DataTable from '../../../node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js';
    // import DataTableBs4 from '../../../node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';
    // import DataTableRes from '../../../node_modules/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js';
    // import DataTableMin from '../../../node_modules/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js';
    export default {
        data() {
            return {
                editMode: false,
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    photo: '',
                    role_id: '',
                    role: {},
                })
            }
        },
        methods: {


            updateUser() {
                this.$Progress.start();
                this.form.put('api/user/' + this.form.id)
                    .then(() => {
                        swal("Poof! Your imaginary file has been updated!", {
                            icon: "success",
                        });
                        $('#exampleModal').modal('hide')
                        Fire.$emit('AfterCreate');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editModal(user) {
                this.editMode = true,
                    this.form.reset()
                $('#exampleModal').modal('show')
                this.form.fill(user)
            },
            newModal() {
                this.editMode = false,
                    this.form.reset()
                $('#exampleModal').modal('show')
            },
            create_user() {

                this.$Progress.start();
                this.form.post('api/user').then(() => {
                    Fire.$emit('AfterCreate');
                    swal({
                        title: "Good job!",
                        text: "User created Succesfully",
                        icon: "success",
                        button: "Go back",
                    });
                    this.$Progress.finish();
                    $('#exampleModal').modal('hide')
                }).catch((error) => {
                    swal({
                        title: "Admin Only",
                        icon: "warning",
                        button: "Go back",
                    });
                    this.$Progress.fail();
                });;

            },
            loadUsers() {
                axios
                    .get('api/user')
                    .then(response => {
                        this.users = response.data
                    })
                    .catch(error => console.log(error));
            },
            destroy($id) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })

                    .then((willDelete) => {

                        if (willDelete) {
                            this.form.delete('api/user/' + $id).then(() => {
                                swal("Poof! Your imaginary file has been deleted!", {
                                    icon: "success",
                                });
                                Fire.$emit('AfterCreate');
                            })
                        } else {
                            swal("Your imaginary file is safe!");
                        }

                    });
            }
        },

        created() {
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            })


            //  setInterval(() => {
            //    this.loadUsers();
            //  }, 3000);

        },

        mounted() {

          setTimeout(() => {
            $('#example1').DataTable({
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
<style scoped>
    /*@import '../../../node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'*/
    /*@import '../../../node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'*/

  

</style>
