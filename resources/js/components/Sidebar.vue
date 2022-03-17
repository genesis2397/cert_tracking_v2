<template>
    <v-navigation-drawer
      v-model="drawer"
      app
      color="#0000B9"
    >
      <v-sheet
        color="#82CAFF"
        class="pa-4"
      >
        <v-avatar
          class="mb-4"
          color="#0000B9"
          size="64"
        >      <v-icon dark size="70">
        mdi-account-circle
      </v-icon></v-avatar>

        <div>Hello Genesis!</div>
      </v-sheet>
                                  <v-dialog transition="fab-transition"
                                v-model="logout_dialog"
                                max-width="290"
                                >
                                <v-card color="#0000B9" dark>
                                    <v-card-title class="text-h5">
                                    Are you sure you want to logout?
                                    </v-card-title>

                                    <v-card-text>
                                    </v-card-text>

                                    <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="white"
                                        text
                                        @click="logout()"
                                    >
                                        Yes
                                    </v-btn>

                                    <v-btn
                                        color="white"
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
                <form class="d-inline-flex align-center">
                    <v-btn text type="submit" class="sideBarButton_2" :href="route('dashboard')" color="white">
                        <v-icon color="blue lighten-3" left small>mdi-view-dashboard</v-icon>
                        Records
                    </v-btn>
                </form>
            </v-list-item>
            <v-list-item>
                <form class="d-inline-flex align-center">
                    <v-btn text type="submit" class="sideBarButton_3" :href="route('upload_file')" color="white">
                        <v-icon color="blue lighten-3" left small>mdi-cloud-upload</v-icon>
                        Upload
                    </v-btn>
                </form>
            </v-list-item>
            <v-list-item>
                <form class="d-inline-flex align-center" @click.prevent="logout_dialog=!logout_dialog">
                    <v-btn text type="submit" class="sideBarButton" color="white">
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
        background-color: #1E90FF;
    }
    .sideBarButton_2{
        width: 173%;
        background-color: #1E90FF;
    }
    .sideBarButton_3{
        width: 188%;
        background-color: #1E90FF;
    }
</style>

