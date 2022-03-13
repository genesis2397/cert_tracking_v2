
<template>
    <app-layout>
        <v-row>
          <v-col
            v-for="card in cards"
            :key="card"
            cols="12"
          >
            <v-card color="#76528BFF" dark>
              <v-subheader>{{ card }}</v-subheader>

              <v-list two-line color="#D1C4E9">
                <template v-for="n in 6">
                  <v-list-item

                    :key="n"
                  >
                    <v-list-item-avatar color="#76528BFF">
                        <v-icon dark size="43">
                            mdi-account-circle
                        </v-icon>
                    </v-list-item-avatar>

                    <v-list-item-content class="color_for_card_text">
                      <v-list-item-title>Message {{ n }}</v-list-item-title>

                      <v-list-item-subtitle class="color_for_text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil repellendus distinctio similique
                      </v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>

                  <v-divider
                    v-if="n !== 6"
                    :key="`divider-${n}`"
                    inset
                  ></v-divider>
                </template>
              </v-list>
            </v-card>
          </v-col>
        </v-row>
    </app-layout>
</template>

<script>
    import AppLayout from '../Layouts/AppLayout'
    export default {
        components: {
            AppLayout,
        },
            data: () => ({
      cards: ['Today', 'Yesterday'],
      drawer: null,
      links: [
        ['mdi-inbox-arrow-down', 'Inbox'],
        ['mdi-send', 'Send'],
        ['mdi-delete', 'Trash'],
        ['mdi-alert-octagon', 'Spam'],
      ],
    })
    }
</script>

<style>
.stick{
    position: sticky;
}
.color_for_text{
    color: #76528BFF !important;
}
.color_for_card_text{
   color: #76528BFF;
}

</style>
