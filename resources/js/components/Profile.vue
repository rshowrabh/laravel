<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">

                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white"
                        style="background: url('dist/img/photo1.png') center center;">
                        <h3 class="widget-user-username text-right">{{this.form.name}}</h3>
                        <h5 class="widget-user-desc text-right"></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfile()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->

            </div>
            <div class="col-12 mt-3">

                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <!-- <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                            </li> -->
                            <li class="nav-item"><a class="nav-link" href="#info" data-toggle="tab">Info</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            
                           
                            <!-- /.tab-pane -->

                            <!-- info tab -->

                            <div class="tab-pane active" id="info">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Eduaction</label>
                                        <div class="col-sm-10">
                                            <input :class="{ 'is-invalid': form.errors.has('education') }"
                                                v-model="formInfo.education" type="text" class="form-control"
                                                id="inputEducation" placeholder="Education">
                                            <has-error :form="form" field="education"></has-error>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Highest Academic
                                            Level</label>
                                        <div class="col-sm-10">
                                            <select :class="{ 'is-invalid': form.errors.has('highest_academic_level') }"
                                                v-model="formInfo.highest_academic_level" type="text"
                                                class="form-control" id="inputhighest_academic_level"
                                                placeholder="Highest Academic Level">
                                                <option v-for="data in academic" :key="data.id" :value="data.name">
                                                    {{data.name}}</option>
                                            </select>
                                            <has-error :form="form" field="highest_academic_level"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-row" v-show="tutormode">
                                        <div class="form-group col-4 offset-2">
                                            <label for="inputExperience" class="col-form-label">Skills</label>
                                          <div class="col-sm-12">
                                            <label for="">{{formInfo.skills}} <span class=' ml-3 btn btn-sm btn-danger'
                                                    @click="clearSkills">Clear</span> </label>

                                              <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Select Skills
                                                </button>
                                                <!-- v-if="!formInfo.skills.split(',').includes(data.name)" -->
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                                    <button  v-for="data in skills" :key="data.id" class="dropdown-item"
                                                        v-on:click.prevent="multipleSkills(data.name)">{{data.name}}</button>
                                                </div>
                                            </div>
                                            <has-error :form="form" field="skills"></has-error>
                                        </div>
                                        </div>
                                        <div class="col-6 form-group">
                                            <label for="inputExperience" class="col-form-label">Grades</label>
                                        <div class="col-sm-12">
                                            <label for="">{{formInfo.class}} <span class=' ml-3 btn btn-sm btn-danger'
                                                    @click="clearClass">Clear</span> </label>

                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Select Grade
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <button  v-for="data in grades" :key="data.id" class="dropdown-item"
                                                        v-on:click.prevent="multipleClass(data.name)">{{data.name}}</button>
                                                </div>
                                            </div>

                                            <has-error :form="form" field="class"></has-error>
                                        </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row" v-show="tutormode">
                                        
                                    </div>


                                    <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div> -->
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button @click.prevent='updateInfo' type="submit"
                                                class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!--  -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input :class="{ 'is-invalid': form.errors.has('name') }"
                                                v-model="form.name" type="text" class="form-control" id="inputName"
                                                placeholder="Name">
                                            <has-error :form="form" field="name"></has-error>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input :class="{ 'is-invalid': form.errors.has('last_name') }"
                                                v-model="form.last_name" type="text" class="form-control" id="inputLastName"
                                                placeholder="Name">
                                            <has-error :form="form" field="last_name"></has-error>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input :class="{ 'is-invalid': form.errors.has('phone') }"
                                                v-model="form.phone" type="text" class="form-control" id="inputLastName"
                                                placeholder="Name">
                                            <has-error :form="form" field="phone"></has-error>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input :class="{ 'is-invalid': form.errors.has('email') }"
                                                v-model="form.email" type="email" class="form-control" id="inputEmail"
                                                placeholder="Email">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label for="avatar" class="col-sm-2 col-form-label">Photo</label>
                                        <div class="col-sm-10">
                                            <input :class="{ 'is-invalid': form.errors.has('avatar') }" type="file"
                                                class="form-control" id="avatar" placeholder="Skills"
                                                @change="updateProfile">
                                            <has-error :form="form" field="avatar"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" v-model="form.password" class="form-control"
                                                id="inputExperience">
                                            <p>Leave blank to unchange</p>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div> -->
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button @click.prevent='updateSetting' type="submit"
                                                class="btn btn-danger">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->

            </div>
        </div>

    </div>
