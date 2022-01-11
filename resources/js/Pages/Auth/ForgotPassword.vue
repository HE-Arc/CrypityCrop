<template>
  <Head title="Forgot Password" />
  
  <div class="card-body">
    <div class="mb-2">
      Vous avez oublié votre mot de passe ? Pas de soucis. Veuillez simplement nous indiquer votre adresse email et nous vous enverrons un lien par email pour le réinitialiser.
    </div>

    <div v-if="status" class="alert alert-success" role="alert">
      {{ status }}
    </div>

    <breeze-validation-errors class="mb-2" />

    <form @submit.prevent="submit">
      <div>
        <breeze-label for="email" value="Email" />
        <breeze-input id="email" type="email" v-model="form.email" required autofocus />
      </div>

      <div class="d-flex justify-content-end mt-4">
        <breeze-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
          <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Chargement...</span>
          </div>
          Lien de réinitialisation de mot de passe  
        </breeze-button>
      </div>
    </form>
  </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from "@/Layouts/Guest.vue"
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3'

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    Head,
  },

  props: {
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: ''
      })
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('password.email'))
    }
  }
}
</script>
