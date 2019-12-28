<template>
<div class="text-md-center">
  <h2>Login</h2>
  <v-layout>
    <v-flex xs6 offset-xs3>
      <v-card>
 <v-form @submit.prevent="login">
    <v-card-text>
    <v-text-field
      v-model="form.email"
      
      label="E-mail"
      required
      @input="$v.email.$touch()"
      @blur="$v.email.$touch()"
    >
    </v-text-field>
    <v-text-field
      v-model="form.password"
      
      label="password"
      type="password"
      required
      @input="$v.password.$touch()"
      @blur="$v.password.$touch()"
    ></v-text-field>
     
</v-card-text>
<v-card-actions>
   
  <v-btn class="mr-4" type="submit" color="primary">Login</v-btn>
  <router-link to="/signup">
          <v-btn>Sign Up</v-btn>
        </router-link>
</v-card-actions>

   
  </v-form>
  
      </v-card>
    </v-flex>
  </v-layout>
</div>
  
              
   
  
            
</template>
<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, minLength, email } from 'vuelidate/lib/validators'
  export default {
    mixins: [validationMixin],
    validations: {
      password: { required, minLength: minLength(4) },
      email: { required, email },
       
    },
    data() {
        return {
            form:{
                email: '',
                password:''
            }
        }
      
       
    },
     
  
    methods: {
      submit () {
        this.$v.$touch()
      },
      login(){
          
          User.login(this.form);
       
      },
      clear () {
        this.$v.$reset()
        this.name = ''
        this.email = ''
        this.select = null
        this.checkbox = false
      },
    },
  }
</script>