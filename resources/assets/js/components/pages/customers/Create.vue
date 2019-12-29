<template>
<div class="text-md-center">
<v-layout>
    <v-flex xs6 offset-xs3>
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation

  >
    <v-text-field
      v-model="form.name"
      :counter="25"
      :rules="nameRules"
      label="Name"
      required
    ></v-text-field>

    <v-text-field
      v-model="form.email"
      :rules="emailRules"
      label="E-mail"
      required
    ></v-text-field>
<v-text-field
      v-model="form.phone"

       :rules="[v => !!v || 'Item is required']"
      label="Phone Number"
      required
    ></v-text-field>
    <v-text-field
      v-model="form.address"
       :rules="[v => !!v || 'Item is required']"

      label="Address"
      required
    ></v-text-field>
    <v-select
      v-model="form.type"
      :items="items"
       :rules="[v => !!v || 'Item is required']"
      label="Customer Type"
      required
    ></v-select>



     <v-btn
     :disabled="!valid"
      color="primary"
      class="mr-4"
      @click.prevent="storeCustomer()"
    >
      Save
    </v-btn>

    <v-btn
      color="error"
      class="mr-4"
      @click="reset"
    >
      Reset Form
    </v-btn>


  </v-form>
  </v-flex>
  </v-layout>
  </div>
</template>
<script>
  export default {
    data(){
      return{
        valid: true,
        form:{name:'', email:'', phone:'', address:'',type:''},

        items: [
          'individual',
          'corporate',

        ],
        nameRules: [
          v => !!v || 'Name is required',
          v => (v && v.length <= 50) || 'Name must be less than 10 characters',
        ],
        emailRules: [
          v => !!v || 'E-mail is required',
          v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],

        errors:[]
      }


    },

    methods: {

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

      // save function
      storeCustomer(){
        axios.post('/api/customers', this.form)
        .then(response => { 
            window.location.href = "customers";
        })
        .catch(error => {
          console.log(error.response);
          this.errors = error.response.data.errors
        })
      },
    },
  };
</script>
