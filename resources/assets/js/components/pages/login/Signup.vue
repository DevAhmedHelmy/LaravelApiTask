<template>
<div class="text-md-center">
  <h2>Login</h2>
  <v-layout>
    <v-flex xs6 offset-xs3>
      <v-card>
  <v-form @submit.prevent="signup">
    <v-text-field
      v-model="form.name"
       
      label="name"
      type="text"
      required
      @input="$v.name.$touch()"
      @blur="$v.name.$touch()"
    ></v-text-field>
    <span class="text--red" v-if="errors.name">{{errors.name[0]}}</span>

    <!-- email field -->
    <v-text-field
      v-model="form.email"
       
      label="E-mail"
      required
      @input="$v.email.$touch()"
      @blur="$v.email.$touch()"
    ></v-text-field>
    <span class="text--red" v-if="errors.email">{{errors.email[0]}}</span>
    <!-- password field -->
    <v-text-field
      v-model="form.password"
       
      label="password"
      type="password"
      required
      @input="$v.password.$touch()"
      @blur="$v.password.$touch()"
    ></v-text-field>
<span class="text--red" v-if="errors.password">{{errors.password[0]}}</span>
    <!-- password password_confirmation -->
    <v-text-field
      v-model="form.password_confirmation"
       
      label="password"
      type="password"
      required
      @input="$v.password.$touch()"
      @blur="$v.password.$touch()"
    ></v-text-field>
     
    <!-- submit -->
    <v-btn class="mr-4" type="submit">Sign Up</v-btn>
     
    <router-link to="/login">
          <v-btn color="blue">login</v-btn>
        </router-link>
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
        name: { required, minLength: minLength(4) },
        password: { required, minLength: minLength(4) },
        email: { required, email },
       
    },

    data() {
        return {
            form:{
                name: '',
                email: '',
                password:'',
                password_confirmation: '',
            },
            errors:{}
        }
        
      
       
    },
    
    
    methods: {
      submit () {
        this.$v.$touch()
      },
      
      signup(){
          
         axios.post('http://127.0.0.1:8000/api/signup',this.form)
          .then(res => {
              User.responseAfterLogin(res)
              
              })
          .catch(function(error){console.log(error)})
          

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