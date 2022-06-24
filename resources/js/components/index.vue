<template>
    <div class="container">
        <h2 class="text-center">Employee List</h2>
        <div class="row">
            <div class="col-md-6">
                <router-link :to="{ name: 'EmployeeCreate' }" class="btn btn-primary btn-sm float-right mb-2">Add Employee</router-link>
            </div>
            <div class="col-md-6">
                <input type="text" placeholder="Search by name, email.." class="form-control" v-model="keywords">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>DOB</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody v-if="employees.length">
                        <tr v-for="(employee, key) of employees">
                            <td>{{ key+1 }}</td>
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.email }}</td>
                            <td>{{ employee.address }}</td>
                            <td>{{ employee.dob }}</td>
                            
                            <td>
                                <router-link class="btn btn-success btn-sm" :to="{ name: 'EmployeeEdit', params: { employeeId: employee.id }}">Edit</router-link>
                                <button class="btn btn-danger btn-sm" @click="deleteEmployee(employee.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="6">No Employee found.</td>
                        </tr>
                    </tbody>
                </table>
                 <!-- <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="fetchPosts()"></pagination> --}} -->
                  <pagination :data="paginate" @pagination-change-page="getEmployee"></pagination>

            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        // components: {
        // 'Pagination': LaravelVuePagination
        // },
        data() {
            return {
                keywords: null,
                employees: {},
                paginate: {}
            }
        },
        created() {
            this.getEmployee();
        },
        watch: {
            keywords(after, before) {
                this.search();
            }
        },
        methods: {
            getEmployee(page = 1) {
              this.axios.get('/api/employee?page='+page).then(response => {
                this.employees = response.data.data;
                this.paginate = response.data;
            }).catch(error=>{
                console.log(error)
            })
            },
            deleteEmployee(employeeId) {
                this.axios
                    .delete(`/api/employee/${employeeId}`)
                    .then(response => {
                        let i = this.employees.map(data => data.id).indexOf(employeeId);
                        this.employees.splice(i, 1)
                    });
            },
            // search
            search(){
                this.axios
                .get('/api/search',  { params: { keywords: this.keywords } })
                .then(response => this.employees = response.data)
                .catch(error => {});
            }
        }
    }
</script>