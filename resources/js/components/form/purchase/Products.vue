<template>
<div class="">

<div v-if="formData.settings.isTitle || formData.action == 'CRUD'" class="container-fluid bg-light border-bottom mb-4">

    <div class="row align-items-center py-4">
        <div class="col">
            <h5 v-if="formData.settings.isTitle" class="h5 text-uppercase d-inline-block m-0 p-0">{{ formData.title }}</h5>
        </div>
        <div v-if="formData.action == 'CRUD'" class="col-auto text-right">
            <button v-if="!formData.settings.isForm" @click="formData.settings.isForm = true" class="btn btn-sm btn-outline-success text-uppercase shadow">Add</button>
            <button v-if="formData.settings.isForm" @click="formData.settings.isForm = false; resetData()" class="btn btn-sm btn-outline-danger text-uppercase shadow">Close</button>
        </div>
    </div>

</div>


<div v-if="formData.settings.isForm" class="container-fluid mb-4">

    <form @submit.prevent="submitForm($event)" :name="formData.formName" action="POST" :method="formData.method" enctype="multipart/form-data">

        <p v-if="successMessage != ''" class="p-3 alert-success rounded text-capitalize">{{successMessage}}</p>

        <p v-if="errorMessage != ''" class="p-3 alert-danger rounded text-capitalize">{{errorMessage}}</p>

        <div class="row mb-4">

            <div v-for="(elm, index) in formData.elements" :key="elm.name" :class="elm.class">


                <template v-if="elm.type=='caption'">
                    <label class="disable-select font-weight-bold text-uppercase">{{elm.label}}</label>
                </template>

                <template v-if="elm.type=='file'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" @change="checkImage(index, $event); removeError(index); sendEvent($event)" :id="elm.name" :name="elm.name">
                        <label class="custom-file-label" for="myfile">{{elm.value}}</label>
                    </div>
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='image'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" @change="checkImage(index, $event); removeError(index); sendEvent($event)" :id="elm.name" :name="elm.name">
                        <label class="custom-file-label" for="myfile">{{elm.value}}</label>
                    </div>
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='text'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <input class="form-control" type="text" :name="elm.name" :id="elm.name" v-model="elm.value" @change="removeError(index); sendEvent($event)" :readonly="elm.readonly">
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='email'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <input class="form-control" type="email" :name="elm.name" :id="elm.name" v-model="elm.value" @change="removeError(index); sendEvent($event)" :readonly="elm.readonly">
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='date'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <input class="form-control" type="date" :name="elm.name" :id="elm.name" v-model="elm.value" @change="removeError(index); sendEvent($event)" :readonly="elm.readonly">
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='password'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <input class="form-control" type="password" :name="elm.name" :id="elm.name" v-model="elm.value" @change="removeError(index); sendEvent($event)" :readonly="elm.readonly">
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='textarea'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <textarea class="form-control" type="text" :name="elm.name" :id="elm.name" v-model="elm.value" @change="removeError(index); sendEvent($event)" :readonly="elm.readonly"></textarea>
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='select'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <select class="form-control" type="text" :name="elm.name" :id="elm.name" v-model="elm.value" @change="removeError(index); sendEvent($event)" :readonly="elm.readonly">
                        <option v-for="option in elm.options" :key="option.value" :value="option.value">{{option.key}}</option>
                    </select>
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='radio'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <span class="d-block disable-select">
                        <span v-for="option in elm.options" :key="option.value" class="d-inline-block">
                            <input class="" type="radio" :name="elm.name" :id="option.key" :value="option.value" v-model="elm.value" @change="removeError(index); sendEvent($event)" :readonly="elm.readonly">
                            <label :for="option.key" class="mr-3" style="cursor:pointer;">{{option.key}}</label>
                        </span>
                    </span>
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

                <template v-if="elm.type=='checkbox'">
                    <label class="disable-select text-capitalize" :for="elm.name">{{elm.label}}</label>
                    <span class="d-block disable-select">
                        <span v-for="option in elm.options" :key="option.value" class="d-inline-block">
                            <input class="" type="checkbox" :id="option.key" :value="option.value" :name="elm.name" v-model="elm.values" @change="removeError(index); sendEvent($event)" :readonly="elm.readonly">
                            <label :for="option.key" class="mr-3" style="cursor:pointer;">{{option.key}}</label>
                        </span>
                    </span>
                    <span v-if="!elm.isError" class="disable-select small text-capitalize text-muted">{{elm.hint}}</span>
                    <span v-if="elm.isError" class="disable-select small text-capitalize text-danger">{{elm.error}}</span>
                </template>

            </div>

            <div class="col-12 mt-2">
                <input class="btn btn-primary" type="submit" value="Submit">
                <input v-if="formData.settings.isReset" @click.prevent="resetData" class="btn btn-warning" type="reset" value="Reset">
            </div>

        </div>
    </form>

