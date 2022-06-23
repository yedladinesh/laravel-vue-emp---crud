<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'EmployeeIndex' }" class="btn btn-primary btn-sm float-right mb-2">Back</router-link>
            </div>
            <form @submit.prevent="updateEmployee">
                <div class="row">
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="employee.name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" v-model="employee.email">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="text" class="form-control" v-model="employee.email">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" v-model="employee.address">
                            </div>
                            <div class="form-group">
                                <label>DOB</label>
                                <input type="date" class="form-control" v-model="employee.dob">
                            </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="number" class="form-control" v-model="employee.phone">
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
                employee: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/employee/${this.$route.params.employeeId}`)
                .then((res) => {
                    this.employee = res.data;
                });
        },
        methods: {
            updateEmployee() {
                this.axios
                    .patch(`http://localhost:8000/api/employee/${this.$route.params.employeeId}`, this.employee)
                    .then((res) => {
                        this.$router.push({ name: 'EmployeeIndex' });
                    });
            }
        }
    }
</script>