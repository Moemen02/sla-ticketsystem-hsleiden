export default class Contract {
    constructor(data = {}){
        this.contract_name = data.contract_name ? data.contract_name: ""
        this.companyID = data.companyID ? data.companyID: ""
        this.ends_at = data.ends_at ? data.ends_at: ""
        this.times_extended = data.times_extended
    }
}