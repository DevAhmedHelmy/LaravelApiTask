<template>
  
     <div>
  <v-simple-table fluid>
    
    <template v-slot:default>
      <thead>
      <router-link style="cursor:pointer" :to="{name:'AddCustomer'}" tag="span">
      <div class="my-2">
        <v-btn small color="primary"><v-icon left>fa fa-plus </v-icon> Add New Customer</v-btn>
      </div>
                            
                        </router-link>
        <tr>
          <th style="5%;">#</th>
          <th class="text-center p-4">Name</th>
          <th class="text-center">Email</th>
          <th class="text-center">Phone</th>
          <th class="text-center">Address</th>
          <th class="text-center">Show</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.name">
          <td style="5%;">{{customer.id}}</td>
          <td>{{customer.name}}</td>
          <td>{{customer.email}}</td>
          <td>{{customer.phone}}</td>
          <td>{{customer.address}}</td>
          <td>
              <router-link style="cursor:pointer" :to="{name:'ShowCustomer', params:{id:customer.id}}" tag="span">
                  <v-btn icon>
                      <v-icon>fa fa-eye</v-icon>
                  </v-btn>
              </router-link>
          </td>
          <td>
               
                  <v-btn icon>
                      <v-icon @click="editCustomer(customer.id)">fa fa-edit</v-icon>
                  </v-btn>
             
          </td>
          <td>
              
              <v-btn icon>
                  <v-icon @click="deleteCustomer(customer.id)">fa fa-trash</v-icon>
              </v-btn>
            
          </td>
        </tr>
      </tbody>

      
    </template>
  </v-simple-table>
 

 <template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      
      <v-card>
        <v-card-title>
          <span class="headline">User Profile</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
               
               
              <v-col cols="12">
                <v-text-field
                  v-model="form.name"
                  :counter="25"
                  :rules="nameRules"
                  label="Name"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="form.email"
                  :rules="emailRules"
                  label="E-mail"
                  required
                ></v-text-field>
              </v-col>
              
              <v-col cols="12">
                <v-text-field
                  v-model="form.phone"
                  
                  :rules="[v => !!v || 'Item is required']"
                  label="Phone Number"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="form.address"
                  :rules="[v => !!v || 'Item is required']"
                  
                  label="Address"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-select
                  v-model="form.type"
                  :items="items"
                  :rules="[v => !!v || 'Item is required']"
                  label="Customer Type"
                  required
                ></v-select>
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
              
            >
              Save
            </v-btn>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
 </div>
</template>

<script>
export default {
    data(){
    return{
       valid: true,
        form:{name:'', email:'', phone:'', address:'',type:''},
        errors:[],
        customers:[],
        customer:'',
        dialog:false,
        items: [
          'individual',
          'corporate',
          
        ],
        nameRules: [
          v => !!v || 'Name is required',
          v => (v && v.length <= 10) || 'Name must be less than 10 characters',
        ],
        emailRules: [
          v => !!v || 'E-mail is required',
          v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],

    }
    },
    created(){
            // Make a request for a user with a given ID
            this.getCustomers();
            
        },
      methods:{
        getCustomers(){
            axios.get('/api/customers')
            .then(res => this.customers = res.data.data)
            .catch(function (error) {
                this.errors = error.response.data.errors
                console.log(error.response.data.errors);
            });
        },
        deleteCustomer(customerId){
            axios.delete('/customers/'+customerId)
            .then(this.getCustomers())
          },
          editCustomer(customerId){
            this.dialog=true;
            axios.get('/customers/'+customerId)
            .then(res =>{ this.form.name = res.data.name})
          },
        getCustomer(customerId){
            
            axios.get('/customers/'+customerId)
            .then(res => this.customer = res.data.data)
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
