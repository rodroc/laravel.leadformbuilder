@extends('layouts.vuemaster')
@section('title')
Form List
@endsection
@section('page-styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">
<style type="text/css">

</style>
@endsection
@section('content')
<div id="app" class="container">
    <div class="row justify-content">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold text-uppercase">Create Template</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/template" class="btn btn-secondary font-italic bg-info"><i class="fa fa-list-ul font-italic"></i>&nbsp;&nbsp;Template List&nbsp;</a>
                        <a href="/form" class="btn btn-secondary font-italic bg-success"><i class="fa fa-file"></i>&nbsp;&nbsp;Leads/Forms&nbsp;</a>
                    </div><br /><br />

                    <button type="button" class="btn btn-outline-dark btn-lg font-italic" @click="addFormElement('label-component','label')">Add Label</button>
                    <button type="button" class="btn btn-outline-dark btn-lg font-italic" @click="addFormElement('text-component','text')">Add Text</button>
                    <button type="button" class="btn btn-outline-dark btn-lg font-italic" @click="addFormElement('textarea-component','textarea')">Add Textarea</button>
                    <button type="button" class="btn btn-outline-dark btn-lg font-italic" @click="addFormElement('email-component','emailtext')">Add Email</button>
                    <hr />
                    <form id="formTemplate" ref="form" action="/template/create" method="POST" @submit="validForm">
                        <input type="hidden" name="_method" value="post">
                        <input type="hidden" name="elements" v-model="elements" ref="itemlist">
                        @csrf             
                        <div class="form-group row">
                            <label for="" class="col-lg-2 col-md-2 col-sm-2 col-form-label"><strong>Template Name</strong></label>
                            <div class="col-lg-10 col-md-12 col-sm-10">
                              <input type="text" class="form-control" name="templatename" v-model="templatename" placeholder="Enter the template name. This text will not be visible to the lead form" @keyup="validForm" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-lg-2 col-md-2 col-sm-2 col-form-label"><strong>Form Header/Title</strong></label>
                            <div class="col-lg-10 col-md-12 col-sm-10">
                              <input type="text" class="form-control" name="formheader" v-model="formheader" placeholder="Form header for the lead/landing page form" @keyup="validForm" >
                            </div>
                        </div>

                        <component-list v-for="comp in complist" 
                            v-bind:is="comp.name" 
                            :key="comp.id" 
                            :type="comp.type"
                            @txtvaluechanged="comp.txtvalue=$event"
                            ></component-list>
                        
                        <div class="form-group">
                            <label for="" class="col-lg-2 col-md-2 col-sm-2 col-form-label">&nbsp;</label>
                            <div class="col-lg-10 col-md-12 col-sm-10">
                                <button type="button" @click="submitData" class="btn btn-dark btn-lg">Submit</button>
                            </div>                            
                        </div>
                </form>
                <p v-if="errors.length" class="text-danger font-italic">
                    <b>Please correct the following error(s):</b>
                    <ul class="text-danger">
                        <li v-for="error in errors" v-text="error" ></li>
                    </ul>
                </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
 // Vue.component('text-component', require('./components/TextComponent.vue').default);

var labelComponent = Vue.component('label-component', Vue.extend({
     data: function(){
         return{
             txtvalue: null
         }
     },
    methods:{
            changeText:function(event){
            this.txtvalue = event.target.value;
            this.$emit('txtvaluechanged', this.txtvalue);
        }
    },
    template: `<div class="form-group row">
    <label for="" class="col-lg-2 col-md-2 col-sm-2 col-form-label">Label Text</label>
    <div class="col-lg-10 col-md-12 col-sm-10">
      <input type="text" class="form-control" name="element[]" :value="txtvalue" @input="changeText">
    </div>
  </div>`
}));

var textComponent = Vue.component('text-component', Vue.extend({
        // props: ['component','id', 'type'],
        data: function(){
            return{
                txtvalue: null
            }
        },
    methods:{
            changeText:function(event){
            this.txtvalue = event.target.value;
            this.$emit('txtvaluechanged', this.txtvalue);
        }
    },
        template: `<div class="form-group row">
    <label for="" class="col-lg-2 col-md-2 col-sm-2 col-form-label">Text Placeholder</label>
    <div class="col-lg-10 col-md-12 col-sm-10">
      <input type="text" class="form-control" name="element[]" :value="txtvalue" :placeholder="txtvalue" @input="changeText" >
    </div>
  </div>`
}));

var textAreaComponent = Vue.component('textarea-component', Vue.extend({
        // props: ['component','id', 'type'],
        data: function(){
            return{
                txtvalue:null
            }
        },
    methods:{
            changeText:function(event){
            this.txtvalue = event.target.value;
            this.$emit('txtvaluechanged', this.txtvalue);
        }
    },
        template: `<div class="form-group">
        <label for="" class="">Textarea Placeholder</label>

    <textarea class="form-control" name="element[]" :placeholder="txtvalue" @input="changeText"></textarea>

    </div>`
}));

var emailComponent = Vue.component('email-component', Vue.extend({
        //props: ['component','id', 'type'],
        data: function(){
            return{
                txtvalue: null
            }
        },
    methods:{
            changeText:function(event){
            this.txtvalue = event.target.value;
            this.$emit('txtvaluechanged', this.txtvalue);
        }
    },
        template: `<div class="form-group row">
    <label for="" class="col-lg-2 col-md-2 col-sm-2 col-form-label">Email placeholder</label>
    <div class="col-lg-10 col-md-12 col-sm-10">
      <input type="text" class="form-control" name="element[]" :value="txtvalue" :placeholder="txtvalue" @input="changeText" >
    </div>
  </div>`
}));

const app = new Vue({
    el: '#app',
    data: {
            errors: [],//for validation
            templatename: null,
            formheader: null,
            complist: [],//componentlist
            elements: '', //serialize & submit
            count: 0
    },
    components: {
        'label-component': labelComponent,
        'text-component': textComponent,
        'textarea-component': textAreaComponent,
        'email-component': emailComponent
    },
    methods:{
        addFormElement: function(name,type) {
            console.log('adding ' + name);
          this.complist.push({
            name: name,
            type: type,
            id: this.count++,
            txtvalue: null
            });
          this.validForm();
        },
        validForm:function(){
            console.log('validating form...');
            this.errors = [];
            if (!this.templatename) {
                this.errors.push('Template name is required');
            }
            if (!this.formheader) {
                this.errors.push('Form header is required');
            }
            if( this.count==0 ){
                this.errors.push('You need to add element(s) to the template.');   
            }
            if (!this.errors.length ) {
                return true;
            }
            return false;
        },
        submitData:function(event){
            event.preventDefault();
            if( !this.validForm() ){
                return false;
            }

            if( this.errors.length>0 ){
                console.log('Got errors!');
                return false;
            }

            //this.elements=[];
            var elms= [];
            this.complist.forEach((el,ndx)=>{
                console.log(el);
                elms.push({
                    'type':el.type,
                    'text':el.txtvalue
                })
            });
            console.table(elms);
            this.elements=JSON.stringify(elms);
            console.log(this.elements);
            this.$refs.itemlist.value=this.elements;
            this.$refs.form.submit();

        }
    }
});
</script>
@endsection
