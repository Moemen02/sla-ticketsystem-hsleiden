export default class Ticket {
    constructor(data = {}){
        this.userID = data.userID ? data.userID: ""
        this.companyID = data.companyID ? data.companyID: ""
        this.ticket_title = data.ticket_title ? data.ticket_title: ""
        this.description = data.description ? data.description: ""
        this.assigned_by = data.assigned_by ? data.assigned_by: ""
        this.assigned_for = data.assigned_for ? data.assigned_for: ""
        this.fixed_by = data.fixed_by ? data.fixed_by: ""
        this.due_at = data.due_at ? data.due_at: ""
        this.status = data.status
    }
}