</div>


<div v-if="formData.settings.isSearch" class="container-fluid">
    <form action="" @submit.prevent="submitSearch">
        <div class="row">

            <div class="col-12 mb-2">
                <h5 class="text-uppercase">Search Options</h5>
            </div>

            <div v-if="formData.settings.isDateSearch" class="col-12">
                <div class="input-group mb-3">
                    <input class="form-control shadow-none" type="date" v-model="from">
                    <input class="form-control shadow-none" type="date" v-model="to">
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <div class="input-group mb-3">
                    <select class="form-control shadow-none" name="search_column" id="search_column" v-model="key">
                        <option value="">Select Search Column</option>
                        <option value="id">ID</option>
                        <option v-for="elm in formData.elements" :key="elm.name" :value="elm.name">{{elm.label}}</option>
                    </select>
                    <select class="form-control shadow-none" name="search_res" id="search_res" v-model="res">
                        <option value="Start">Start</option>
                        <option value="Exact">Exact</option>
                        <option value="Anywhere">Anywhere</option>
                    </select>

                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <div class="input-group mb-3">
                    <input class="form-control shadow-none" type="text" name="search_string" id="search_string" v-model="val">
                    <div class="input-group-append">
                        <button class="btn shadow-none btn-outline-secondary text-uppercase" type="submit">Search</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>


<div v-if="formData.settings.isResults" class="container-fluid mb-2">
    <div class="row">
        <div class="col-6"><button v-if="formData.settings.isExport" class="btn btn-success mb-1" @click="exportTableToExcel('crud-table')">Exoprt to Excel</button></div>
        <div class="col-6 text-right">
            <button class="btn">#{{data.total}}</button>
            <select @change="getData()" class="form-control d-inline shadow-none" style="width:85px;" name="results" id="results" v-model="r">
                <option value="1">1</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
            </select>
        </div>
    </div>
</div>


<div v-if="formData.settings.isResults" class="container-fluid">

    <div class="table-responsive">

        <table class="table table-striped" id="crud-table">
            <thead>
                <tr>
                    <th  v-if="formData.settings.isAction" style="width:70px;" class="text-left" ><p class="p-0 m-0" style="width:70px;">Action</p></th>

                    <th style="width:40px;"><p class="p-0 m-0" style="width:40px;">ID</p></th>

                    <template v-for="elm in formData.display">
                        <th :key="elm.name" class="">{{elm.val}}</th>
                    </template>

                    <th  v-if="formData.settings.isAction" style="width:140px;" class="text-right"><p class="p-0 m-0" style="width:140px;">Action</p></th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="item in data.data" :key="item.id">

                    <td v-if="formData.settings.isAction" class="text-left ">
                        <button @click="editData(item)" class="btn btn-sm shadow-none btn-outline-warning"><i class="fas fa-edit"></i></button>
                        <button @click="deleteData(item.id)" class="btn btn-sm shadow-none btn-outline-danger"><i class="fas fa-trash"></i></button>
                        <!-- <a class="btn shadow-none btn-outline-primary btn-sm" :href="'/letter/'+item.id"><i class="fas fa-download"></i></a> -->
                    </td>

                    <td>{{item['id']}}</td>

                    <template v-for="elm in formData.display">
                        <td :key="elm.key" class="">
                            <span v-if="elm.type!='image' && elm.type!='file'">{{displayValue(elm.key, item)}}</span>
                            <img v-if="elm.type=='image'" :src="displayValue(elm.key, item)==null ? 'https://via.placeholder.com/40' : displayValue(elm.key, item)" style="height:40px;" >
                            <span v-if="elm.typ=='file'">{{displayValue(elm.key, item)}}</span>
                        </td>
                    </template>

                    <td v-if="formData.settings.isAction" class="text-right ">
                        <button @click="editData(item)" class="btn btn-sm shadow-none btn-outline-warning"><i class="fas fa-edit"></i></button>
                        <button @click="deleteData(item.id)" class="btn btn-sm shadow-none btn-outline-danger"><i class="fas fa-trash"></i></button>
                        <a v-if="formData.model=='ProductGroup'" class="btn shadow-none btn-outline-primary btn-sm" :href="'/purchase/products/product/'+item.id"><i class="fas fa-link"></i></a>
                    </td>

                </tr>

            </tbody>
        </table>

    </div>

</div>



<div v-if="formData.settings.isLoadMore" class="container-fluid mb-5">
    <button class="btn btn-block btn-success mt-3" @click="getData(data.current_page * 1 + 1)" :disabled="this.data.current_page == this.data.last_page">Load More</button>
