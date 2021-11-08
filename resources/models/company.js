export default class Company {
    constructor(data = {}, id=null){
        this.id = id
        this.company_name = data.company_name ? data.company_name: ""
        this.total_employees = data.total_employees ? data.total_employees: ""
        this.kvk = data.kvk ? data.kvk: ""
    }
}