<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tutor Standard</div>

                    <div class="card-body">
                        <form class="form-horizontal">

                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-6">
                                            <label for="inputExperience" class="col-form-label ml-3">Subject</label>
                                          <div class="col-sm-12">
                                            <label for="">{{formInfo.skills}} <span class=' ml-3 btn btn-sm btn-danger'
                                                    @click="clearSkills">Clear</span> </label>

                                              <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Select Subject
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                                    <button  v-for="data in skills" :key="data.id" class="dropdown-item"
                                                        v-on:click.prevent="multipleSkills(data.name)">{{data.name}}</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="inputExperience" class="col-form-label ml-3">Grades</label>
                                          <div class="col-sm-12">
                                            <label for="">{{formInfo.class}} <span class=' ml-3 btn btn-sm btn-danger'
                                                    @click="clearClass">Clear</span> </label>

                                              <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Select Grades
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                                    <button  v-for="data in grades" :key="data.id" class="dropdown-item"
                                                        v-on:click.prevent="multipleClass(data.name)">{{data.name}}</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-12">
                                            <label>Select Day Per Week</label>
              <input v-model="formInfo.day" type="number" 
               class="form-control" :class="{ 'is-invalid': formInfo.errors.has('day') }" placeholder="Enter Day per Week">
              <has-error :form="formInfo" field="day"></has-error>
                                        </div>
                                     </div>
                                      <div class="form-row">
                                      <div class="form-group col-12">
                                            <label>Select Ammount</label>
              <input v-model="formInfo.amount" type="number" 
               class="form-control" :class="{ 'is-invalid': formInfo.errors.has('amount') }" placeholder="in $(dollar)">
               
              <has-error :form="formInfo" field="amount"></has-error>
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
                                <div class="col-sm-10">
                                     <button @click.prevent='updateInfo' type="submit"
                                        class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tutor Instant</div>

                    <div class="card-body">
                        <form class="form-horizontal">

                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-6">
                                            <label for="inputExperience" class="col-form-label ml-3">Subject</label>
                                          <div class="col-sm-12">
                                            <label for="">{{form.skills}} <span class=' ml-3 btn btn-sm btn-danger'
                                                    @click="clearSkillsNew">Clear</span> </label>

                                              <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Select Subject
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                                    <button  v-for="data in skills" :key="data.id" class="dropdown-item"
                                                        v-on:click.prevent="multipleSkillsNew(data.name)">{{data.name}}</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-6">
                                            <img width="200px" class="img-circle" :src="getImage()" alt="Attatchment">
                                        </div>
                                       
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-12">
                                            <label>Chapter</label>
              <input v-model="form.chapter" type="text" 
               class="form-control" :class="{ 'is-invalid': form.errors.has('chapter') }" placeholder="Enter Chapter">
              <has-error :form="form" field="chapter"></has-error>
                                        </div>
                                     </div>
                                     <div class="form-row">
                                      <div class="form-group col-12">
                                            <label>Image</label>
              <input :class="{ 'is-invalid': form.errors.has('image') }" type="file"
                                                class="form-control" id="image" placeholder="Skills"
                                                @change="updateProfile">
              <has-error :form="form" field="image"></has-error>
                                        </div>
                                     </div>
                                      <div class="form-row">
                                      <div class="form-group col-12">
                                            <label>Select Ammount</label>
              <input v-model="form.amount" type="number" 
               class="form-control" :class="{ 'is-invalid': form.errors.has('amount') }" placeholder="in $(dollar)">
               
              <has-error :form="form" field="amount"></has-error>
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
                                <div class="col-sm-10">
                                     <button @click.prevent='updateInstantTutor' type="submit"
                                        class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                skills: '',
                grades: '',
                formInfo: new Form({
                    id: '',
                    class: '',
                    skills: '',
                    day: '',
                    amount: '',
                }),
                form: new Form({
                    skills: '',
                    chapter: '',
                    image: '',
                    amount: '',
                })
            }
        },
        methods: {
            getImage() {
                if(this.form.image){
                let image = (this.form.image.length > 100) ? this.form.image : '/storage/users-image/' + this.form
                    .image;
                return image;
                }
            },
            getInstantTutor(){
                 axios.get('api/instantTutor')
                    .then((responses) => {
                        this.form.fill(responses.data);
                        Fire.$emit('AfterCreated')
                        })
                    
                    .catch(errors => {
                        // react on errors.
                        console.error(errors);
                    });
            },
            updateInstantTutor() {
                this.$Progress.start();
                this.form.put('api/instantTutor')
                    .then(() => {
                        swal("Poof! Your imaginary file has been updated!", {
                            icon: "success",
                        });
                        this.$Progress.finish();
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
                        this.form.image = reader.result;
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
            multipleSkillsNew(val) {
                 
                 if (this.form.skills == null || this.form.skills == '') {
                    return this.form.skills = val
                } else {
                     if(!this.form.skills.split(',').includes(val)){
                    this.form.skills = this.form.skills + ',' + val
                    return this.form.skills = this.form.skills.split(',').sort().join(',');
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
            clearSkillsNew() {
                return this.form.skills = ''
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
            updateInfo() {
                this.$Progress.start();
                this.formInfo.put('api/profile/ex')
                    .then(() => {
                        swal("Poof! Your imaginary file has been updated!", {
                            icon: "success",
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            getData() {
               
                axios.get('api/profile/ex')
                    .then((responses) => {
                        this.formInfo.fill(responses.data);
                        Fire.$emit('AfterCreated')
                        })
                    
                    .catch(errors => {
                        // react on errors.
                        console.error(errors);
                    });


            },
        },
      
        created() {
           
            this.getData();
            this.getSkills();
            this.getGrades();
            this.getInstantTutor();
        },
    }

</script>
