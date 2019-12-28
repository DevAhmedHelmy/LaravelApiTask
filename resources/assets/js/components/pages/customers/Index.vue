<template>
  
     
  <v-simple-table fluid>
    
    <template v-slot:default>
      <thead>
      <router-link style="cursor:pointer" :to="{name:'AddCustomer'}" tag="span">
                            <v-btn icon>
                                <v-icon>fa fa-plus</v-icon>
                            </v-btn>
                        </router-link>
        <tr>
          <th style="5%;">#</th>
          <th class="text-center p-4">Name</th>
          <th class="text-center">Email</th>
          <th class="text-center">Phone</th>
          <th class="text-center">Address</th>
          <th class="text-center">Control</th>
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
        </tr>
      </tbody>
    </template>
  </v-simple-table>
 
 
</template>

<script>
export default {
    data(){
    return{
        errors:[],
        customers:[],
        customer:'',
        edit:false

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
        getCustomer(customerId){
            this.edit=true;
            axios.get('/customers/'+customerId)
            .then(res => this.customer = res.data.data)
          },
    },
};
</script>
