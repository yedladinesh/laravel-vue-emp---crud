<template>
    <div>
        <h3 class="text-center">Create Employee</h3>
           
            <div class="col-md-12">
                <router-link :to="{ name: 'EmployeeIndex' }" class="btn btn-primary btn-sm float-right mb-2">Back</router-link>
            </div>

                <form @submit.prevent="addEmployee">
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
                    <!-- <div class="form-group">
                        <label>Image</label>
                        <input type="text" class="form-control" v-model="employee.email">
                    </div> -->
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
                    <button type="submit" class="btn btn-primary" >Create</button>
                </div>
                
        </div>
                </form>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                employee: {}
            }
        },
        methods: {
            addEmployee() {
                this.axios
                    .post('http://localhost:8000/api/employee', this.employee)
                    .then(response => (
                        this.$router.push({ name: 'EmployeeIndex' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>