<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student Request</h3>

               <!--  <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table" id='example1'>
                  <thead>
                    <tr>
                      <th>Task</th>  
                      <th>Ammount</th>  
                   <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="student in students" :key="student.id">
                      <td>{{student.user.name}} would like to get help in {{student.class}} grade {{student.skills}}.</td>

                      <td>${{student.amount}}</td>
                      <td>


                        <span style="cursor: pointer;" v-show="!contacts_id.includes(student.id)" id="sentMessage"
                                                @click="sendMessage(student)" class="badge bg-success">Send Message</span>
                        <span v-show="contacts_id.includes(student.id)" class="badge">Already Sent</span>


                    </td>
                    </tr>

                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLabel">Add New</h5> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <h2>Name : {{form.name}}</h2>
                            </div>

                            <div class="form-group">
                                <h3>Email : {{form.email}}</h3>
                            </div>

                            <div class="form-group">
                                <label for="">Enter Your Message</label>
                                <textarea class="form-control" v-model="message" id="" rows="4"></textarea>
                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button  @click.prevent="sendMessageServer" type="submit" class="btn btn-success">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                students: [],
                contacts_id: [0],
                message: '',
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    message: '',
                })
            } 
        },
        methods: {
            
            sendMessage(student) {
                $('#exampleModal').modal('show')
                this.form.reset()
                this.message = ''
                this.form.fill(student.user)
            },
             getContacts() {
                axios.get('api/uniqueContacts')
                    .then((response) => {
                         let contact_id = []
                      $.each(response.data,function(index, value){
                       return contact_id.push(value.id)
                     });
                      return this.contacts_id = contact_id
                    })
            },
            getStudent() {
                axios.get('api/student_request')
                    .then((response) => {
                        this.students = response.data
                    })
            },
            sendMessageServer() {
                this.$Progress.start();
                axios.post('api/conversation/send', {
                    contact_id: this.form.id,
                    body: this.message
                }).then((response) => {
                    swal({
                        title: "Good job!",
                        text: "Message send to" + this.form.name,
                        icon: "success",
                        button: "Go back",
                    });
                    Fire.$emit('AfterCreate');
                    $('#exampleModal').modal('hide')
                    this.$Progress.finsih();
                     
                }).catch((error) => {
                    this.$Progress.fail();
                })
            }
        },
        created() {
               this.getStudent();
               this.getContacts();
            Fire.$on('AfterCreate', () => {
               this.getStudent();
               this.getContacts();
             })
            
        },
        mounted() {

          setTimeout(() => {
            $('#example1').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
          },1000)
                 

  
        }
    }

</script>
