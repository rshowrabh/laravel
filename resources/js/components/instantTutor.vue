<template>
    <div class="container">
        <div v-if="student.id == $route.params.id" class="row justify-content-center" v-for='student in instantTutors' :key='student.id'>
            <div class="col-md-3">
               
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="'/storage/users-avatar/'+ student.user.avatar" alt="User profile picture">
                  </div>

                <h3 class="profile-username text-center">{{student.user.name}}</h3>

                

                <ul class="list-group list-group-unbordered mb-3">
                  <li v-if='student.user.active_status == 1' class="list-group-item">
                    <b>Active Now</b>
                  </li>
                  <li v-else class="list-group-item">
                    <b>Offline</b>
                  </li>
                  
                </ul>
              </div>
              <!-- /.card-body -->
            
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <div class="text-center">
                  <img class=" img-fluid " :src="'/storage/users-image/'+ student.image" alt="User profile picture">
                  </div>

                

                

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Subject : {{student.skills}}</b>
                  </li>
                  <li class="list-group-item">
                    <b>Chapter : {{student.chapter}}</b>
                  </li>
                  <li  class="list-group-item">
                    <b>${{student.amount}}</b>
                  </li>
                  
                </ul>

                <div v-show="!contacts_id.includes(student.user.id)" class="form-group">
                  <textarea v-model='message' class="form-control"></textarea>
                  <button id="sentMessage" @click="sendMessageServer(student)" class="btn btn-success">Send Message</button>
                </div>

                 
                        <span v-show="contacts_id.includes(student.user.id)" class="badge">Already Sent</span>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                contacts_id: [0],
                instantTutors: '', 
                message: '',
            }
        },
        methods: {
          sendMessageServer(student) {
                this.$Progress.start();
                axios.post('api/conversation/send', {
                    contact_id: student.user.id,
                    body: this.message
                }).then((response) => {
                    swal({
                        title: "Good job!",
                        text: "Message send to" + student.user.name,
                        icon: "success",
                        button: "Go back",
                    });
                    Fire.$emit('AfterCreate');
                    $('#exampleModal').modal('hide')
                    this.$Progress.finsih();
                     
                }).catch((error) => {
                    this.$Progress.fail();
                })
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
            getInstantTutor(){
            axios.get('api/getInstantTutor')
            .then((response) => {
              this.instantTutors = response.data
              
            }).catch((e)=>{
              console.log(e)
            })
          },
        },
        created() {
            this.getInstantTutor();
            this.getContacts();
            Fire.$on('AfterCreate', () => {
               this.getInstantTutor();
            this.getContacts();
             })
        }
    }
</script>
