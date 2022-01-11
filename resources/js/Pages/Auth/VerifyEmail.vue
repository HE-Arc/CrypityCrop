<template>
  <Head title="Email Verification" />

  <div class="card-body">
    <div class="mb-3 small text-muted">
      Merci de vous être inscrits ! Avant de commencer, veuillez confirmer avec le lien que nous vous avons fourni sur votre adresse email.
    </div>

    <div class="alert alert-success" role="alert" v-if="verificationLinkSent" >
      Un nouveau lien de vérification a été envoyé à votre adresse email.
    </div>

    <form @submit.prevent="submit">
      <div class="mt-4 d-flex justify-content-between">
        <breeze-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
          <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Chargement...</span>
          </div>
          Renvoyer un mail de confirmation
        </breeze-button>

        <Link :href="route('logout')" method="post" as="button" class="btn btn-link">Se déconnecter</Link>
      </div>
    </form>
  </div>
</template>

<script>
    import BreezeButton from '@/Components/Button.vue'
    import BreezeGuestLayout from "@/Layouts/Guest.vue"
    import { Head, Link } from '@inertiajs/inertia-vue3'

    export default {
        layout: BreezeGuestLayout,

        components: {
            BreezeButton,
            Head,
            Link,
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form()
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('verification.send'))
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    }
</script>
