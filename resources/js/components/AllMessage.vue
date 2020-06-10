<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
      
    </ul>

    <!-- SEARCH FORM -->
   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="m--10 badge badge-danger navbar-badge">{{unread}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
    
          <a  v-for='contact in contacts.slice(0,3)' :key='contact.id' :href="'/chatify/'+contact.id" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img :src="'/storage/users-avatar/' +contact
                    .avatar" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{contact.name}}
                  <span v-if='contact.active_status == 1' class="float-right text-sm text-success"><i class="fas fa-circle"></i></span>
                </h3>
                <p class="text-sm">{{contact.body}}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{contact.created_at | myTime}}</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="/chatify" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->


      <li v-if='this.user.role_id == 2' class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="m--10 badge badge-warning navbar-badge">{{instantTutors.length}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{instantTutors.length}} Notifications</span>
          <div class="dropdown-divider"></div>
          <router-link :to="'/instantTutor/' + instantTutor.id" v-for='instantTutor in instantTutors.slice(0,3)' :key='instantTutor.id' href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{instantTutor.user.name}} makes a instant request for<br> help with {{instantTutor.skills}} with {{instantTutor.chapter}}
            <span class="float-right text-muted text-sm">{{instantTutor.updated_at | myTime}}</span>
          </router-link>
          
          
         
          <div class="dropdown-divider"></div>
          <router-link to="instantTutorAll" class="dropdown-item dropdown-footer">See All Notifications</router-link>
        </div>
      </li>
        
         <li v-if='this.user.role_id == 3' class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="m--10 badge badge-warning navbar-badge">3</span>
        </a>
       <!--  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{instantTutors.length}} Notifications</span>
          <div class="dropdown-divider"></div>
          <router-link :to="'/instantTutor/' + instantTutor.id" v-for='instantTutor in instantTutors' :key='instantTutor.id' href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{instantTutor.user.name}} makes a instant request for<br> help with {{instantTutor.skills}} with {{instantTutor.chapter}}
            <span class="float-right text-muted text-sm">{{instantTutor.updated_at | myTime}}</span>
          </router-link>
          
          
         
          <div class="dropdown-divider"></div>
          <router-link to="instantTutor" class="dropdown-item dropdown-footer">See All Notifications</router-link>
        </div> -->
      </li>


      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
    export default {
    	props: {
            user: {
                type: Object,
                required: true
            }
        },
        data(){
        	return {
        		contacts: [],
            instantTutors: '',
            contacts_id: [0],
        	} 
        },
        methods: {
          getInstantTutor(){
            axios.get('api/getInstantTutor')
            .then((response) => {
              this.instantTutors = response.data
              
            }).catch((e)=>{
              console.log(e)
            })
          },
        	getContacts(){
        		axios.get('api/contacts')
        		.then((response) => {
              this.contacts = response.data.filter(e => e.unread == 1)
        			
        		}).catch((e)=>{
        			console.log(e)
        		})
        	},
          getUniqueContacts(){
             axios.get('api/uniqueContacts')
                    .then((response) => {
                          let contact_id = []
                      $.each(response.data,function(index, value){
                       return contact_id.push(value.id)
                     });
                      return this.contacts_id = contact_id
            })
          },
        },
        computed: {
          unread(){
               let sum = 0;
                 for(let i = 0; i < this.contacts.length; i++){
                 sum += (parseFloat(this.contacts[i].unread));
                 }
            return sum;
          }
         },
        created() {
            this.getContacts();
            this.getInstantTutor();
        }
    }
</script>
<style scoped>
    .m--10{
        margin: -10px;
    }
</style>
            