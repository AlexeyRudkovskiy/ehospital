import {API} from "../api";
export class PatientShow {

    protected departmentSelect:any = null;

    protected doctors_list:any = null;

    protected doctor_select:any = null;

    constructor() {
        this.departmentSelect = document.querySelector('#hospitalization_department');
        this.doctors_list = document.querySelector('#doctors_list');
        this.doctor_select = document.querySelector('#doctor_select');

        this.departmentSelect.addEventListener('change', this.onDepartmentChangedEvent.bind(this));
    }

    private onDepartmentChangedEvent (): void {
        API.get('/api/department/' + this.departmentSelect.value)
            .then(response => response.json())
            .then(this.updateUserSelect.bind(this));
    }

    private updateUserSelect (department:any): void {
        while (this.doctor_select.firstChild) {
            this.doctor_select.removeChild(this.doctor_select.firstChild);
        }

        for (var i = 0; i < department.users.length; i++) {
            var fullName = department.users[i].lastName + " " + department.users[i].firstName + " " + department.users[i].middleName;
            var option = document.createElement('option');
            option.value = department.users[i].id;
            option.innerHTML = fullName;
            this.doctor_select.appendChild(option);
        }
        this.doctors_list.style.display = 'block';
    }

}