<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'EmployeeIndex' }" class="btn btn-primary btn-sm float-right mb-2">Back</router-link>
            </div>
            <form @submit.prevent="updateEmployee" enctype="multipart/form-data">
             
                <div class="row">
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="employee.name">
                        <span v-if="errors.name" :class="['label label-danger']">{{ errors.name[0] }}</span>

                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" v-model="employee.email">
                        <span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>

                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input class="form-control" name="image" type="file" @change='uploadImage' accept="image/png, image/jpg">

                                <template v-if="previewImage">
                                    <img :src="previewImage" class="img-fluid editImg" />
                                </template>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" v-model="employee.address">
                        <span v-if="errors.address" :class="['label label-danger']">{{ errors.address[0] }}</span>

                            </div>
                            <div class="form-group">
                                <label>DOB</label>
                                <input type="date" class="form-control" v-model="employee.dob" min="1950-01-01" max="2017-04-20">
                        <span v-if="errors.dob" :class="['label label-danger']">{{ errors.dob[0] }}</span>

                            </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="number" class="form-control" v-model="employee.phone_number">
                        <span v-if="errors.phone_number" :class="['label label-danger']">{{ errors.phone_number[0] }}</span>

                            </div>
                            <button type="submit" class="btn btn-primary" >Update</button>
                        </div>
                        
                </div>
                        </form>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                employee: {
                    image: ''
                },
                previewImage: null,
                errors: [],
            }
        },
        created() {
            this.axios
                .get(`/api/employee/${this.$route.params.employeeId}`)
                .then((res) => {
                    this.employee = res.data;
                    if(res.data.image){
                        this.previewImage = '/assets/images/employee/'+res.data.image;
                    }
                });
        },
        methods: {
            updateEmployee() {
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    }
                }
                var form = new FormData();
                form.append('_method', 'PUT');
                form.append('image',this.employee.image);
                form.append('name',this.employee.name);
                form.append('address',this.employee.address);
                form.append('email',this.employee.email);
                form.append('phone_number',this.employee.phone_number);
                form.append('dob',this.employee.dob);
                
                this.axios
                    .post(`/api/employee/${this.$route.params.employeeId}`, form, config)
                    .then((res) => {
                        this.$router.push({ name: 'EmployeeIndex' });
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    });
            },

            // On image upload 
        uploadImage(e) {
                this.employee.image = e.target.files[0];
                this.previewImage = URL.createObjectURL(e.target.files[0]); 
            },
        }
    }
</script>