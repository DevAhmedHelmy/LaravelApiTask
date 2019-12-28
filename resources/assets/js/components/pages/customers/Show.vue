<template>
  
    <div>
<v-layout>
    <v-flex xs6 offset-xs3>
  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer ID</v-expansion-panel-header>
      <v-expansion-panel-content>
        {{customer.id}}
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>

  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Name</v-expansion-panel-header>
      <v-expansion-panel-content>
      {{customer.name}}
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Email</v-expansion-panel-header>
      <v-expansion-panel-content>
      {{customer.email}}
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Phone</v-expansion-panel-header>
      <v-expansion-panel-content>
      {{customer.phone}}
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Address</v-expansion-panel-header>
      <v-expansion-panel-content>
      {{customer.address}}
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>

  <v-expansion-panels focusable>
    <v-expansion-panel>
      <v-expansion-panel-header>Customer Actions</v-expansion-panel-header>
      <v-expansion-panel-content v-for="action in customer.actions" :key="action.id">
            {{action.action}}
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
      label="Customer Type"
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
  </div>
   
 
 
</template>

<script>
export default {
    data(){
    return{
         
         valid: true,
        action:'',
        
        items: [
          'call',
          'visit',
          
        ],
        customer:'',
        custId:''
         

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
                console.log(res.data) 
                 
              })
        .catch(function (error) {
              this.errors = error.response.data.errors
              console.log(error.response.data.errors);
          });
          },
    },
};
</script>
