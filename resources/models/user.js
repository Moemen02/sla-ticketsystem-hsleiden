export default class User {
    constructor(data = {}){
        this.username = data.username ? data.username: ""
        this.firstname = data.firstname ? data.firstname: ""
        this.lastname = data.lastname ? data.lastname: ""
        this.email = data.email ? data.email: ""
        this.password = data.password ? data.password: ""
        this.phone_number = data.phone_number ? data.phone_number: ""
        this.role = data.role
        this.companyID = data.companyID ? data.companyID: ""
        this.companyRole = data.companyRole ? data.companyRole: ""
    }
}