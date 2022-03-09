<template>
    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <v-sheet
        color="grey lighten-4"
        class="pa-4"
      >
        <v-avatar
          class="mb-4"
          color="grey darken-1"
          size="64"
        ></v-avatar>

        <div>john@vuetifyjs.com</div>
      </v-sheet>
                                  <v-dialog transition="fab-transition"
                                v-model="logout_dialog"
                                max-width="290"
                                >
                                <v-card>
                                    <v-card-title class="text-h5">
                                    Are you sure you want to logout?
                                    </v-card-title>

                                    <v-card-text>
                                    </v-card-text>

                                    <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="green darken-1"
                                        text
                                        @click="logout()"
                                    >
                                        Yes
                                    </v-btn>

                                    <v-btn
                                        color="green darken-1"
                                        text
                                        @click="logout_dialog = false"
                                    >
                                        No
                                    </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>

      <v-divider></v-divider>
      <v-list>
            <v-list-item>
                <form class="d-inline-flex align-center" @click.prevent="logout_dialog=!logout_dialog">
                    <v-btn text type="submit" class="sideBarButton">
                        <v-icon color="blue lighten-3" left small>mdi-logout</v-icon>
                        Logout
                    </v-btn>
                </form>
            </v-list-item>
      </v-list>
    </v-navigation-drawer>
</template>
<script>
  export default {
    props:[
        'drawer'
    ],
    data: () => ({
      logout_dialog: false,
      links: [
        ['mdi-inbox-arrow-down', 'Inbox'],
        ['mdi-send', 'Send'],
        ['mdi-delete', 'Trash'],
        ['mdi-alert-octagon', 'Spam'],
        ['mdi-logout', 'Logout'],
      ],
    }),
    methods: {
        logout() {
            this.logout_dialog  = false;
            this.$inertia.post(route('logout'));
        }
    },
  }
</script>
<style>
    .sideBarButton{
        width: 187%;
        background-color: gray;
    }
</style>