</template>

<script>
    export default {

        data() {
            return {
                academic: '',
                skills: '',
                grades: [],
                tutormode: false,
                form: new Form({
                    id: '',
                    name: '',
                    last_name: '',
                    phone: '',
                    email: '',
                    password: '',
                    type: '',
                    avatar: '',
                }),
                formInfo: new Form({
                    education: '',
                    class: '',
                    skills: '',
                    highest_academic_level: '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },


        methods: {
            multipleSkills(val) {
                if (this.formInfo.skills == null || this.formInfo.skills == '') {
                    return this.formInfo.skills = val
                } else {
                     if(!this.formInfo.skills.split(',').includes(val)){
                    this.formInfo.skills = this.formInfo.skills + ',' + val
                    return this.formInfo.skills = this.formInfo.skills.split(',').sort().join(',');
                    }
                }
            },
            multipleClass(val) {
                if (this.formInfo.class == null || this.formInfo.class == '') {
                    return this.formInfo.class = val
                } else {
                   if(!this.formInfo.class.split(',').includes(val)){
                    this.formInfo.class = this.formInfo.class + ',' + val
                    return this.formInfo.class = this.formInfo.class.split(',').sort().join(',');
                    }
                }
            },
            clearClass() {
                return this.formInfo.class = ''
            },
            clearSkills() {
                return this.formInfo.skills = ''
            },
            getAcademic() {
                axios.get('api/academic')
                    .then((response) => {
                        this.academic = response.data
                    })
            },
            getSkills() {
                axios.get('api/skill')
                    .then((response) => {
                        this.skills = response.data
                    })
            },
            getGrades() {
                axios.get('api/grade')
                    .then((response) => {
                        this.grades = response.data

                        // response.data.map(obj => {
                        //     this.grades.push(obj.name)
                        //   })
                    })
            },
            getProfile() {
                if(this.form.avatar){
                let avatar = (this.form.avatar.length > 100) ? this.form.avatar : '/storage/users-avatar/' + this.form
                    .avatar;
                return avatar;
                }
            },
            updateInfo() {
                this.$Progress.start();
                this.formInfo.put('api/profile/ex')
                    .then(() => {
                        swal("Poof! Your imaginary file has been updated!", {
                            icon: "success",
                        });
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            updateSetting() {
                this.$Progress.start();
                this.form.put('api/profile')
                    .then(() => {
                        swal("Poof! Your imaginary file has been updated!", {
                            icon: "success",
                        });
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            updateProfile(e) {
                // console.log('uploading')
                let file = e.target.files[0];
                var reader = new FileReader();
                if (file['size'] < 2000000) {
                    reader.onloadend = (file) => {
                        this.form.avatar = reader.result;
                        // console.log('RESULT', reader.result)
                    }
                } else {
                    swal({
                        type: 'error',
                        title: 'ops',
                        text: 'large file'
                    })
                }
                reader.readAsDataURL(file);
            },
            getData() {
                let one = "api/profile";
                let two = "api/profile/ex";

                const requestOne = axios.get(one);
                const requestTwo = axios.get(two);
                axios
                    .all([requestOne, requestTwo])
                    .then(
                        axios.spread((...responses) => {

                            const responseOne = responses[0];
                            const responseTwo = responses[1];
                            this.form.fill(responseOne.data);
                            
                            this.formInfo.fill(responseTwo.data);

                            if (responseOne.data.role_id == 2) {
                                this.tutormode = true;
                            } else if (responseOne.data.role_id == 3) {
                                this.tutormode = false;
                            }


                        })
                    )
                    .catch(errors => {
                        // react on errors.
                        console.error(errors);
                    });


            },
        },

        created() {
            this.getData();
            this.getAcademic();
            this.getSkills();
            this.getGrades();
        },
    }

</script>
