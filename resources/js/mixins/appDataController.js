export default{
    data() {
        return{
            appData: [{}],
            msg: null,
            alert: false,
            alertColor: null,
        }
    },
    methods:{
        getData(apiRoute){
            this.$axios
                .get(apiRoute)
                .then((response) => {
                    this.appData = response.data
                })
                .catch((err) => {
                    return err
                })
        },
        deleteData(id, apiRoute){
            this.$axios
                .delete(apiRoute + '/' + id)
                .then((response) => {
                    let i = this.appData.map(appdata => appdata.id).indexOf(id)
                    this.appData.splice(i, 1)
                    this.msg = "Succesfully deleted"
                    this.alert = true
                    this.alertColor = "success"
                    const that = this
                    setTimeout(function(){
                        that.alert = false
                        that.msg = []
                    }, 5000)
                })
                .catch((err) => {
                    const errosMsg = err.response.data.error
                    for(const errors in errosMsg){
                        this.msg.push(errosMsg[errors][0])
                    }
                    this.alert = true
                    this.alertColor = "error"
                    const that = this
                    setTimeout(function(){
                        that.alert = false
                        that.msg = []
                    }, 5000)
                })
        },
        clearAlert(){
            this.msg = []
            this.alert = false
        }
    }
}