</div>




</div>
</template>

<script>

export default {
    components: {
    },

    data(){
        return {
            from : '',
            to : '',
            key : '',
            val : '',
            res : 'Anywhere', /* Anywhere | Start | Exact */
            custom_query: [],
            errorMessage : '',
            successMessage : '',
            r : 10,
            data : {
                data: [],
                current_page: null,
                first_page_url: null,
                from: null,
                last_page: null,
                last_page_url: null,
                next_page_url: null,
                path: null,
                per_page: null,
                prev_page_url: null,
                to: null,
                total: null
            },

        };
    },

    props: {
        formData : {
            id : Number,
            title: String, /* Form Title or Caption */
            formName: String, /* Any Form Name Example myCrudForm */
            model: String, /* Model Name Example User */
            action: String,
            method: String,
            with: Array,
            mail : {
                mailname : String,
                to : String,
                subject : String,
            },
            settings : {
                isTitle : Boolean,
                isForm : Boolean,
                isReset : Boolean,
                isSubmit : Boolean,
                isSearch : Boolean,
                isDateSearch : Boolean,
                isExport : Boolean,
                isResults : Boolean,
                isAction : Boolean,
                isLoadMore : Boolean,
            },
            display : Array,
            elements: Array,
        },
    },

    methods: {

        setForm(){

            switch(this.formData.action){
                case "CRUD" :
                    this.formData.settings.isForm = false;
                    this.formData.settings.isSearch = true;
                    this.formData.settings.isResults = true;
                    this.formData.settings.isAction = true;
                    this.formData.settings.isLoadMore = true;
                break;

                case "EDIT" :
                    this.formData.settings.isForm = true;
                    this.formData.settings.isSearch = false;
                    this.formData.settings.isResults = false;
                    this.formData.settings.isAction = false;
                    this.formData.settings.isLoadMore = false;
                break;

                case "SEARCH" :
                    this.formData.settings.isForm = false;
                    this.formData.settings.isSearch = true;
                    this.formData.settings.isResults = true;
                    this.formData.settings.isAction = false;
                    this.formData.settings.isLoadMore = true;
                break;

                case "MAIL" :
                    this.formData.settings.isForm = true;
                    this.formData.settings.isSearch = false;
                    this.formData.settings.isResults = false;
                    this.formData.settings.isAction = false;
                    this.formData.settings.isLoadMore = false;
                break;

                default:
                break
            }
        },

        displayValue(str, item){
            let arr = str.split(',');
            let s = '';
            arr.forEach(i=>{
                item = item[i];
            });
            return item;
        },

        exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        },

        submitForm(e){
            const fd = new FormData();
            const crudnames = [];
            const crudtypes = [];
            const crudvalidation = [];
            fd.append('model', this.formData.model);
            fd.append('id', this.id);
            fd.append('form_action', this.formData.action);
            this.errorMessage = "";
            this.successMessage = "";

            this.formData.elements.forEach((item, index) => {

                if(item.type != 'caption'){
                    this.formData.elements[index].isError = false;
                    crudnames.push(item.name);
                    crudtypes.push(item.type);
                    crudvalidation.push(item.validation);
                    if(item.type == 'file' || item.type == 'image'){
                        if(e.target[item.name].files.length > 0){
                            let file = e.target[item.name].files[0];
                            fd.append(item.name, file);
                        }
                    } else if(item.type == 'checkbox'){
                        fd.append(item.name, item.values.join());
                    } else {
                        fd.append(item.name, item.value);
                    }
                }

            });

            if(this.formData.action == "MAIL"){
                /* fd.append('name', this.formData.mail.name); */
                fd.append('mailname', this.formData.mail.mailname);
                fd.append('to', this.formData.mail.to);
                fd.append('subject', this.formData.mail.subject);
            }

            fd.append('crudnames', crudnames);
            fd.append('crudtypes', crudtypes);
            fd.append('crudvalidation', crudvalidation);

            window.axios.post('/crud', fd).then(res => {
                this.successMessage = "Successful"
                this.getData();
                this.showData(this.formData.id);
                if(this.formData.action == "MAIL"){
                    this.resetData();
                } else if(this.formData.action == "EDIT"){

                } else {
                    this.formData.settings.isForm = false;
                }
            })
            .catch(error => {
                if(error.response.status == 422){
                    this.errorMessage = error.response.data.message;
                    let errors = error.response.data.errors;
                    this.formData.elements.forEach((item, index) => {

                        if(errors[item.name] != null || errors[item.name] != undefined){
                            this.formData.elements[index].isError = true;
                            //if(this.formData.elements[index].error == ""){
                                this.formData.elements[index].error = errors[item.name].join();
                            //}
                        } else {

                        }

                    });
                } else {
                    console.log(error);
                }
            });

        },

        checkImage(i, e){
            let file = e.target.files[0];
            let fileName = e.target.value.split("\\").pop();
            this.formData.elements[i].value = fileName;
        },

        getData(page=1){
            if(this.formData.action == 'CRUD' || this.formData.action == 'SEARCH'){
                if(this.formData.custom_query.length > 0){
                    this.custom_query = this.formData.custom_query;
                }
                if(page == 1){
                    this.resetData();
                    this.data.data = [];
                }
                let ds = "No";
                if(this.formData.settings.isDateSearch){ ds = "Yes"; }
                let urlString = '?model='+this.formData.model+'&key='+this.key+'&val='+this.val+'&res='+this.res+'&ds='+ds+'&from='+this.from+'&to='+this.to+'&q='+this.custom_query+'&r='+this.r+'&page='+page+'&with='+this.formData.with;

                window.axios.get('/crud'+urlString).then(res => {
                    this.data.current_page = res.data.current_page;
                    this.data.first_page_url = res.data.first_page_url;
                    this.data.from = res.data.from;
                    this.data.last_page = res.data.last_page;
                    this.data.last_page_url = res.data.last_page_url;
                    this.data.next_page_url = res.data.next_page_url;
                    this.data.path = res.data.path;
                    this.data.per_page = res.data.per_page;
                    this.data.prev_page_url = res.data.prev_page_url;
                    this.data.to = res.data.to;
                    this.data.total = res.data.total;
                    res.data.data.forEach(item => {
                        this.data.data.push(item);
                    });

                })
                .catch(err => {
                    console.log(err);
                });
            }
        },

        deleteData(id){
            var files = [];
            this.formData.elements.forEach(item => {
                if(item.type == 'file' || item.type == 'image'){
                    files.push(item.name);
                }
            });
            var c = confirm("Are you sure to delete data?");
            if (c == true) {
                window.axios.delete("/crud/" + id + "?model=" + this.formData.model + "&files=" + files).then(res => {
                    if (res.data === "ok") this.getData();
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },

        editData(elm){
            this.formData.settings.isForm = true;
            window.scroll(0, 0);
            this.id = elm.id;
            this.formData.elements.forEach((item, index) => {
                if(item.type == 'file' || item.type == 'image'){

                } else if(item.type == 'checkbox'){
                    if(elm[item.name] != null){
                        this.formData.elements[index]['values'] = elm[item.name].split(',');
                    } else {
                        this.formData.elements[index]['values'] = [];
                    }
                } else {
                    if(elm[item.name] != null){
                        this.formData.elements[index]['value'] = elm[item.name];
                    } else {
                        this.formData.elements[index]['value'] = '';
                    }
                }
            });
            this.$emit('OnEdit', elm);
        },

        resetData(){
            this.id = 0;
            this.formData.elements.forEach((item, index) => {
                if(item.type == 'file' || item.type == 'image'){
                    this.formData.elements[index]['value'] = '';
                    this.formData.elements[index]['ObjectValue'] = {};
                } else if(item.type == 'checkbox'){
                    this.formData.elements[index]['values'] = [];
                } else {
                    this.formData.elements[index]['value'] = '';
                }
            });
        },

        submitSearch(){
            this.getData();
        },

        removeError(i){
            this.formData.elements[i].isError = false;
            this.errorMessage = '';
        },

        showData(id){
            if(id != 0){
                this.data.data = [];

                this.formData.elements.forEach((item, index) => {
                    if(item.type == 'file' || item.type == 'image'){
                        this.formData.elements[index]['value'] = '';
                        this.formData.elements[index]['ObjectValue'] = {};
                    } else if(item.type == 'checkbox'){
                        this.formData.elements[index]['values'] = [];
                    } else {
                        this.formData.elements[index]['value'] = '';
                    }
                });

                window.axios.get("/crud/" + id + "?model=" + this.formData.model).then(res => {
                    this.editData(res.data);
                    this.data.data.push(res.data);


                })
                .catch(err => {
                    console.log(err);
                });
            }
        },

        sendEvent(e){
            this.$emit('OnChange', e);
        },

        today(){
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let yyyy = today.getFullYear();
            return yyyy + '-' + mm + '-' + dd;
        },
        tomorrow(){
            let tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
            let dd = String(tomorrow.getDate()).padStart(2, '0');
            let mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
            let yyyy = tomorrow.getFullYear();
            return yyyy + '-' + mm + '-' + dd;
        },

    },

    created(){
        this.from = this.today();
        this.to = this.tomorrow();
        this.setForm();
        this.getData();
        this.showData(this.formData.id);
    },
}
</script>

<style scoped>
.disable-select {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>
