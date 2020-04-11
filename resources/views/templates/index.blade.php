@extends('layouts.vuemaster')
@section('title')
Template List
@endsection
@section('page-styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">

</style>
@endsection
@section('content')
<div id="app" class="container">
    <div class="row justify-content">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold text-uppercase">Template List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/form" class="btn btn-secondary font-italic bg-success"><i class="fa fa-file"></i>&nbsp;Leads/Forms</a>
                        <a href="/template/create" class="btn btn-outline-danger font-italic"><i class="fa fa-plus-square"></i>&nbsp;Create New Template</a>
                    </div><br />
                    <br />

					<div class="row">
					  <div class="col-sm-12 col-md-12 col-lg-12">
					    <table class="table table-hover">
					    <thead class="bg-info text-light font-italic">
					    <tr>
					      <th>Date/Created</th>
					      <th>Template</th>
					      <th>Header/Title</th>
					      <th>Form Link</th>        
					    </tr>  
					    </thead>
					    @foreach($templates as $r)
					      <tr>
					      	<td>
					          {{ $r->created_at }}
					        </td>
					        <td>
					          {{ $r->templatename }}
					        </td>
					        <td>
					          {{ $r->formheader }}
					        </td>
					        <td>
					          <a href="{{ action('LeadformController@index',$r->id) }}" target="_blank"><i class="fa fa-file"></i></a>
					        </td>
					      </tr>
					    @endforeach
					    </table>

					  {{ $templates->links() }}
					  </div>
					</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
 // Vue.component('text-component', require('./components/TextComponent.vue').default);

// var labelComponent = Vue.component('label-component', Vue.extend({
//      data: function(){
//          return{
//              txtvalue: null
//          }
//      },
//     methods:{
//             changeText:function(event){
//             this.txtvalue = event.target.value;
//             this.$emit('txtvaluechanged', this.txtvalue);
//         }
//     },
//     template: `<div class="form-group row">
//     <label for="" class="col-lg-2 col-md-2 col-sm-2 col-form-label">Label Text</label>
//     <div class="col-lg-10 col-md-12 col-sm-10">
//       <input type="text" class="form-control" name="element[]" :value="txtvalue" @input="changeText">
//     </div>
//   </div>`
// }));

// var listComponent = Vue.component('list-component', Vue.extend({
//         // props: ['component','id', 'type'],
//         data: function(){
//             return{
//                 txtvalue: null
//             }
//         },
//     methods:{
//             changeText:function(event){
//             this.txtvalue = event.target.value;
//             this.$emit('txtvaluechanged', this.txtvalue);
//         }
//     },
//         template: `<div class="form-group row">
//     <label for="" class="col-lg-2 col-md-2 col-sm-2 col-form-label">Text Placeholder</label>
//     <div class="col-lg-10 col-md-12 col-sm-10">
//       <input type="text" class="form-control" name="element[]" :value="txtvalue" :placeholder="txtvalue" @input="changeText" >
//     </div>
//   </div>`
// }));

// const app = new Vue({
//     el: '#app',
//     data: {
//             errors: [],
//             templatename: null,
//             formheader: null,
//             complist: [],//componentlist
//             elements: '', //serialize & submit
//             count: 0
//     },
//     components: {
//         'label-component': labelComponent,
//         'text-component': textComponent,
//         'textarea-component': textAreaComponent,
//         'email-component': emailComponent
//   },
//   // computed:{
//   //   updateForm(){
//   //       return this.elements;
//   //   }
//   // },
//     methods:{
//         addTextbox(event){
//             console.log('adding textbox...');
//         },
//         addFormElement: function(name,type) {
//             console.log('adding ' + name);
//           this.complist.push({
//             //component: new labelComponent(),
//             name: name,
//             type: type,
//             id: this.count++,
//             txtvalue: null
//             });
//         },
//         submitData:function(event){
//             event.preventDefault();
//             //this.elements=[];
//             var elms= [];
//             this.complist.forEach((el,ndx)=>{
//                 console.log(el);
//                 elms.push({
//                     'type':el.type,
//                     'text':el.txtvalue
//                 })
//             });
//             console.table(elms);
//             this.elements=JSON.stringify(elms);
//             console.log(this.elements);
//             this.$refs.itemlist.value=this.elements;
//             this.$refs.form.submit();

//         }
//     }
// });
</script>
@endsection
