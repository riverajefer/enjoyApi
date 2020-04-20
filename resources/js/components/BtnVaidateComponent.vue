<template>
  <v-app>
    <div class="text-center">
      <v-btn
        class="ma-2"
        rounded
        large
        :loading="loading"
        :disabled="loading"
        color="success"
        @click="onclickValidate()"
      >
        Validar
        <template v-slot:loader>
          <span class="custom-loader">
            <v-icon light>cached</v-icon>
          </span>
        </template>
      </v-btn>
    </div>
  </v-app>
</template>

<script>
import { db } from "../db";

export default {
  created() {
    db.ref("app").on(
      "child_changed",
      snapshot => {
        console.log("snapshot:", snapshot.val());
        if (!snapshot.val()) {
          this.loading = false;
        }
      },
      this.onErrorHandler
    );
  },
  mounted() {
    console.log("Component mounted.");
  },
  data: () => {
    return {
      fn: null,
      loading: false,
      validate: false
    };
  },

  methods: {
    onclickValidate: function() {
      this.loading = true;
      db.ref("app")
        .child("resul_status")
        .set(true);
    },
    onErrorHandler: function(data) {
      console.log("Error:", data);
    }
  }
};
</script>

<style>
.custom-loader {
  animation: loader 1s infinite;
  display: flex;
}
@-moz-keyframes loader {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}
@-webkit-keyframes loader {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}
@-o-keyframes loader {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}
@keyframes loader {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}
.v-application--wrap{
    min-height: 20vh;
}
</style>
