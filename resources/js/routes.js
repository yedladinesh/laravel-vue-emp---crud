import EmployeeIndex from './components/index.vue';
import EmployeeCreate from './components/create.vue';
import EmployeeEdit from './components/edit.vue';

export const routes = [
    {
        path: '/',
        component: EmployeeIndex,
        name: "EmployeeIndex"
    },
    {
        path: '/employee/create',
        component: EmployeeCreate,
        name: "EmployeeCreate"
    },
    {
        path: '/employee/edit/:employeeId',
        component: EmployeeEdit,
        name: "EmployeeEdit"
    }
];