<template>
  
    <div>
      <h1>Customer Data</h1>
<v-layout>
    <v-flex xs6 offset-xs3>
  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer ID</v-expansion-panel-header>
      <v-expansion-panel-content>
        <p class="text-left">{{customer.id}}</p>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>

  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Name</v-expansion-panel-header>
      <v-expansion-panel-content>
      <p class="text-left">{{customer.name}}</p>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Email</v-expansion-panel-header>
      <v-expansion-panel-content>
      <p class="text-left">{{customer.email}}</p>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Phone</v-expansion-panel-header>
      <v-expansion-panel-content>
      <p class="text-left">{{customer.phone}}</p>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Address</v-expansion-panel-header>
      <v-expansion-panel-content>
      <p class="text-left">{{customer.address}}</p>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>

  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Actions</v-expansion-panel-header>
      <v-expansion-panel-content v-for="action in customer.actions" :key="action.id">
            <p class="text-left">{{action.action}}</p>
            <p class="text-right">
            <v-btn icon>
                      <v-icon @click="editAction(action.id)">fa fa-edit</v-icon>
                  </v-btn>
                  <v-btn icon>
                  <v-icon @click="deleteAction(action.id)">fa fa-trash</v-icon>
              </v-btn>
              </p>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>

  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Add Actions</v-expansion-panel-header>
      <v-expansion-panel-content>
              <v-form
    ref="form"
    v-model="valid"
    lazy-validation
    
  >
  <v-select
      v-model="action"
      :items="items"
       :rules="[v => !!v || 'Item is required']"
      label="Customer Action"
      required
    ></v-select>

     

     <v-btn
      
      color="primary"
      class="mr-4"
      @click.prevent="storeAction()"
    >
      Save
    </v-btn>

     
    
    
  </v-form>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
 </v-flex>
  </v-layout>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      
      <v-card>
        <v-card-title>
          <span class="headline">Edit Action</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
               
               
              <v-col cols="12">
                <v-col cols="12">
                <v-select
                  v-model="form.action"
                  :items="items"
                  :rules="[v => !!v || 'Item is required']"
                  label="Customer Action"
                  required
                ></v-select>
              </v-col>
               
               
              
               
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          

            <v-btn
              color="error"
              class="mr-4"
              @click="reset"
            >
              Reset Form
            </v-btn>
          
           <v-btn
            :disabled="!valid"
              color="primary"
              class="mr-4"
              @click.prevent="updateAction(form.id)"
              
            >
              Save
            </v-btn>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
  </div>
   
 
 
</template>

<script>
export default {
    data(){
    return{
         
         valid: true,
         dialog:false,
          action:'',
          form:{action:'',id:''},
        items: [
          'call',
          'visit',
          
        ],
        customer:'',
        custId:'',
        errors:[],
         

    }
    },
     created () {
        this.custId = this.$route.params.id;
        this.fetchCustomersData(this.custId);
    },
      methods:{
        
        
        fetchCustomersData(custId){
             
            axios.get('/api/customers/'+custId)
            .then(res => this.customer = res.data.data)
          },

          storeAction(){
             
            axios.post('/api/actions', {action:this.action, customer_id:this.customer.id})
            .then(res => {
              this.fetchCustomersData(this.custId);
                console.log(res.data) 
                 
              })
        .catch(function (error) {
              this.errors = error.response.data.errors
              console.log(error.response.data.errors);
          });
          },
          deleteAction(actionId){
            axios.delete('/api/actions/'+actionId)
            .then(res=>{this.fetchCustomersData(this.custId);})
          },
          editAction(actionId){
            this.dialog=true;
            axios.get('/api/actions/'+actionId)
            .then(res =>{ 
                this.form.action = res.data.data.action,
                this.form.id = res.data.data.id
                
                })
          },
          updateAction(actionId){
              
            axios.put('/api/actions/'+actionId, {action:this.form.action, customer_id:this.custId})
            .then(res => {
                this.fetchCustomersData(this.custId);
                this.dialog = false
                 
              })
        .catch(function (error) {
              this.errors = error.response.data.errors
              console.log(error.response.data.errors);
          });
          },

          validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
        }
      },
      reset () {
        this.$refs.form.reset()
      },
      resetValidation () {
        this.$refs.form.resetValidation()
      },

    },
};
</script>
