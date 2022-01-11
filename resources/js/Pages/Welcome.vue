<template>
  <Head title="Welcome" />

  <div>
    <div class="container-fluid fixed-top p-4">
      <div class="col-12">
        <div v-if="canLogin" class="d-flex justify-content-end">
          <div>
            <Link
              v-if="$page.props.auth.user"
              :href="route('passwords.index')"
              class="text-muted"
            >
              Passwords
            </Link>

            <template v-else>
              <Link :href="route('login')" class="text-muted">
                Log in
              </Link>

              <Link
                v-if="canRegister"
                :href="route('register')"
                class="ms-4 text-muted"
              >
                Register
              </Link>
            </template>
          </div>
        </div>
      </div>
    </div>
  

    <div class="container-fluid my-5 pt-5 px-5">
      <div class="row justify-content-center px-4">
        <div class="col-md-12 col-lg-9">
          <breeze-application-logo class="d-inline" width="128" />
          <h1 class="display-1 d-inline">CrypityCrop</h1>
          <div class="card shadow-sm">
            <h2>Bienvenue sur CrypityCrop</h2>
            <p>Notre nouveau gestionnaire de mot de passe est génial ! Il stocke vos mots de passe en dur dans la base données :-)</p>
            <p>Vous pouvez également partager vos mots de passes pas très sécurisés avec des amis et des collègues.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
export default {
  components: {
    Head,
    Link,
    BreezeApplicationLogo
  },
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String
  }
};
</script>
