<template>
    <div>
        <h3 class="text-center">Create Employee</h3>

        <div class="col-md-12">
            <router-link :to="{ name: 'EmployeeIndex' }" class="btn btn-primary btn-sm float-right mb-2">Back
            </router-link>
        </div>

        <form @submit.prevent="addEmployee">
            <div class="row">
                 
                <div class="alert alert-danger" v-if="errors.length">
                    <ul>
                        <li v-for="(error, key) of errors">{{ error }}</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="employee.name" required>
                        <span v-if="errors.name" :class="['label label-danger']">{{ errors.name[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="employee.email" required>
                        <span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>
                    </div>
                    <!-- <div class="form-group">
                        <label>Image</label>
                        <input type="text" class="form-control" v-model="employee.email">
                    </div> -->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" v-model="employee.address" required>
                        <span v-if="errors.address" :class="['label label-danger']">{{ errors.address[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label>DOB</label>
                        <input type="date" class="form-control" v-model="employee.dob" min="1950-01-01" max="2017-04-20">
                        <span v-if="errors.dob" :class="['label label-danger']">{{ errors.dob[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="number" class="form-control" v-model="employee.phone">
                        <span v-if="errors.phone" :class="['label label-danger']">{{ errors.phone[0] }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            employee: {},
            errors: [],
        }
    },
    methods: {
        addEmployee() {
            this.axios
                .post('http://localhost:8000/api/employee', this.employee)
                .then(response => (
                    this.$router.push({
                        name: 'EmployeeIndex'
                    })
                ))
                .catch(err => {
                    this.errors = err.response.data.errors;
                    console.log(this.errors)
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>